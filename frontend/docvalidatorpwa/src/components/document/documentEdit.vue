<template>
  <div class="documentEdit">
    <div class="breadcrumbs">
      <nav style="display: inline">
        <li>
          <router-link :to="{ name: 'home', params: {} }">
            Home
          </router-link>
        </li>
        /
        <li>
          <router-link :to="{ name: 'document', params: {} }">
            document
          </router-link>
        </li>
        /
        <li>
          <router-link
            class="breadcrumbs-active"
            :to="{ name: 'documentEdit', params: { id: id } }"
          >
            edit document
          </router-link>
        </li>
      </nav>
    </div>
    <h1>Edit document</h1>
    <document-form :id="id" />
  </div>
</template>

<script>
import documentForm from "./documentForm.vue";

export default {
  name: "Document",
  data() {
    return {
      id: "Teste"
    };
  },
  components: {
    documentForm
  },
  created() {
    this.id = this.$route.params.id;
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
  text-transform: capitalize;
  font-size: 0.8em;
}
.breadcrumbs {
  background-color: white;
}
.breadcrumbs-active {
  text-decoration: underline;
  color: black;
  font-weight: bold;
}
</style>
