<template>
    <div class="messenger">
        <Conversation
                :contact="selectedContact"
                :messages="messages"
                @new="saveNewMessage">
        </Conversation>

        <ContactsList
                :contacts="contacts"
                @selected="startConversationWith">
        </ContactsList>
    </div>
</template>

<script>
    import axios from 'axios';

    import Conversation from './Conversation';
    import ContactsList from './ContactsList';

    export default {
        name: 'messenger',
        props: {
            user: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            }
        },

        created() {
            console.log(this.user);
            
            axios.get('/messenger-contacts')

                .then( (response) => {
                    this.contacts = response.data;
                    console.log(response.data);
                });
        },

        methods: {
            startConversationWith(contact) {
                this.updateUnreadCount(contact, true);

                axios.get(`/messenger-conversation/${contact.id}`)

                    .then( (response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },

            saveNewMessage(message) {
                this.messages.push(message);
            },

            handleIncoming(message) {
                if (this.selectedContact && message.sender === this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnreadCount(message.from_contact, false)
            },

            updateUnreadCount(contact, reset) {
                this.contacts = this.contacts.map( (singleContact) => {
                    if (singleContact.id !== contact.id) {
                        return singleContact;
                    }

                    if (reset)
                        singleContact.unread = 0;
                    else
                        singleContact.unread +=1;

                    return singleContact;
                });
            }
        },

        components: {
            Conversation,
            ContactsList
        },

        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (event) => {
                    this.handleIncoming(event.message);
                });
        }
    }
</script>

<style lang="scss" scoped>
    .messenger {
        display: flex;
    }
</style>
