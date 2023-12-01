const { createApp } = Vue;

createApp({
  data() {
    return {
      apiUrl: 'server.php',
      todoList: [],
      newTask: '',
    };
  },
  methods: {
    getList() {
        axios
        .get(this.apiUrl)
        .then((resp) => {
            console.log(resp.data);
            this.todoList = resp.data;
        });
    }
  },
  mounted() {
    this.getList();
  },
}).mount("#app");