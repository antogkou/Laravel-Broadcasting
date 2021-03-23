<template>
    <div class="card">
        <div class="card-body">
            <div class="card-body">
                {{ project.name }}
                <b-list-group>
                    <b-list-group-item
                        v-for="task in project.tasks"
                        v-text="task.body"
                        :key="task.id"
                    ></b-list-group-item>
                </b-list-group>
                <b-input
                    type="text"
                    @blur="save()"
                    v-model="newTask"
                    @keydown="tagPeers()"
                ></b-input>
                <span
                    v-if="activePeer"
                    v-text="activePeer.name + ' is typing..'"
                ></span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["data-project"],
    data() {
        return {
            project: this.dataProject,
            newTask: "",
            activePeer: false,
            typingTimer: false
        };
    },
    computed: {
        channel() {
            return Echo.private("tasks." + this.project.id);
        }
    },

    created() {
        this.channel
            .listen("TaskCreated", ({ task }) => {
                this.addTask(task);
            })
            .listenForWhisper("typing", this.flashActivePeer);
    },

    methods: {
        tagPeers() {
            this.channel.whisper("typing", { name: window.App.user.name });
        },

        flashActivePeer(e) {
            this.activePeer = e;

            if (this.typingTimer) clearTimeout(this.typingTimer);

            this.typingTimer = setTimeout(() => {
                this.activePeer = false;
            }, 3000);
        },

        save() {
            axios
                .post(`/api/projects/${this.project.id}/tasks`, {
                    body: this.newTask
                })
                .then(response => response.data)
                .then(this.addTask);
        },

        addTask(task) {
            this.activePeer = false;
            this.project.tasks.push(task);
            this.newTask = "";
        }
    }
};
</script>

<style></style>
