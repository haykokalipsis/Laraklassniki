<template>
    <div class="float-right">
        <i class="fa fa-circle text-success" v-if="checkUser()"></i>
        <i class="fa fa-circle text-danger" v-else></i>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex';

    export default {
        name: "OnlineUser",
        props: ['user'],
        // props: ['users'],
        computed: {
            ...mapGetters([
                'online-users'
            ]),
            // users() {
            //     return this.users;
            // }
        },
        methods: {
            checkUser() {
                // return _.find(this.online_users, {id: this.user.id})
                return _.find(this.$store.getters.online_users, {id: this.user.id})
            }

        }
        //
        // mounted () {
        //     this.getUsers();
        //     // [...]
        //
        //     Echo.join('online')
        //         .here(users => this.$store.commit('set_online_users', users))
        //         .joining(user => this.users.push(user))
        //         .leaving(user => (this.users = this.users.filter(u => (u.id !== user.id))));
        // }

    }
</script>

<style scoped>

</style>