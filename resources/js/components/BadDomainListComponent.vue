<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="#" class="btn btn-success float-right" @click="showModal">
                    <font-awesome-icon :icon="['fas','plus-square']"></font-awesome-icon>
                    Add
                </a>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <div>
                    <table class="table table-striped table-responsive-xl">
                        <thead>
                        <tr>
                            <th>ID
                                <a class="float-right" href="#" @click="setSorting('id')">
                                    <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                                </a>
                            </th>
                            <th>Name
                                <a class="float-right" href="#" @click="setSorting('user_agent')">
                                    <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                                </a>
                            </th>
                            <th>Created_at
                                <a class="float-right" href="#" @click="setSorting('created_at')">
                                    <font-awesome-icon :icon="['fas','sort']"></font-awesome-icon>
                                </a>
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="domain in bDomainList.data" :key="domain.id">
                            <td class="align-middle">{{domain.id}}</td>
                            <td class="align-middle">{{domain.name}}</td>
                            <td class="align-middle">{{domain.created_at ? domain.created_at: ''}}</td>
                            <td class="align-middle">
                                <font-awesome-icon class="text-secondary" :icon="['fas','edit']"></font-awesome-icon>
                                <font-awesome-icon @click="deleteDomain(domain.id)" class="text-danger" :icon="['fas','trash-alt']"></font-awesome-icon>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group row">
                                <label for="perPage"
                                       class="col-md-5 col-lg-4 col-sm-6 col-form-label col-form-label-sm text-right">Per
                                    page:</label>
                                <div class="col-md-7 col-sm-6 col-lg-4">
                                    <select class="form-control form-control-sm" id="perPage" v-model="perPage"
                                            @change="loadData">
                                        <option>3</option>
                                        <option>5</option>
                                        <option>10</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <my-pagination v-if="meta!==undefined && meta.last_page > 1" :meta="meta"
                                           @goto-page="onGoToPage">
                            </my-pagination>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <modal name="newBadDomain" @before-close="beforeCloseModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add new bad domain</h5>
                    <button type="button" class="close" @click="$modal.hide('newBadDomain')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control form-control-lg" type="text" placeholder="your.domain.com" v-model="newDomain">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="addNewDomain">Save</button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>

    import Pagination from './PaginationComponent'

    export default {
        components: {
            'my-pagination': Pagination
        },
        data: function () {
            return {
                bDomainList: [],
                // meta: {},
                sortBy: 'created_at',
                orderAsc: true,
                perPage: 3,
                newDomain: ''
            }
        },
        mounted() {
            this.loadData()

            console.log('Component mounted.')

        },
        methods: {
            onGoToPage: function (event) {
                this.loadData(event)
            },
            loadData: function (page = 1) {
                axios
                    .get('/api/bad-domain?page=' + page + '&sortby=' + this.sortBy + '&order=' + this.sortOrder + '&perpage=' + this.perPage)
                    .then(response => (this.bDomainList = response.data))
                    .finally(() => (console.log(this.bDomainList)));
            },
            setSorting: function (field) {
                if (this.sortBy == field) {
                    this.orderAsc = !this.orderAsc
                }
                else {
                    this.sortBy = field
                }

                this.loadData()

            },
            showModal: function () {
                this.$modal.show('newBadDomain');
            },
            beforeCloseModal: function(event)  {
                console.log('this will be called before the modal closes')
                this.newDomain = ''
            },

            addNewDomain: function () {

                axios
                    .post('/api/bad-domain', {name: this.newDomain
                    })
                    .then(()=>{

                        this.$modal.hide('newBadDomain')
                        this.loadData(this.meta.current_page)
                        alert('New bad domain successfully added')

                        }

                    )
                    .catch((e) => (console.log(e)))
            },
            deleteDomain: function (domainId) {
                axios.delete('/api/bad-domain/'+domainId)
                    .then(()=>
                    {
                        alert('Bad domain successfully deleted')
                      this.loadData(this.meta.current_page)
                    })
                    .catch((e) => (console.log(e)))
            }
        },
        computed: {
            meta: function () {
                return this.bDomainList.meta
            },
            sortOrder: function () {
                return this.orderAsc == true ? 'ASC' : 'DESC'
            }

        }


    }
</script>
