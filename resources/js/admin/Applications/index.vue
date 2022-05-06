<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{$t('applications.title')}}</h1>
            <router-link
            :to="{name: 'admin.application.create'}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
            >{{$t('applications.create_new_application')}}</router-link>
        </div>

        <!-- Page Content -->
        
        <b-container fluid>
            <!-- User Interface controls -->
            <b-row>

                <b-col md="4" class="my-1">
                    <b-form-group
                    :label="$t('per_page')"
                    label-for="per-page-select"
                    label-cols-lg="4"
                    label-align-sm="center"
                    label-size="sm"
                    class="mb-0"
                    >
                        <b-form-select
                            id="per-page-select"
                            v-model="perPage"
                            :options="pageOptions"
                            size="sm"
                        ></b-form-select>
                    </b-form-group>
                </b-col>

                <b-col md="5"></b-col>

                <b-col md="3" class="my-1">
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                    ></b-pagination>
                </b-col>
            </b-row>

            <!-- Main table element -->
            <b-table
            responsive
            striped hover
            :items="items"
            :fields="fields"
            :current-page="currentPage"
            :per-page="perPage"
            stacked="md"
            show-empty
            small
            >
                <template #cell(index)="data">
                    {{data.index + 1}}
                </template>
                <template #cell(category_tab)="data">
                    <router-link :to="{name: 'app-update', query: {id: data.item.id}}">{{data.value}}</router-link>
                </template>
                <template #cell(price)="data">
                    {{$t(data.item.price)}}
                </template>
                <template #cell(discount)="data">
                    {{data.item.discount}} %
                </template>
                <template #cell(discount_price)="data">
                    {{$t(data.item.discount_price)}}
                </template>
                <template #cell(period_date)="data">
                    {{data.item.period_date}} days
                </template>
                <template #cell(capacity)="data">
                    {{data.item.capacity}}{{data.item.capacity_unit}}
                </template>
            </b-table>

            <b-row> 
                <b-col md="4" class="my-1">
                    <b-form-group
                    :label="$t('per_page')"
                    label-for="per-page-select"
                    label-cols-lg="4"
                    label-align-sm="center"
                    label-size="sm"
                    class="mb-0"
                    >
                        <b-form-select
                            id="per-page-select"
                            v-model="perPage"
                            :options="pageOptions"
                            size="sm"
                        ></b-form-select>
                    </b-form-group>
                </b-col>

                <b-col md="4"></b-col>

                <b-col md="3" class="my-1">
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                    ></b-pagination>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                items: '',
                fields: [
                { key: 'index', label: ''},
                { key: 'app_name', label: this.$root.$i18n.tc('applications.app_name')},
                { key: 'cat_id', label: this.$root.$i18n.tc('applications.cat_id')},
                { key: 'category_tab', label: this.$root.$i18n.tc('applications.cat_tab')},
                { key: 'price', label: this.$root.$i18n.tc('applications.price')},
                { key: 'discount', label: this.$root.$i18n.tc('applications.discount')},
                { key: 'discount_price', label: this.$root.$i18n.tc('applications.discount_price')},
                { key: 'period_date', label: this.$root.$i18n.tc('expire_date')},
                { key: 'capacity', label: this.$root.$i18n.tc('applications.capacity')}
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }]
            }
        },
        mounted() {
            // Set the initial number of items
            this.totalRows = this.items.length
        },
        methods: {
            async getApplications () {
                const { data } = await axios.get('/api/get/applications')
                this.items=data
                this.totalRows = this.items.length
            }
        },        
        created() {
            this.getApplications()
        }
    }
</script>

<style scoped>
</style>