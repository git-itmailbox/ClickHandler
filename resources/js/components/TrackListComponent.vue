<template>
    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID CLICK
                    <a class="float-right" href="#" @click="setSorting('id')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>User agent
                    <a class="float-right" href="#" @click="setSorting('user_agent')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>IP
                    <a class="float-right" href="#" @click="setSorting('ip')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>Ref
                    <a class="float-right" href="#" @click="setSorting('ref')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>Param1
                    <a class="float-right" href="#" @click="setSorting('param1')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>Param2
                    <a class="float-right" href="#" @click="setSorting('param2')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>Errors /
                    <a class="float-right" href="#" @click="setSorting('error')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                    <br/> Bad domain
                    <a class="float-right" href="#" @click="setSorting('bad_domain')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
                <th>Created_at
                    <a class="float-right" href="#" @click="setSorting('created_at')">
                        <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="click in clickList.data" :key="click.id">
                <td class="align-middle">{{click.id}}</td>
                <td class="align-middle">{{click.user_agent}}</td>
                <td class="align-middle">{{click.ip}}</td>
                <td class="align-middle">{{click.ref}}</td>
                <td class="align-middle">{{click.param1}}</td>
                <td class="align-middle">{{click.param2}}</td>
                <td class="bg-secondary align-middle">
                    <span class="text-warning">{{click.error}} </span> / <span
                    class="text-danger">{{click.bad_domain}}</span>
                </td>
                <td class="align-middle">{{click.created_at.date}}</td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-4">
                <div class="form-group row">
                    <label for="perPage" class="col-md-5 col-lg-4 col-sm-6 col-form-label col-form-label-sm text-right">Per page:</label>
                    <div class="col-md-7 col-sm-6 col-lg-4">
                        <select class="form-control form-control-sm" id="perPage" v-model="perPage" @change="loadData">
                            <option>3</option>
                            <option>5</option>
                            <option>10</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <my-pagination v-if="meta!==undefined && meta.last_page > 1" :meta="meta" @goto-page="onGoToPage">
                </my-pagination>
            </div>
        </div>

    </div>

</template>

<script>

    import Pagination from './PaginationComponent'

    export default {
        components: {
            'my-pagination':Pagination
        },
        data: function () {
            return {
                clickList: [],
                // meta: {},
                sortBy : 'created_at',
                orderAsc : true,
                perPage : 3
            }
        },
        mounted() {
            this.loadData()

            console.log('Component mounted.')

        },
        methods: {
            onGoToPage: function (event){
                this.loadData(event)
            },
            loadData: function (page=1) {
                axios
                    .get('/api/clicks?page='+ page + '&sortby=' + this.sortBy + '&order='+ this.sortOrder+ '&perpage='+ this.perPage)
                    .then(response => (this.clickList = response.data))
                    .finally(() => (console.log(this.clickList)));
            },
            setSorting: function(field){
                if (this.sortBy == field)
                {
                    this.orderAsc = !this.orderAsc
                }
                else
                {
                    this.sortBy = field
                }

                this.loadData(1)

            }
        },
        computed: {
          meta: function () {return this.clickList.meta},
          sortOrder:  function() {return this.orderAsc ==true ? 'ASC': 'DESC'}

        }


    }
</script>
