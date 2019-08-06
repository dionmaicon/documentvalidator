const resource = {
  prodPoint: "https://vuejs-resource-tutorial.firebaseio.com/data/documents.json",
  devPoint: "http://localhost:8081/api/documents"
};

const model = (function() {
  return {
    document: {
      type: "text",
      required: true
    },
    type_select: {
      selected: "CPF",
      options: [
        { text: "CPF", value: "CPF"},
        { text: "CNPJ", value: "CNPJ"}
      ]
    },
    blacklist_select: {
      selected: false,
      options: [
        { text: "True", value: true},
        { text: "False", value: false}
      ]
    },
    hide: ["type"]
  };
})();

module.exports = { model, resource };
