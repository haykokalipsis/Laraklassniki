// import Vue from 'vue';
// import axios from 'axios';
//
// // export default new Vue;
// export const Bus = new Vue({
//     data() {
//         return {
//             products: [] // Some Products
//         };
//     },
//
//
//
//
//
//
// // В других компонентах в секцию mounted добавляем прослушивание:
//     methods: {
//         onDelete(payload) {
//             axios.delete('/api/item/' + payload)
//                 .then( (response) => {
//                     this.$emit('quoteDeleted', this.item.id);
//                     console.log(response);
//                 })
//                 .catch( (error) => console.error(error));
//         }
//     }
// });