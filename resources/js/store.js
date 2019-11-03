import Vuex from 'vuex';
import  Vue from 'vue';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        notifications: [],
        online_users: [],
    },

    getters: {
        all_notifications(state) {
            return state.notifications;
        },

        all_notifications_count(state) {
            return state.notifications.length;
        },

        online_users(state) {
            return state.online_users;
        },
    },

    mutations: {
        add_notification(state, notification) {
            state.notifications.push(notification);
        },

        set_online_users(state, users) {
            state.online_users = users;
        },

        add_online_user(state, user) {
            state.online_users.push(user);
        },

        remove_online_user(state, user) {
            state.online_users = state.online_users.filter( (u) => u !== user);
        }
    }

});