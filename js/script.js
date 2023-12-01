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
    },
    taskAdder() {
        const data = new FormData();
        data.append("addATask", this.newTask);
        axios
        .post(this.apiUrl, data)
        .then((resp)=> {
            console.log(resp.data);
            this.todoList = resp.data;
        });
        this.newTask = '';
    },
    taskDeleter(indice) {
        const data = new FormData();
        data.append("killTheTask", indice);
        axios
        .post(this.apiUrl, data)
        .then((resp)=> {
            console.log(resp.data);
            this.todoList = resp.data;
        });
    },
    // doneMarker(indice) {
    //     const
    // }
  },
  mounted() {
    this.getList();
  },
}).mount("#app");