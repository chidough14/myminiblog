<template>
   <div><h2>Home</h2>
       <add-post></add-post>
       <div v-for="(post, index) in posts" :key="index">
           <h5>Title: <span class="badge badge-primary">{{ post.title }}</span></h5>
           <h5>Posted by:
               <router-link :to="{name: 'profile', params: {id: post.user.id}}">{{ post.user.name }}</router-link>
            </h5>
           <h5>Body: </h5>
           <div class="card">
                <div class="card-body">
                    {{ post.body }}
                </div>
            </div>
            <router-link class="btn btn-success" :to="{name: 'single-post', params: {id: post.id}}">View</router-link>
            <hr>
       </div>

        <div class="pagination">
            <button class="btn btn-default" @click="fetchPagination(pagination.prev_page_url)" :disabled="!pagination.prev_page_url">
                Previous
            </button>
            <span>Page {{pagination.current_page}} of {{pagination.last_page }}</span>
            <button class="btn btn-default"  @click="fetchPagination(pagination.next_page_url)" :disabled="!pagination.next_page_url">
                Next
            </button>
        </div>


   </div>

</template>

<script>
import AddPost from './AddPost.vue'
  export default {
      components: {
         AddPost
      },
      data(){
         return {
             pagination: [],
             url: 'getposts'
         }
      },
      created(){
          this.getposts()
      },
      computed: {
          posts(){
              return this.$store.getters.posts
          }
      },
      methods: {
          makePagination(data){
              let pagination = {
                  current_page : data.current_page,
                  last_page : data.last_page,
                  next_page_url : data.next_page_url,
                  prev_page_url : data.prev_page_url
              }

              this.pagination = pagination
          },
          fetchPagination(url){
              this.url = url
              this.getposts()
          },
          getposts(){
             let $this = this
                axios.get(this.url)
                .then(response => {
                    //console.log(response)
                    //this.posts = response.data
                    this.$store.commit('getposts', response.data.data)
                    $this.makePagination(response.data)
                })
          }
      }
  }
</script>
