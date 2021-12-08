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

        <pagination v-model="indexCurrentPage" :records="total" :per-page="perPage" :pages="lastPage" @paginate="getPostsForCategory(id, indexCurrentPage)"></pagination>
    </div>
</template>

<script>
export default {
    name: "Posts",
    data() {
        return {
            pager: [],
            searchText: '',
            perPage: 0,
            lastPage: 0,
            indexCurrentPage: 1,
            total: 0,
        }
    },
    computed: {
        posts(){
            return this.pager.data || [];
        },
        currentPage(){
            return this.indexCurrentPage = this.pager.current_page;
        }
    },
    props: ['id'],
    methods: {
        getPostsForCategory(id, page = 1){
            axios.get('/api/categories/'+this.id+'/posts?page='+page)
                .then((response) => {
                    this.pager = response.data
                    this.perPage = response.data.per_page
                    this.lastPage = response.data.last_page
                    this.indexCurrentPage = response.data.current_page
                    this.total = response.data.total
                })
        },
        searchPosts(text){
            axios.post('/api/posts/search', { search: text, id: this.id })
                .then((response) => {
                    this.pager = response.data
                    this.perPage = response.data.per_page
                    this.lastPage = response.data.last_page
                    this.indexCurrentPage = response.data.current_page
                    this.total = response.data.total
                })
        },
        setPage(page){
            this.currentPage = page;
        }
    },
    created() {
        this.getPostsForCategory(this.id);
    }
}
</script>

<style scoped>
p {
    padding-left: 100px;
    padding-right: 100px;
}
</style>
