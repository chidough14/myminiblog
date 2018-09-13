export default {
    state: {
       posts: [],
       userpost: [],
       numberLikes: ''
    },
    getters: {
        posts(state){
            return state.posts
        },
        userpost(state){
            return state.userpost
        },
        numberLikes(state){
            return state.numberLikes
        }
    },
    mutations: {
       getposts(state, payload){
            state.posts = payload
       },
       addpost(state, payload){
        state.posts = payload.concat(state.posts)
       },
       singlepost(state, payload){
        state.userpost = payload
       },
       editpost(state, payload){
        state.userpost = payload
       },
       getlikes(state, payload){
        state.numberLikes = payload
   },
   addlike(state){
    state.numberLikes = state.numberLikes + 1
},
unlike(state){
    state.numberLikes = state.numberLikes - 1
},
    }
}
