<template>
    <div class="mt-3">
        <div v-if="signedIn">
            <div class='form-group'>
                <textarea name='body' id='body' class='form-control' 
                        placeholder="Have something to say?"
                        rows="5" required v-model="body"></textarea>
            </div>
            <div class='form-group'>
                <button  class="btn btn-primary btn-block" @click="addReply">
                    Post
                </button>
            </div>
        </div>

        <p class='text-center' v-else>
            <a href="/login">
                <u>Please sign in to participate in this discussion</u>
            </a>
        </p>
       
    </div>
            
</template>

<script>
    export default {
    
    props:['endpoint'],

    data() {
        return {
            body: ''
        }
    },

    computed: {

        signedIn() {
            return window.App.signedIn;
        }

    },

    methods: {

        addReply() {
            axios.post(this.endpoint, { body: this.body })
                .catch(error => {
                       flash(error.response.data.body[0],'danger');
                    })
                    .then(({data}) => {
                         this.body = '';
                       
                         this.$emit('created', data);
                     });
        }
    }



};

</script>