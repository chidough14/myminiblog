<template>
    <div class="main-wrapper">
        <button class="btn btn-sm btn btn-primary" @click="showAddForm">Add Post</button>

        <div class="addform-wrapper"  v-if="showform">
                <div class="addform">
                    <div class="mb-2 clearfix">
                        <div class="float-right">Add Post</div>
                        <div class="float-left cursor"  @click="showform = false">Close</div>
                    </div>
                </div>

                <form @submit.prevent="savepost">
                    <div class="form-group">
                        <input type="text" placeholder="Title" v-model="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <textarea placeholder="Body"  v-model="body" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>

        </div>
    </div>
</template>

<script>
export default {
    methods: {
         showAddForm(){
             this.showform = true
         },
         savepost(){
             axios.post('addpost', {
                 title: this.title,
                 body: this.body
             })
             .then(response => {
                 //console.log(response)
                this.title = ''
                this.body = ''
                this.showform = false
                this.$store.commit('addpost', response.data)
             })
         }
    },
    data(){
        return {
            showform: false,
            title: '',
            body: ''
        }
    }
}
</script>

<style scoped lang="scss">
    .main-wrapper {
         position: relative;
    }

    .addform-wrapper {
        position: absolute;
        top: -50px;
        z-index: 999;
        background-color:white;
        padding: 1rem;
        border: 1px solid #efefef;
        min-width: 29rem;
    }

    .addform {

    }
</style>

