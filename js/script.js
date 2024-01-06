const { createApp } = Vue;

// ora che su server.php ho creato un ciclo che mi prenda 
//i dati dal json e me li traduca in array php e viceversa
// procedo a creare tramite Vue le chiamate a server.php stesso un po come se fosse un API

createApp({
  data() {
    return {
      //creo una var che contenga l'indirizzo per le chiamate axios 
      apiUrl: 'server.php',
      //creo una var array in cui accoglierò i dati presi dal json 
      todoList: [],
      //creo una var script vuota collegata ad un form in index.php tramite v-model
      //accoglierà il contenuto che invierò attraverso la funzione taskdder 
      //con cui creerò una nuova task nel json 
      newTask: '',
    };
  },
  methods: {
    // creo una chiamata axios.get con cui prendo i dati del json 
    getList() {
        axios
        .get(this.apiUrl)
        .then((resp) => {
            // then li attribuirò alla var array todoList popolandolo
            this.todoList = resp.data;
        });
    },
    //adesso creo una funzione che passi il contenuto della var newTask al json
    //e conseguentemente aggiornandomi la lista
    taskAdder() {
        //per poter passare i dati al json in modo corretto tramite richiesta POST
        //al nostro script server.php
        //abbiamo bisogno di inviare un oggetto di tipo FormData()
        //a cui aggiungeremo tramite funzione append i contenuti di newTask
        const data = new FormData();
        data.append("addATask", this.newTask);
        axios
        .post(this.apiUrl, data)
        .then((resp)=> {
            //dopo aver inviato i dati ripopoliamo l'array todoList coi nuovi elementi inviati
            this.todoList = resp.data;
        });
        //dopodichè resettiamo il valore di newTask in preparazione ad un nuovo valore da aggiungere in lista
        this.newTask = '';
    },
    //con lo stesso modo posso pure creare una funzione che mi comunichi quali task togliere
    //questa funzione è legata tramite v-bind @click al click dell'icona del delete in index.php
    // differenza della precedente necessita di un valore per funzionare 
    //valore che corrisponde all'index dell'elemento in array todoList
    taskDeleter(indice) {
        const data = new FormData();
        data.append("killTheTask", indice);
        axios
        .post(this.apiUrl, data)
        .then((resp)=> {
            //dopo aver inviato i dati ripopoliamo l'array todoList coi nuovi elementi inviati
            this.todoList = resp.data;
        });
    },
    //stessa cosa con la funzione che regola il marking delle task 
    doneMarker(indice) {
        const data = new FormData();
        data.append("markTheTask", indice);
        axios
        .post(this.apiUrl, data)
        .then((resp)=> {
            console.log(resp.data);
            this.todoList = resp.data;
        });
    }
  },
  mounted() {
    //richiamo la funzione in mounted così da avviarla al caricamento della pagina
    this.getList();
  },
}).mount("#app");