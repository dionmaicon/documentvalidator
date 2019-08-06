<template>
  <div class="view">
    <div class="breadcrumbs">
      <nav style="display: inline">
        <li class="liTitle">
          <router-link :to="{ name: 'home', params: {} }">
            Home
          </router-link>
        </li>
        /
        <li class="liTitle">
          <router-link :to="{ name: 'document', params: {} }">
            document
          </router-link>
        </li>
        /
        <li class="liTitle">
          <router-link
            class="breadcrumbs-active"
            :to="{ name: 'documentView', params: { id: id } }"
          >
            view document
          </router-link>
        </li>
      </nav>
    </div>
    <div class="row">
      <div class="card" style="width: 100%;">
        <div class="card-header">
          View document
        </div>
        <ul class="list-group list-group-flush">
          <li v-if="document.document" class="list-group-item">
            <span class="liTitle"> <strong> Document: </strong> </span>{{ document.document | doc}}
          </li>
          <li v-if="document.type" class="list-group-item">
            <strong> Type: </strong>{{ document.type }}
          </li>
          <li v-if="document.blacklist" class="list-group-item">
            <strong> Blacklist: </strong>{{ document.blacklist}}
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <button @click="edit(id)"
class="btn btn-warning ">
          Edit
        </button>
        <button
          type="button"
          @click="goBack()"
          name="button"
          class="btn btn-default"
        >
          Back
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { eventBus } from "../../main.js";
export default {
  data() {
    return {
      id: "",
      document: {}
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1);
    },
    edit(id) {
      this.$router.push({ name: "documentEdit", params: { id: id } });
    },
    setInstace() {
      this.$http
        .get(this.$endPoint.getUrlByName("document") + "/" + this.id)
        .then(response => {
          this.document = response.data;
        });
    }
  },
  created() {
    this.id = this.$route.params.id;
    eventBus.changeModalState();
    this.setInstace();
  },
  filters: {
    doc: (value) => {
      if (value.length == 11) {
        let cpf = value.replace(/[^\d]/g, "");
        return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
      } else {
        let cnpj = value.replace(/[^\d]/g, "");
        return cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
      }
    }
  }
};
</script>

<style lang="css" scoped>
h1 {
  text-transform: capitalize;
  text-align: center;
}
li {
  display: inline;

  font-size: 0.8em;
}
.liTitle {
text-transform: capitalize;
}
.breadcrumbs {
  background-color: white;
}
.breadcrumbs-active {
  text-decoration: underline;
  color: black;
  font-weight: bold;
}
button {
  margin: 8px;
  width: 30%;
  float: right;
}
</style>
