<template>
    <users-component></users-component>
    <!-- <BlogPosts v-for="post in posts" :views="post.views" :title="post.title" :date="post.date" :content="post.content" :author="post.author" :category="post.category"/> -->
</template>

<script>
import UsersComponent from '../../components/dashboard/UsresComponent';
    export default {
        components:{UsersComponent},
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
