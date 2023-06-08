<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message.id">
            <div class="clearfix">
                <p>
                    <strong v-if="message.user.is_admin == 1" style="color: #7A4B09; font-size: 18px"><b>(A)</b> </strong>
                    <strong v-else-if="message.user.is_moderator == 1" style="color: #DD301E; font-size: 18px">(M) </strong>
                    <strong>{{ message.user.name }}:</strong> {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    name: "chat-messages",
    props: ['messages']
}
</script>

<style scoped>

</style>
