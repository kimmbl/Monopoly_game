<template>
<div class="input-group">
    <input id="btn-input" type="text" name="message" class="form-control write-message" placeholder="Напиши повідомлення..."
           v-model="newMessage" @keyup.enter="sendMessage"/>
        <button class="btn btn-dark" id="btn-chat" @click="sendMessage">
            Wyślij
        </button>
</div>
</template>

<script>

export default {
    props: ["user"],
    data() {
        return {
            newMessage: "",
        };
    },
    methods: {
        sendMessage() {
            this.$emit("messagesent", {
                user: this.user,
                message: this.newMessage,
            });
            this.newMessage = "";
        },
    },
};
</script>

<style scoped>

</style>
