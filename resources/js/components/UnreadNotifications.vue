<template>
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="/notifications">-->
<!--            Unread Notifications-->
<!--            <span class="badge">{{ all_notifications_count}}</span>-->
<!--        </a>-->
<!--    </li>-->

    <div class="dropdown nav-item">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
            <span class="badge badge-primary">{{ all_notifications_count }}</span>
            Unread notifications
        </a>

        <div class="dropdown-menu">
            <h5 class="dropdown-header">Friend Requests</h5>
            <a
                    class="dropdown-item"
                    v-for="notification in all_notifications"
                    :href="'/notification/'+notification.data['from']+ '/' + notification.id">

                <small>{{ notification.data['name'] }} &nbsp; {{ notification.data['message'] }}</small>
                <small>{{ notification.created_at }}</small>
            </a>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';

    export default {
        name: "UnreadNotifications",

        created() {
            this.get_unread();
        },

        computed: {
            ...mapGetters([
                'all_notifications',
                'all_notifications_count'
            ]),


        },

        methods: {
            get_unread() {
                axios.get('/get-unread-notifications')
                    .then( ({ data }) => {
                        data.forEach( (notification) => {
                            this.$store.commit('add_notification', notification);
                        });
                        console.info('heya heya', this.all_notifications);
                    })
            }
        }
    }
</script>

<style scoped>

</style>