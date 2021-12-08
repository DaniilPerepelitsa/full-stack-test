<template>
    <div>
        <h1>Posts</h1>
        <input type="text" class="form-control" placeholder="enter text" v-model="searchText">
        <button class="btn btn-outline-success" @click="searchPosts(searchText)">Search</button>
        <div class="card" style="border: 1px solid black; margin-left: 100px; margin-right: 100px; margin-top: 30px; margin-bottom: 15px; border-radius: 30px" v-for="post in posts">
            <div class="card-header"></div>

            <div class="card-body">
                <router-link :to="{name: 'show-post', params: { id: post.id }}">
                    <p style="margin-left: 10px">{{post.id}}. {{post.title}}</p>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Posts",
    data() {
        return {
            posts: [],
            searchText: ''
        }
    },
    props: ['id'],
    methods: {
        getPostsForCategory(id){
            axios.get('/api/categories/'+id+'/posts')
                .then((response) => {
                    this.posts = response.data
                })
        },
        searchPosts(text){
            axios.post('/api/posts/search', { search: text, id: this.id })
                .then((response) => {
                    this.posts = response.data
                })
        }
    },
    created() {
        this.getPostsForCategory(this.id);
    },
}
</script>

<style scoped>
p {
    padding-left: 100px;
    padding-right: 100px;
}
</style>
