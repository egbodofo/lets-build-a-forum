<template>
    <div>
        <div v-if="signedIn">
            <div class="pt-4 row">
                <div class="form-group col-md-12">
                    <textarea name="body"
                        id="body"
                        class="form-control"
                        rows="5"
                        placeholder="Have Something to say?"
                        required
                        v-model="body">
                    </textarea>

                    <button type="submit"
                        class="mt-3 btn btn-xs btn-primary"
                        @click="addReply">Post
                    </button>
                </div>
            </div>
        </div>

        <p class="text-center pt-3" v-else>
            Please <a href="/login">sign in</a> to participate in this discussion.
        </p>
    </div>
</template>

<script>
    import Tribute from "tributejs";

    export default {
        data() {
            return {
                body: '',
            }
        },

        mounted() {
            let tribute = new Tribute({
                // column to search against in the object (accepts function or string)
                lookup: 'value',
                // column that contains the content to insert by default
                fillAttr: 'value',
                values: function(query, cb) {
                    axios.get('/api/users', {params: {name: query}} )
                        .then(function(response){
                            console.log(response);
                            cb(response.data);
                        });
                },
            });

            tribute.attach(document.querySelectorAll("#body"));
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body })
                    .then(({data}) => {
                        this.body = '';

                        flash('Your reply has been posted');

                        this.$emit('created', data)
                    })
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
            }
        }
    }
</script>
