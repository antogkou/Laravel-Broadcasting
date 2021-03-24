<template>
  <div class="row">
    <div class="col-md-8">
      <h3 v-text="project.name"></h3>

      <b-list-group>
        <b-list-group-item
          v-for="task in project.tasks"
          v-text="task.body"
          :key="task.id"
        ></b-list-group-item>
      </b-list-group>

      <div class="container mt-1">
        <b-input
          placeholder="New Task"
          type="text"
          @blur="save()"
          v-model="newTask"
          @keydown="tagPeers()"
        ></b-input>
        <span v-if="activePeer"
        v-text="activePeer.name + ' is typing..'"></span>
      </div>
    </div>

    <div class="col-md-4">
      <h4>Active Participants</h4>
      <ul>
        <li
          v-for="participant in participants"
          v-text="participant.name"
          :key="participant.id"
        ></li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  props: ['data-project'],
  data() {
    return {
      project: this.dataProject,
      newTask: '',
      participants: [],
      activePeer: false,
      typingTimer: false,
    };
  },
  computed: {
    channel() {
      return Echo.join('tasks.' + this.project.id);
    },
  },

  created() {
    this.channel
        .here((users) => {
          this.participants = users;
        })
        .joining((user) => {
          this.participants.push(user);
        })
        .leaving((user) => {
          this.participants.splice(this.participants.indexOf(user), 1);
        })
        .listen('TaskCreated', ({task}) => {
          this.addTask(task);
        })
        .listenForWhisper('typing', this.flashActivePeer);
  },

  methods: {
    tagPeers() {
      this.channel.whisper('typing', {name: window.App.user.name});
    },

    flashActivePeer(e) {
      this.activePeer = e;

      if (this.typingTimer) clearTimeout(this.typingTimer);

      this.typingTimer = setTimeout(() => {
        this.activePeer = false;
      }, 3000);
    },

    save() {
      if (this.newTask) {
        axios
            .post(`/api/projects/${this.project.id}/tasks`, {
              body: this.newTask,
            })
            .then((response) => response.data)
            .then(this.addTask);
      }
    },

    addTask(task) {
      this.activePeer = false;
      this.project.tasks.push(task);
      this.newTask = '';
    },
  },
};
</script>
