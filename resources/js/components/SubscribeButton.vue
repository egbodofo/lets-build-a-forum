<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],

        data() {
            return {
                isActive: this.active
            }
        },

        computed: {
            classes() {
                return ['btn', this.isActive ? 'btn-warning' : 'btn-primary'];
            }
        },

        methods: {
            subscribe() {
                const requestType = this.isActive ? 'delete' : 'post';

                axios[(requestType)](location.pathname + '/subscriptions');

                this.isActive = ! this.isActive;

                if (this.isActive ? flash('Subscribed') : flash('Unsubscribed'));
            }
        }
    }
</script>
