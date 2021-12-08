<template>
    <div>
        <div class="card">
            <div class="card-header"></div>

            <div class="card-body">
                <h3 style="margin-left: 10px">{{post.id}}. {{post.title}}</h3>
                <hr>
                <p>{{post.content}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "PostItem",
    data() {
        return {
            post: {}
        }
    },
    props: ['id'],

    methods: {
        getPost(){
            axios.get('/api/post/'+this.id)
                .then((response) => {
                    console.log(response.data)
                    this.post = response.data
                })
        },
    },

    created(){
        this.getPost()
    }
}
</script>

<style scoped>
p {
    padding-left: 100px;
    padding-right: 100px;
}
</style>
