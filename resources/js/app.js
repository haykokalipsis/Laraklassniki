
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import {store} from './store';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.route = require('./laravel-named-routes');

Vue.component('friend-component', require('./components/Friend.vue'));
Vue.component('notification-component', require('./components/Notification.vue'));
Vue.component('unread-notifications-component', require('./components/UnreadNotifications.vue'));

Vue.component('messenger-component', require('./components/Messenger.vue'));
Vue.component('online-user-component', require('./components/OnlineUser.vue'));

import { mapGetters, mapMutations } from 'vuex';

const app = new Vue({
    el: '#app',
    store,

    mounted() {
        this.all_users();

        Echo.join('online')
            .here( (users) => this.set_online_users(users))
            .joining( (user) => this.add_online_user(user))
            .leaving( (user) => this.remove_online_user(user));

        console.log('appppppppppppppppppppppppppp');
        console.log(this.all_notifications);
    },

    computed: {
        ...mapGetters([
            'online_users',
            'all_notifications'
        ])
    },

    methods: {
        ...mapMutations([
            'set_online_users',
            'add_online_user',
            'remove_online_user',
        ]),

        all_users() {
            axios.get('/all-users')
                .then( (response) => {
                    this.set_online_users(response.data);
                })
        }
    }
});
