const app = new Vue({
  data: {
    tasks: [],
    newTask: "",
  },
  methods: {
    fetchTasks() {
      axios
        .get("./api/index.php")
        .then((response) => {
          this.tasks = response.data;
        })
        .catch((error) => {
          console.error("Error fetching tasks:", error);
        });
    },
    addTask() {
      axios
        .post("./api/index.php", { text: this.newTask })
        .then((response) => {
          this.fetchTasks();
          this.newTask = "";
        })
        .catch((error) => {
          console.error("Error adding task:", error);
        });
    },
  },
});

app.$mount("#vue");
