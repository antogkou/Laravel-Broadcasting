<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Vue Component</div>

                    <div class="card-body">
                        {{ pusherResponse }}
                        <ul>
                            <li
                                v-for="task in tasks"
                                v-text="task"
                                :key="task"
                            ></li>
                        </ul>
                        <b-input
                            type="text"
                            v-model="newTask"

                            variant="priamy"
                            >Test</b-input
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {usherResponse: null,
      tasks: [],
      newTask: '',
    };
  },
  mounted() {
    // Echo.channel("order-channel").listen("OrderStatusUpdated", e => {
    //     console.log("Order has been updated behind the scenes");
    //     console.log(e);
    //     this.pusherResponse = e.order_id;
    // });
  },
  created() {
    // axios.get("/tasks").then(response => (this.tasks = response.data));

    // Echo.channel("tasks").listen("TaskCreated", ({ task }) => {
    //     this.tasks.push(task.body);
    // });
  },
  methods: {
    // addTask() {
    //     axios.post("/tasks", { body: this.newTask });

    //     this.tasks.push(this.newTask);

    //     this.newTask = "";
    // }
  },
};
</script>
