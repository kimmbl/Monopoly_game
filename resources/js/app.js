import Vue from 'vue'
import ChatMessages from "./components/ChatMessages";
import ChatForm from "./components/ChatForm";
import axios from "axios";

require('./bootstrap');

require('phaser');

const app = new Vue({
    components: {
        'chat-messages': ChatMessages,
        'chat-form': ChatForm
    },
    el: '#app',
    data: {
        messages: [],
        lobby: []
    },
    created() {
        this.fetchMessages();

        window.Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });

    },
    methods: {
        fetchMessages() {

            axios.get('/messages').then(response => {
                this.messages = response.data;
            }).catch((err) => console.log(err));
        },
        addMessage(message) {

            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            }).catch((err) => console.log(err));
        }
    }
});
