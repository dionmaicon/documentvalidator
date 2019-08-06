<template>
  <div id="documentForm" class="form">
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="document">document</label><br >
        <input
          id="document"
          class="form-control"
          type="text"
          required="true"
          v-mask="['###.###.###-##', '##.###.###/####-##']"
          v-model="document.document"
        >
      </div>
      <div class="form-group">
        <label for="type">type</label><br >
        <div class="col-12">
          <select
            id="type"
            v-model="document.type.selected"
            class="form-control"
          >
            <option
              v-for="option in document.type.options"
              :key="option.value"
              :value="option.value"
            >
              {{ option.text }}
            </option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="blacklist">blacklist</label><br >
        <div class="col-12">
          <select
            id="blacklist"
            v-model="document.blacklist.selected"
            class="form-control"
          >
            <option
              v-for="option in document.blacklist.options"
              :key="option.value"
              :value="option.value"
            >
              {{ option.text }}
            </option>
          </select>
        </div>
      </div>

      <button
        v-if="id"
        type="submit"
        name="buttonUpdate"
        class="btn btn-primary "
      >
        Update
      </button>
      <button v-else type="submit" name="buttonCreate" class="btn btn-success ">
        Save
      </button>
      <button
        type="button"
        @click="goBack"
        name="button"
        class="btn btn-default"
      >
        Back
      </button>
    </form>
  </div>
</template>

<script>
import { eventBus } from "../../main.js";
import {mask} from 'vue-the-mask'

export default {
  props: ["id"],
  directives: {mask},
  data() {
    return {
      document: {
        document: "",
        type: {
          selected: "CPF",
          options: [
            { text: "CPF", value: "CPF" },
            { text: "CNPJ", value: "CNPJ" }
          ]
        },
        blacklist: {
          selected: false,
          options: [
            { text: "True", value: true },
            { text: "False", value: false }
          ]
        }
      }
    };
  },
  created() {
    this.$endPoint.addUrl(
      "https://vuejs-resource-tutorial.firebaseio.com/data/documents.json",
      "http://localhost:8081/api/documents",
      "document"
    );
    eventBus.changeModalState();
    this.setInstace();
  },
  methods: {
    async handleSubmit() {
      if (this.id) {
        //Implements here your submit method UPDATE
        /**
         * type equals 0 means that this modal disappear automatically after 1500 milliseconds
         * type equals 1 means that this modal  will have button close without timer
         * type equals 2 means that this modal will have button close and ok without timer
         */
        let option = await this.$modal.show({
          title: "Warning",
          message: "Do you have sure that want complete this updated?",
          alert: "warning",
          type: 2
        });
        if (option) {
          let document = {};
          document.document = this.document.document;
          //Uncomment and replace property for you select property
          document.type = this.document.type.selected;
          document.blacklist = this.document.blacklist.selected;

          this.$http
            .put(
              this.$endPoint.getUrlByName("document") + "/" + this.id,
              document
            )
            .then(response => {
              if (response.status == 200) {
                this.$modal.show({
                  title: "Success",
                  message: "document was updated with successfull!",
                  alert: "success"
                });
                this.goBack();
              }
            })
            .catch(error => {
              let message = this.translateError(error.response.data);
              this.$modal.show({
                title: "Error",
                message: "Server response with error: " + message,
                alert: "danger",
                type: 1
              });
            });
        }
        return;
      } else {
        //Implements here your submit method CREATE
        let option = await this.$modal.show({
          title: "Warning",
          message: "Do you want to continue?",
          alert: "warning",
          type: 2
        });
        if (option) {
          let document = {};
          document.document = this.document.document;
          //Uncomment and replace property for you select property
          document.type = this.document.type.selected;
          document.blacklist = this.document.blacklist.selected;;

          this.$http
            .post(this.$endPoint.getUrlByName("document"), document)
            .then(response => {
              if (response.status == 201) {
                this.$modal.show({
                  title: "Success",
                  message: "document was created with successfull!",
                  alert: "success"
                });
                this.goBack();
              }
            })
            .catch(error => {
              let message = this.translateError(error.response.data);
              this.$modal.show({
                title: "Error",
                message: "Server response with error: " + message,
                alert: "danger",
                type: 1
              });
            });


        }
      }
    },
    translateError(instance) {
      let message = "";
      for (var prop in instance) {
        if (instance.hasOwnProperty(prop)) {
          message += prop + ": " + instance[prop] + "\n";
        }
      }
      return message;
    },
    goBack() {
      this.$router.go(-1);
    },
    setInstace() {
      if (this.id) {
        this.$http
          .get(this.$endPoint.getUrlByName("document") + "/" + this.id)
          .then(response => {
            let instance = response.data;
            for (var prop in instance) {
              if (
                instance.hasOwnProperty(prop) &&
                this.document.hasOwnProperty(prop)
              ) {
                // Uncomment  for select property
                if(prop == "type" || prop == "blacklist"){
                 this.document[prop].selected = instance[prop];
                 continue;
                }
                this.document[prop] = instance[prop];
              }
            }
          });
      }
    }
  }
};
</script>
<style lang="css" scoped>
label {
  text-transform: capitalize;
}
button {
  margin: 8px;
  width: 30%;
  float: right;
}
form {
  overflow: hidden;
}
</style>
