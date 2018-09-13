<template>



    <div>
        <div v-if="userpost.user.id == loggedInUser">
             <span class="badge badge-secondary"><h4><b>Title:</b>{{userpost.title}}</h4></span><br>
             <span class="badge badge-secondary"><h4><b>Posted by:</b>{{userpost.user.name}}</h4></span>
            <h4>Body:</h4>
            <div class="card">
                <div class="card-body">
                    {{ userpost.body }}
                </div>
            </div>

            <edit-post :postid="userpost.id"></edit-post>

        </div>

        <div v-else>
             <span class="badge badge-secondary"><h4><b>Title:</b>{{userpost.title}}</h4></span><br>
             <span class="badge badge-secondary"><h4><b>Posted by:</b>{{userpost.user.name}}</h4></span>
            <h4>Body:</h4>
            <div class="card">
                <div class="card-body">
                    {{ userpost.body }}
                </div>
            </div>
            <button class="btn btn-success" @click="likepost(userpost.id)" v-if="ifLiked < 1"><i class="fa fa-thumbs-up"></i></button>
            <button class="btn btn-warning" @click="unlikepost(userpost.id)" v-else><i class="fa fa-thumbs-down"></i></button>

            <span>{{numberLikes}}</span>
            <button class="btn btn-primary" @click.prevent="sharepost(userpost.id, userpost.title, userpost.user.name, userpost.user.id)" v-if="isShared < 1">
                <i class="fa fa-share"></i>
                </button>

                <button class="btn btn-danger" @click.prevent="unsharepost(userpost.id)" v-else>
                <i class="fa fa-reply"></i>
                </button>
        </div>
    </div>
</template>

<script>
import EditPost from './EditPost.vue'
export default {
    components: {
       EditPost
    },
    created(){
        this.getpost()
        this.getLoggedInUser()
        this.getlikes()
        this.checklikes()
        this.checkshared()
    },
    computed: {
      userpost(){
          return this.$store.getters.userpost
      },
      numberLikes(){
           return this.$store.getters.numberLikes
       }
    },
    data(){
        return {
            loggedInUser: '',
            ifLiked: '',
            isShared: ''
        }
    },
    methods: {
        getpost(){
            axios.get('getsinglepost/'+ this.$route.params.id)
            .then(response => {
                //console.log(response)
                this.$store.commit('singlepost', response.data[0])
            })
        },
        getLoggedInUser(){
            axios.get('getloggedinuser')
            .then(response => {
                //console.log(response)
                this.loggedInUser = response.data
            })
        },
        likepost(id){
            axios.post('likepost', {
                postid: id
            })
            .then(response => {
                //console.log(response)
                this.$store.commit('addlike')
                this.ifLiked++
            })
        },
        unlikepost(id){
            axios.post('unlikepost', {
                postid: id
            })
            .then(response => {
                //console.log(response)
                this.$store.commit('unlike')
                this.ifLiked--
            })
        },
        getlikes(){
            axios.get('getlikes/'+this.$route.params.id)
            .then(response => {
                //console.log(response)
                this.$store.commit('getlikes', response.data)
            })
        },
         checklikes(){
            axios.get('checklikes/'+this.$route.params.id)
            .then(response => {
                //console.log(response)
               this.ifLiked = response.data
            })
        },
        sharepost(postid, posttitle, postersname, postersid){
           axios.post('sharepost', {
               postid: postid,
               posttitle: posttitle,
               postersname: postersname,
               postersid: postersid
           })
            .then(response => {
                console.log(response)
                this.isShared++
            })
        },
        unsharepost(id){
             axios.get('unsharepost/'+id)
            .then(response => {
                console.log(response)
                this.isShared--
            })
        },
        checkshared(){
            axios.get('checkshared/'+this.$route.params.id)
            .then(response => {
                console.log(response)
                this.isShared = response.data
            })
        }
    }
}
</script>

