<template>
    <span>
            <span class="text-center" v-if="loading">
                Loading...
            </span>

            <span class="text-center" v-if=" ! loading">
                <button class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light" v-if="status === 0" @click="onSendAddFriendRequest">Add Friend</button>
                <button class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light" v-if="status === 'waiting for my action'" @click="onAcceptFriend">Accept Friend</button>
                <span class="btn btn-primary btn-sm w-sm waves-effect m-t-10 waves-light" v-if="status === 'waiting for users action'">Request Sent</span>
                <span class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light" v-if="status === 'friends'">Friends</span>
            </span>
    </span>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['profile_user_id', 'auth_user_id'],

        data() {
            return {
                status: '',
                loading: true
            }
        },

        methods: {
            onSendAddFriendRequest() {
                axios.get(`/send-add-friend-request/${this.profile_user_id}`)
                    .then( ({data}) => {
                        if (data === 1)
                            this.status = 'waiting for users action';
                    })
                    .finally( () => this.loading = false)

            },

            onAcceptFriend() {
                axios.get(`/accept-friend/${this.profile_user_id}`)
                    .then( ({data}) => {
                        console.log(data);
                        // alert(data);
                        if (data === 1) {
                            this.status = 'friends';
                            // alert('accepted');
                        }

                    })
                    .finally( () => {
                        this.loading = false;
                        // alert(4);
                    })

            },

            checkRelationshipStatus() {
                axios.get(`/check-relationship-status/${this.profile_user_id}`)
                    .then( (response) => {
                        this.status = response.data.status;
                    })
                    .finally( () => {
                        this.loading = false;
                        // alert('checked status + ' + this.status );
                    });
            }
        },

        mounted() {
            this.checkRelationshipStatus();

            Echo.private(`App.User.${this.auth_user_id}`)
                .notification( (notification) => {
                    // // alert('NewFriendRequest');
                    // document.getElementById('notification').muteplay();
                    // document.getElementById("notification").play();
                    // this.$store.commit('add_notification', notification);
                    this.checkRelationshipStatus();
                    console.log(notification);
                    // alert('came');
                });
        }
    }
</script>
