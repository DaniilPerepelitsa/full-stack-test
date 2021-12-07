<template>
    <div>
        <h1>Posts</h1>
        <div class="card" style="border: 1px solid black; margin-top: 30px; margin-bottom: 15px; border-radius: 30px" v-for="post in posts">
            <div class="card-header"></div>

            <div class="card-body">
                <p style="margin-left: 10px">{{post.id}}. {{post.title}}</p>
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
        }
    },
    props: ['id'],
    methods: {
        getPostsForCategory(id){
            axios.get('/api/categories/'+id+'/posts')
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

</style>
