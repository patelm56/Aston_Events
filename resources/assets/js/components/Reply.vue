<template>
<div class="card mt-3">
  <div class="card-header">
    <div class="d-flex justify-content-space-around">
        <span class="mr-auto" v-text="data.owner.name">
        </span> 
       <div v-if="signedIn">
            <favorite-reply :reply="data"></favorite-reply>
        </div>
    </div>
  </div>
  <div class="card-body">
    <div v-if="editing"  class="card-text">
        <div class="form-group">
            <textarea class="form-control" v-model="body"></textarea>
        </div>
        <button class="btn btn-sm" @click="cancel">Cancel</button>
        <button class="btn btn-sm btn-primary" @click="update">Update</button>
    </div>
    <p v-else class="card-text" v-text="body"></p>
  </div>
  <div class="card-footer text-muted" v-if="canUpdate">
    <button class="btn btn-sm mr-1" @click="editing = true">Edit</button>
    <button class="btn btn-sm btn-danger" @click="remove">Delete</button>
  </div>
</div>
</template>

<script>
    import FavoriteReply from './FavoriteReply.vue';
    export default {
        
    props:['data'],

    components:{FavoriteReply},

    data() {
        return {
            editing: false,
            id: this.data.id,
            body: this.data.body
        };
    },

    computed: {
       signedIn() {
           return window.App.signedIn;
       },

       canUpdate() {
           return this.authorize( user => this.data.user_id == user.id);
       }
    },

    methods: {

        update() {
            axios.patch('/replies/' + this.id, {
                body: this.body
            });
            
            this.editing = false;

            flash('Updated');
        },

        remove() {
            axios.delete('/replies/' + this.id);

            this.$emit('deleted', this.id);
            
        },

        cancel() {
            this.editing = false;

            this.body = this.data.body;
        }
    }
};
</script>