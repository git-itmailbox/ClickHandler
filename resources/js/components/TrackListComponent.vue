<template>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID CLICK</th>
            <th>User agent</th>
            <th>IP</th>
            <th>Ref</th>
            <th>Param1</th>
            <th>Param2</th>
            <th>Errors / <br /> Bad domain</th>
            <th>Created_at</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="click in clickList" :key="click.id">
            <td class="align-middle" >{{click.id}}</td>
            <td class="align-middle" >{{click.user_agent}}</td>
            <td class="align-middle" >{{click.ip}}</td>
            <td class="align-middle" >{{click.ref}}</td>
            <td class="align-middle" >{{click.param1}}</td>
            <td class="align-middle" >{{click.param2}}</td>
            <td class="bg-secondary align-middle">
                <span class="text-warning">{{click.error}} </span> / <span class="text-danger">{{click.bad_domain}}</span>
            </td>
            <td class="align-middle">{{click.created_at}}</td>
        </tr>
        </tbody>
    </table>

</template>

<script>
    export default {
        data: function() {
            return {
                clickList: []
            }
        },
        mounted() {

            this.loadData();

            console.log('Component mounted.')
        },
        methods: {

            loadData : function () {
                axios
                    .get('/api/clicks')
                    .then(response => (this.clickList = response.data))
                    .finally(()=>(console.log(this.clickList)));
            }
        }
    }
</script>
