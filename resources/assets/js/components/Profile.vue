<template>
    <div>
        <h3>User Profile</h3>
        <img  :src="pic" width="100" height="100"/>
        <p><b>Name: </b>{{ user.name }}</p>
        <p><b>Email: </b>{{ user.email }}</p>

        <h4> Posted Topics</h4>
        <ul>
            <li v-for="(post, index) in posts" :key="index">
                {{ post.title }}
            </li>
        </ul>

        <div v-if="loggedInUser != user.id">
            <button class="btn btn-success" @click.prevent="followuser(user.id)" v-if="checkifFollowed < 1"><i class="fa fa-user-plus"></i></button>
             <button class="btn btn-warning" @click.prevent="unfollowuser(user.id)" v-else><i class="fa fa-user-times"></i></button>
        </div>

        <div v-else>
            <div>
                <input type="file"  v-on:change="onChange" class="form-control" >
            </div>

            <div>
                <button class="btn btn-success" @click="uploadphoto">Change Image</button>
            </div>

            <h4>Posts Shared with you</h4>

            <ul>
                <li v-for="(sh, index) in shared" :key="index">
                    <router-link :to="{name: 'single-post', params: {id: sh.post_id}}">{{ sh.post_title }}</router-link>
                     posted by
                      <router-link  :to="{name: 'profile', params: {id: sh.post_user_id}}">{{ sh.posted_by}}</router-link>
                       shared by

                     <router-link :to="{name: 'profile', params: {id: sh.user_id}}">{{ sh.shared_by}}</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
   created(){
       this.getuser()
       this.getuserposts()
       this.getloggedinuser()
       this.checkfollowed()
       this.getfollows()
   },
   data(){
       return {
           user: [],
           pic: '',
           posts: [],
           image: '',
           loggedInUser: '',
           checkifFollowed: '',
           shared: ''
       }
   },
   methods: {
       getuser(){
           axios.get('getuser/'+ this.$route.params.id)
           .then(response => {
               //console.log(response)
               this.user = response.data
               this.pic = 'img/'+ response.data.image
           })
       },
        getuserposts(){
           axios.get('getuserposts/'+ this.$route.params.id)
           .then(response => {
               //console.log(response)
               this.posts = response.data
           })
       },
       getloggedinuser(){
           axios.get('getloggedinuser')
            .then(response => {
                //console.log(response)
                this.loggedInUser = response.data
            })
       },
       onChange(e){
           let files = e.target.files || e.dataTransfer.files

           if (!files.length)
           return

           this.createImage(files[0])
       },
       createImage(file){
            let reader = new FileReader()
            let vm = this
            reader.onload = (e) => {
                vm.image = e.target.result
            }

            reader.readAsDataURL(file)
       },
       uploadphoto(){
           axios.post('saveimage', {
               image: this.image
           })
           .then(response => {
               //console.log(response)
               this.pic = 'img/'+ response.data.image
           })
       },
       followuser(id){
          axios.post('followuser', {
               id: id
           })
           .then(response => {
               //console.log(response)
               this.checkifFollowed++
           })
       },
        unfollowuser(id){
             axios.get('unfollowuser/'+id)
           .then(response => {
               //console.log(response)
               this.checkifFollowed--
           })
       },
       checkfollowed(){
         axios.get('checkfollowed/'+this.$route.params.id)
           .then(response => {
               //console.log(response)
               this.checkifFollowed = response.data
           })
       },
       getfollows(){
           axios.get('getfollow/'+this.$route.params.id)
           .then(response => {
               console.log(response)
               this.shared = response.data
           })
       }
   }
}
</script>

