<template>
    <ul class="pagination">
        <!--<li class="page-item " :class="{disabled:currentPage==1}">-->
            <!--<a class="page-link" href="#" tabindex="-1">Previous</a>-->
        <!--</li>-->
        <li class="page-item" v-for="pageNum in pageNums" :class="{ active:meta.current_page==pageNum}">
            <a v-if="meta.current_page!=pageNum" class="page-link" href="#" @click="$emit('goto-page',pageNum)">{{pageNum}}</a>
            <a v-else-if="meta.current_page==pageNum" class="page-link" href="#">{{pageNum}}</a>
        </li>
        <!--<li class="page-item">-->
            <!--<a class="page-link" :class="{disabled:currentPage==meta.last_page}" href="#">Next</a>-->
        <!--</li>-->
    </ul>

</template>

<script>
    export default {
        props: {
          meta:{
              type: Object,
              required: true
          }
        },
        data: function() {
            return {
                currentPage: 2,
                offset: 4
            }
        },
        mounted() {
                console.log(this.meta)
        },
        methods: {

        },
        computed: {
            pageNums: function() {
                if (!this.meta.to) {
                    return [];
                }
                let from = this.meta.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 3);
                if (to >= this.meta.last_page) {
                    to = this.meta.last_page;
                }
                let pagesArray = [];
                for (let page = from; page <= to; page++) {
                    pagesArray.push(page);
                }
                return pagesArray;
            }
        }
    }
</script>
