<template>
    <div>
        <div class="header">
            <h1>{{$t('ias.plan')}}</h1>
        </div>
        <div class="container">
            <div class="content">
                <div class="category_level">
                    <h3>
                        {{category.app_name}} {{$t('ias.plan')}}
                        <span style="padding-left: 20px; font-size: 24px">{{$t(category.price)}}</span>
                        <span class="float-right">{{$t(category.price)}}</span>
                    </h3>
                </div>
                <div style="padding-left: 20px; padding-top: 30px">
                    <form id="plan-form" method="POST">
                        <div id="step-1">
                            <div class="form-group">
                                <label for="order_number">{{$t('order_number')}}</label>
                                <input type="text" class="form-control" id="order_number" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="dealer_name">{{$t('dealer_name')}}</label>
                                <input type="text" class="form-control" id="dealer_name" name="dealer_name"/>
                            </div>
                            <div class="form-group">
                                <label for="dealer_charge_surname">{{$t('dealer_charge_surname')}}</label>
                                <input type="text" class="form-control" id="dealer_charge_surname" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="middle_name_in_charge_of_dealer">{{$t('middle_name_in_charge_of_dealer')}}</label>
                                <input type="text" class="form-control" id="middle_name_in_charge_of_dealer" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_name">{{$t('customer_name')}}</label>
                                <input type="text" class="form-control" id="customer_name" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_surname">{{$t('customer_surname')}}</label>
                                <input type="text" class="form-control" id="customer_surname" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_middle_name">{{$t('customer_middle_name')}}</label>
                                <input type="text" class="form-control" id="customer_middle_name" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_facility">{{$t('customer_facility')}}</label>
                                <input type="text" class="form-control" id="customer_facility" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_department">{{$t('customer_department')}}</label>
                                <input type="text" class="form-control" id="customer_department" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_address">{{$t('customer_address')}}</label>
                                <input type="text" class="form-control" id="customer_address" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_city">{{$t('customer_city')}}</label>
                                <input type="text" class="form-control" id="customer_city" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_prefecture">{{$t('customer_prefecture')}}</label>
                                <input type="text" class="form-control" id="customer_prefecture" name="order_number"/>
                            </div>
                            <div class="form-group">
                                <label for="customer_country">{{$t('customer_country')}}</label>
                                <input type="text" class="form-control" id="customer_country" name="order_number"/>
                            </div>
                            <div class="form-group float-right">
                                <b-button variant="outline-secondary" style="margin: 5px" :to="{name: $t('dealer.url')}">{{$t('back')}}</b-button>
                                <b-button id="next" style="margin: 5px" variant="outline-secondary">{{$t('next')}}</b-button>
                            </div>
                        </div>
                        <div id="step-2" class="d-none">
                            <div style="padding-left: 20px">
                                <h5>{{$t('terms_and_conditions')}} <b-button variant="outline-secondary">{{$t('here')}}</b-button></h5>
                            </div>
                            <div class="payment_method">
                                <h4>{{$t('contracted_payment_terms_title')}}</h4>
                                <div class="text-center">
                                    {{$t('contracted_payment_terms_description1')}}
                                    {{$t('contracted_payment_terms_description2')}}
                                    {{$t('contracted_payment_terms_description3')}}
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <b-button id="back" style="margin: 5px" variant="outline-secondary">{{$t('back')}}</b-button>
                                <b-button id="subscribe" style="margin: 5px" variant="outline-secondary">{{$t('subscribe')}}</b-button>
                            </div>
                        </div>
                    </form>
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
                console.log("this is komoju token")
                console.log(token.id)
                this.komojuToken = token.id
                this.komoju_purchase()
            }
        })

        document.getElementById("next").addEventListener("click", function() {
            document.getElementById("step-1").classList.add("d-none");
            document.getElementById("step-2").classList.remove("d-none");
        });

        document.getElementById("back").addEventListener("click", function() {
            document.getElementById("step-1").classList.remove("d-none");
            document.getElementById("step-2").classList.add("d-none");
        });

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
        async getCategorydata(app_id, cat_id) {
            const {data} = await axios.get('/api/get/checkout/category/'+app_id+'/'+cat_id)
            this.category = data;

            console.log(this.category)
        },

        //paypal button
        setLoaded:function() {
            console.log("paypal_button")
            var user_id = this.user.id
            var app_id = this.$route.query.app_id;
            var cat_id = this.$route.query.cat_id;
            var amount = this.amount
            var router = this.$router
            
            console.log(app_id)
            console.log(cat_id)
            console.log(amount)

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
                    console.log(data)
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
                                app_id: app_id,
                                cat_id: cat_id,
                            }).then((res) => {
                                console.log(res)
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
            var amount = this.amount
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
    .content .payment_method h4,
    .content .payment_information_form h4 {
        font-weight: 700;
        padding: 15px 0;
    }
    .form-group {
      display: flex;
    }
    .form-group label {
      float: left;
      width: 40%;
    }
    .form-group .form-control {
      width: 30%;
      float: left;
    }
    
</style>
