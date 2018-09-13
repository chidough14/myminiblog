<template>
    <div class="main-wrapper">
        <button class="btn btn-sm btn btn-success" @click="showEditForm">Edit Post</button>

        <div class="addform-wrapper" v-if="showForm">
                <div class="addform">
                    <div class="mb-2 clearfix">
                        <div class="float-right">Edit Post</div>
                        <div class="float-left cursor"  @click="showForm = false">Close</div>
                    </div>
                </div>

                <form @submit.prevent="updatepost">
                    <div class="form-group">
                        <input type="text" placeholder="Title" v-model="post.title" class="form-control">
                    </div>

                    <div class="form-group">
                        <textarea placeholder="Body"  class="form-control" v-model="post.body" ></textarea>
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
    created(){
        this.getpost()
    },
    props: ['postid'],
    methods: {
      showEditForm(){
         this.showForm = true
      },
      getpost(){
          axios.get('getpost/'+ this.postid)
          .then(response => {
              console.log(response)
              this.post = response.data[0]
          })
      },
      updatepost(){
          axios.patch('updatepost/'+ this.postid, {
              title: this.post.title,
              body: this.post.body
          })
          .then(response => {
              //console.log(response)
               this.post.title = ''
                this.post.body = ''
                this.showForm = false
              this.$store.commit('editpost', response.data[0])
          })
      }
    },
    data(){
        return {
            showForm: false,
            post: ''
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

