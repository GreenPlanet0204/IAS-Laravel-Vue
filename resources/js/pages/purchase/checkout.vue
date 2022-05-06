<template>
    <div>
        <div class="header">
            <h1>{{$t('checkout_title')}}</h1>
        </div>
        <div class="container">
            <div class="content">
                <div class="category_level">
                    <h4>{{$t('category_level')}} <router-link class="change" :to="{name: $t('purchase.url')}">{{$t('change')}}</router-link></h4>
                    <div style="padding-left: 20px;">
                        <h6>{{$t('category_application_description')}} <span class="category">{{category.app_name}}</span>.</h6>
                        <h6>{{$t('category_select_description')}} <span class="category">{{category.category_tab}}</span>.</h6>
                        <h6>{{$t('category_price_description')}} <span class="category">{{$t(category.price)}}</span>.</h6>
                        <h6>{{$t('category_capacity_description')}} <span class="category">{{category.capacity}}{{category.capacity_unit}}</span>.</h6>
                        <h6>{{$t('category_period_description')}} <span class="category">{{category.period_date}} {{$t('days')}}</span>.</h6>
                    </div>
                </div>
                <div class="division"></div>
                <div class="choose_payment_method">
                    <h4>{{$t('choose_payment_method_title')}}</h4>
                    <div v-if="locale=='jp'" class="row" style="padding-left: 20px;">
                        <div class="col-md-12">                            
                            <form id="komoju-form" @submit.prevent="komoju_purchase" method="post">
                                <div class="payment_information_form" style="padding-top: 15px;">
                                    <div style="padding: 0 40px;">
                                    <input type="hidden" v-model="komojuToken" name="komojuToken" />
                                        <div class="col-md-12 paypal-button">
                                            <b-button id="komojuButton" variant="primary" :disabled="paymentProcessing">
                                                <b-spinner small :hidden="!paymentProcessing"></b-spinner>
                                                フリコミによるチェックアウト
                                            </b-button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div v-else class="row" style="padding-left: 20px;">
                        <div class="col-md-12">                            
                            <form @submit.prevent="paypal_payment_post" method="post">
                                <div class="payment_information_form" style="padding-top: 15px;">
                                    <div style="padding: 0 40px;">
                                        <div class="col-md-12 paypal-button">
                                            <!-- Submit Button -->
                                            <div ref="paypal"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
        stripe: {},
        cardElement: {},
        customer: {
            name : '',
            email: '',
            //first_name: '',
            //last_name: '',
            //email: '',
            //address: '',
            //city: '',
            //state: '',
            //zip_code: ''
        },
        category: '',
        paymentProcessing: false,
        //payment form display
        form_display: 'komoju',
        komojuToken: '',
        amount: ''
    }),
    mounted() {        
        //paypal button section
        const script_paypal = document.createElement("script")
        const ClientID = process.env.MIX_PAYPAL_SANDBOX_CLIENT_ID
        console.log(ClientID)

        script_paypal.setAttribute(`src`,`https://www.paypal.com/sdk/js?client-id=${ClientID}&currency=USD`)
        script_paypal.setAttribute(`data-namespace`,`paypal_sdk`)
        script_paypal.addEventListener("load", this.setLoaded)
        document.body.appendChild(script_paypal)

        //komoju payment button
        const script_komoju = document.createElement("script")

        script_komoju.setAttribute(`src`, `https://multipay.komoju.com`)
        document.body.appendChild(script_komoju)

        console.log(script_komoju)

        console.log("komoju_button") 

        var payForm = document.getElementById("komoju-form") 
        var amount = this.amount
        const komoju_pu_key = 'pk_9e17c1ee95a8ca65eafbca819189907a6d0ebd0c'

        console.log(komoju_pu_key)
        console.log(amount)

        var handler = Komoju.multipay.configure({
            key: komoju_pu_key,
            token: function(token) {
                this.komojuToken = token.id
                payForm.komojuToken.value = token.id
                this.komoju_purchase()
            }
        })

        document.getElementById("komojuButton").addEventListener("click", function(e) {
            console.log("komoju button click")
            handler.open({
                amount: amount,
                endpoint: "https://komoju.com",
                currency: "JPY",
                methods: [
                    "credit_card","konbini","bank_transfer","pay_easy","web_money","bit_cash","net_cash","japan_mobile","paypay","linepay","merpay","nanaco","dospara","steam_prepaid_card"
                    ],
            });
            e.preventDefault();
        });
    },
    methods: {
        //paypal button
        setLoaded:function() {
            console.log("paypal_button")
            var user_id = this.user.id
            var app_id = this.category.id
            var amount = this.category.price
            var router = this.$router
            paypal_sdk.Buttons({
                style: {
                    shape: 'pill',
                    label: 'checkout'
                },

                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{"amount":{"currency_code":"USD","value":amount}}]
                    });
                },

                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {
                        
                        // Full available details
                        console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                        //Save transaction history  
                        if(orderData.status == 'COMPLETED')  {
                            axios.post('/api/payment/checkout/transaction/save/', {
                                transaction: orderData.purchase_units[0].payments.captures[0],
                                payer: orderData.payer,
                                payee: orderData.purchase_units[0].payee,
                                user_id: user_id,
                                app_id: app_id
                            }).then((res) => {
                                const data = res.data
                                router.push({name: 'confirmation', query: {transaction_id: res.data}})
                            })
                        }
                        
                        // Or go to another URL:  actions.redirect('thank_you.html');
                        
                    });
                },

                onError: function(err) {
                    console.log(err);
                }

            }).render(this.$refs.paypal)
        },

        async komoju_purchase() { 
            
            console.log("komoju button successful pass") 

            var user_id = this.user.id
            var app_id = this.category.id
            var amount = this.category.price
            var router = this.$router
            var token = this.komojuToken

            var querystring = require('querystring')
            //var https = require('https')
            var secret_key = 'sk_123456'
            var auth = 'Basic ' + Buffer.from(secret_key + ':').toString('base64')

            var komoju_post_data = querystring.stringify({
                'amount': amount,
                'currency': 'JPY',
                'payment_details': token
            })

            console.log(komoju_post_data)

            var post_options = {
                host: 'komoju.com',
                port: '443',
                path: '/api/v1/payments',
                method: 'POST',
                headers: {
                    'Authorization': auth,
                    'Content-Length': Buffer.byteLength(komoju_post_data)
                }
            }
            console.log("komoju post option success")

            var post_req = axios.request(post_options, function(res) {
                res.setEncoding('utf8')
                res.on('data', function (chunk) {
                    console.log(chunk)
                })
            })          
        },

        async getCategorydata(app_id, cat_id) {
            const {data} = await axios.get('/api/get/checkout/category/'+app_id+'/'+cat_id)
            this.category = data;
        },
        async furikomi_payment_post() {
            this.paymentProcessing = true
            var {data} = await axios.post('/api/payment/furikomi/checkout/send', {
                email: this.customer.email,
                price: this.category.price
            })
            this.paymentProcessing = false
        }
    },
    created() {
        var app_id = this.$route.query.app_id;
        var cat_id = this.$route.query.cat_id;
        this.amount = this.$route.query.amount;
        this.getCategorydata(app_id, cat_id)
        this.customer.name = this.user.name
        this.customer.email = this.user.email
        this.locale = this.$root.$i18n.locale
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
    .content .category_level h4,
    .content .choose_payment_method h4,
    .content .payment_information_form h4 {
        font-weight: 700;
        padding: 15px 0;
    }
    .content .category_level h6 {
        padding: 10px 0;
    }
    .content .category_level .change {
        display: inline;
        font-size: 12px;
        color: #007FED;
    }
    .content .category_level .category {
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
    .content .payment_information_form .paypal-button {
        display: flex;
        justify-content: space-around;
    }
    .content .payment_information_form .paypal-button div {
        width: 50%;
    }

</style>