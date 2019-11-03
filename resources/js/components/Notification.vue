<template>
    <div>

    </div>
</template>

<script>
    // import Echo from "laravel-echo";

    export default {
        name: "Notification.vue",

        props: ['auth_user_id'],

        mounted() {
            // this.listen();
            // Echo.channel(`Message`)
            //     .listen( 'newMessage', (event) => {
            //         alert('new notification');
            //         // console.log(event);
            //         console.log('event------------------------------------------------');
            //     });

            // Echo.channel('Message')
            //     .notification( (notification) => {
            //         alert('NewFriendRequest');
            //         console.log(notification);
            //     });
            //
            Echo.private(`App.User.${this.auth_user_id}`)
                .notification( (notification) => {
                    // alert('NewFriendRequest');
                    // document.getElementById('notification').muteplay();
                    document.getElementById("notification").play();
                    this.$store.commit('add_notification', notification);
                    console.error('HEREEEEEEEEEEEEEEEEEEEEEEe');
                    console.log(notification);
                });

            // Echo.private(`App.User.${this.auth_user_id}`)
            //     .listen( 'NewFriendRequest', (event) => {
            //         // alert('new notification');
            //         console.log(event);
            //         // console.log('event');
            //     });
        },

        methods: {
            // listen() {
                // Echo.private(`App.User.${this.auth_user_id}`)
                //     .listen( 'NewFriendRequest', (event) => {
                //         alert('new notification');
                //         console.log(event);
                //         console.log('event');
                //     });

                // Echo.channel(`User`)
                //     .listen( 'NewFriendRequest', (event) => {
                //         alert('new notification');
                //         console.log(event);
                //         console.log('event');
                //     });

                // Echo.private('App.User.' + this.auth_user_id)
                //     .notification( (notification) => {
                //         alert('NewFriendRequest');
                //         console.log(notification);
                //     })
            // }
        }

    }
</script>

<style scoped>

</style>