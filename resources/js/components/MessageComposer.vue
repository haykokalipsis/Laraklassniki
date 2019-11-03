<template>
    <div class="composer">
        <textarea
                v-model="message"
                @keydown.enter="send"
                placeholder="Message..." cols="30" rows="10">
        </textarea>

    </div>
</template>

<script>
    export default {
        name: "messageComposer",

        data () {
            return {
                message: ''
            };
        },

        methods: {
            send(event) {
                event.preventDefault();

                if (this.message === '')
                    return;

                this.$emit('send', this.message);
                this.message = '';
            }
        }

    }
</script>

<style lang="scss" scoped>
    .composer textarea{
        max-height: 100px;
        width: 96%;
        margin: 10px;
        resize: none;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        border: 1px solid lightgray;
        padding: 6px;
    }
</style>