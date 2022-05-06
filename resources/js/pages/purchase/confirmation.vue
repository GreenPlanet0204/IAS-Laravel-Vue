<template>
    <div>
        <div class="header">
            <h1>{{$t('confirmation_title')}}</h1>
        </div>
        <div class="content">
            <div class="confirm_des container">
                <h5>{{$t('confirm_description')}}</h5>
            </div>
            <div class="details_content container">
                <div class="application_detail">
                    <h4>{{$t('application_information')}}</h4>
                    <div style="padding-left: 20px;">
                        <h6>{{$t('confirm_application_url_description')}}
                            <span class="category">
                                <router-link :to="confirmData.app_url">
                                    {{confirmData.app_name}}
                                </router-link>
                            </span>.
                        </h6>
                        <h6>{{$t('confirm_application_email_pass_description')}}
                            <span class="category">
                                <b-button variant="link" class="change" @click = "request_to_app">
                                    {{$t('request')}}
                                </b-button>
                            </span>.
                        </h6>
                        <h6>{{$t('confirm_application_name_description')}} <span class="category">{{confirmData.app_name}}</span>.</h6>
                        <h6>{{$t('confirm_application_categorytab_description')}} <span class="category">{{confirmData.category_tab}}</span>.</h6>
                        <h6>{{$t('confirm_application_capacity_description')}} <span class="category">{{confirmData.capacity}}{{confirmData.capacity_unit}}</span>.</h6>
                        <h6>{{$t('confirm_application_period_description')}} <span class="category">{{confirmData.period_date}} {{$t('days')}}</span>.</h6>
                    </div>
                </div>                
                <div class="division"></div>                
                <div class="transaction_detail">
                    <h4>{{$t('transaction_information')}}</h4>
                    <div style="padding-left: 20px;">
                        <h6>{{$t('confirm_transaction_url_description')}}
                            <span class="category">
                                <router-link :to="{ name: $t('transaction.url') }">
                                    {{ $t('transaction.text') }}
                                </router-link>
                            </span>.
                        </h6>
                        <h6>{{$t('confirm_transaction_id_description')}} <span class="category">{{confirmData.transaction_id}}</span> {{$t('confirm_transaction_create_date_description')}} <span class="category">{{confirmData.created_at}}</span>.</h6>
                        <h6>{{$t('confirm_transaction_price_description')}} <span class="category">{{$t(confirmData.transaction_price)}}</span>.</h6>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</template>
<script>    
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import swal from 'sweetalert2/dist/sweetalert2.js'

    export default {
        data: () => ({
            confirmData: []
        }),
        created() {
            var transID = this.$route.query.transaction_id
            this.getconfirmDataByTransId(transID)
        },
        methods: {
            async getconfirmDataByTransId(id){
                const {data} = await axios.get('/api/get/checkout/confirmData/'+id)
                console.log(data)
                this.confirmData = data
            },
            async request_to_app() {
                console.log("this is request to app message.")
                await axios.post('/api/post/requestToApp', this.confirmData).then(()=> {
                    swal.fire({
                        icon: 'success',
                        title: this.$t('successTitle'),
                        text: this.$t('successEmailText'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    })
                })
            }
        },
        computed: mapGetters({
            user: 'auth/user'
        })

    }
</script>

<style scoped>
    .header {
        width: 100%;
        background-color: #211F40;
        height: 150px;
    }
    .header h1 {
        padding-top: 3rem;
        text-align: center;
        color: #fff;
        font-weight: 600;
    }
    .content {
        width: 100%;
        padding-top: 50px;
    }
    .content .confirm_des {
        width: 70%;
        align: center;
    }
    .content .details_content {
        width: 90%;
        align: center;
        padding-top: 50px;
    }
    .content .confirm_des h5 {
        line-height: 1.5;
    }
    .content .application_detail h4,
    .content .transaction_detail h4 {
        font-weight: 700;
        padding: 15px 0;
    }
    .content .application_detail h6,
    .content .transaction_detail h6 {
        padding: 10px 0;
    }
    .content .application_detail .category,
    .content .transaction_detail .category {
        display: inline;
        font-size: 15px;
        font-weight: 700;
    }
    .content .division {
        border-bottom: 1px solid #0000006e;
        padding: 5px 0;
    }
    .content .choose_payment_method label {
        display: flex;
    }
    .content .choose_payment_method label img {
        padding-left: 10px;
        display: inline;
        height: 55px;
    }

</style>