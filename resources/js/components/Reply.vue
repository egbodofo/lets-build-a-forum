<template>
    <div :id="'reply-'+id" class="card">
        <div class="card-header" :class="isBest ? 'bg-success' : ''">
            <div class="level">
                <div class="flex">
                    <a href="#"><span class="fa fa-comment mr-1"></span></a>
                    <a :href="'/profiles/'+reply.owner.name"
                        v-text="reply.owner.name">
                    </a> said <span v-text="ago"></span>
                </div>

                <div v-if="signedIn">
                    <favorite :reply="reply"></favorite>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <form @submit="update">
                    <div class="form-group">
                        <textarea class="form-control" v-model="body" required></textarea>
                    </div>

                    <button class="btn btn-xs btn-primary"><span class="fa fa-edit"></span> Update</button>
                    <button class="btn btn-xs btn-outline-secondary" @click="editing = false" type="button"><span class="fa fa-window-close"></span> Cancel</button>
                </form>

            </div>

            <div v-else v-html="body"></div>
        </div>

        <div class="card-footer level" v-if="authorize('owns', reply) || authorize('owns', reply.thread)">
            <div v-if="authorize('owns', reply)">
                <button class="btn btn-info btn-xs mr-2" @click="editing = true"><span class="fa fa-user-edit"></span> Edit</button>
                <button class="btn btn-danger btn-xs" @click="destroy"><span class="fa fa-trash"></span> Delete</button>
            </div>
            <button class="btn btn-warning btn-xs ml-auto" @click="markBestReply" v-if="authorize('owns', reply.thread)">Best Reply?</button>
        </div>

    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['reply'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.reply.id,
                body: this.reply.body,
                isBest: this.reply.isBest,
            }
        },

        computed: {
            ago() {
                return moment(this.reply.created_at).fromNow() + '...';
            },
        },

        created () {
            window.events.$on('best_reply-selected', id => {
                this.isBest = (id === this.id);
            })
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.id, {
                    body: this.body
                })
                .catch(error => {
                    flash(error.response.reply, 'danger');
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.id);

                this.$emit('deleted', this.id);

                flash('Reply was deleted');
            },

            markBestReply() {
                axios.post('/replies/' + this.id + '/best');

                window.events.$emit('best_reply-selected', this.id);
            }
        }
    }
</script>
