<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(post)">
            <i class="bi bi-bookmark-fill" style="font-size: 1.5em;"></i>
        </a>
        <a href="#" v-else @click.prevent="favorite(post)">
           <i class="bi bi-bookmark" style="font-size: 1.5em;"></i>
        </a>
    </span>
</template>

<script>
    export default {
        props: ['post', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/'+post)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
