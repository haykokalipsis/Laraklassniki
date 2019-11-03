<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : 'Select a Contact'}}</h1>

        <MessagesFeed :contact="contact" :messages="messages"/>

        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
    import axios from 'axios';

    import MessagesFeed from './MessagesFeed';
    import MessageComposer from './MessageComposer';

    export default {
        name: "Conversation",

        props: {
            contact: {
                type: Object,
                default: null
            },

            messages: {
                type: Array,
                default: []
            }
        },

        methods: {
            sendMessage(text) {
                if ( ! this.contact)
                    return;

                axios.post(route('messenger.send'), {
                    contact_id: this.contact.id,
                    body: text
                })
                    .then( (response) => this.$emit('new', response.data));
            }
        },

        components: {
            MessageComposer,
            MessagesFeed
        }
    }
</script>

<style lang="scss" scoped>
    .conversation {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;

        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px dashed lightgray;
        }
    }
</style>