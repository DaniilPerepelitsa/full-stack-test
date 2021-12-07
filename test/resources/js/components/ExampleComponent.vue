<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Categories</div>

                    <div class="card-body">
                        <ul>
                            <li v-for="category in categories">
                                <router-link :to="{ name: 'posts', params: { id: category.id }}">{{category.id}}. {{category.name}}</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            posts: [],
            id: 0
        }
    },

    mounted() {
        axios.get('/api/categories').then((response) => {
            this.categories = response.data
        })
    }
}
</script>

<style scoped>
li{
    list-style: none;
    margin-bottom: 15px;
}
</style>
