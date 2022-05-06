<template>
    <div class="container ias">
        <div class="title">
            <h2>{{$t('ias_title')}}</h2>
        </div>
        <div class="body row">
            <div class="body-pannel col-md-3 col-sm-12">
                
                <div class="pannel" :style="{'border': ias_name == true && ias_cat_id == 1 ? '#007FED 2px solid' : ''}">
                    <div class="head">
                        <h4>{{$t('ias_1_month')}}</h4>
                        <h6>500G</h6>
                    </div>
                    <div class="cost">
                        <h2 style="display: false;">{{$t('360')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_license')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_500server')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_chat')}}</li>
                        </ul>
                    </div>
                    <div class="foot">
                        <b-button variant="outline-primary" :to="{name: 'checkout', query: {app_id: '1', cat_id: '1', amount: '36000'}}">{{$t('subscribe')}}</b-button>
                    </div>
                </div>
            </div>
            <div class="body-pannel col-md-3 col-sm-12">
                <div class="pannel" :style="{'border': ias_name == true && ias_cat_id == 2 ? '#007FED 2px solid' : ''}">
                    <div class="head">
                        <h4>{{$t('ias_3_month')}}</h4>
                        <h6>500G</h6>
                    </div>
                    <div class="cost">
                        <h2>{{$t('1000')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_license')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_500server')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_chat')}}</li>
                        </ul>
                    </div>
                    <div class="foot">
                        <b-button variant="outline-primary" :to="{name: 'checkout', query: {app_id: '1', cat_id: '2', amount: '100000'}}">{{$t('subscribe')}}</b-button>
                    </div>
                </div>
            </div>
            <div class="body-pannel col-md-3 col-sm-12">
                <div class="pannel" :style="{'border': ias_name == true && ias_cat_id == 3 ? '#007FED 2px solid' : ''}">
                    <div class="head">
                        <h4>{{$t('ias_1_year')}}</h4>
                        <h6>500G</h6>
                    </div>
                    <div class="cost">
                        <h2>{{$t('3600')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_license')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_500server')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_chat')}}</li>
                        </ul>
                    </div>
                    <div class="foot">
                        <b-button variant="outline-primary" :to="{name: 'checkout', query: {app_id: '1', cat_id: '3', amount: '360000'}}">{{$t('subscribe')}}</b-button>
                    </div>
                </div>
            </div>
            <div class="body-pannel col-md-3 col-sm-12">
                <div class="pannel" :style="{'border': ias_name == true && ias_cat_id == 4 ? '#007FED 2px solid' : ''}">
                    <div class="head">
                        <h4>{{$t('ias_1_year_special')}}</h4>
                        <h6>2T</h6>
                    </div>
                    <div class="cost">
                        <h2>{{$t('14400')}}</h2>
                    </div>
                    <div class="content">
                        <ul>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_license')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_2Tserver')}}</li>
                            <li><b-icon icon="check-circle"></b-icon>{{$t('ias_chat')}}</li>
                        </ul>
                    </div>
                    <div class="foot">
                        <b-button variant="outline-primary" :to="{name: 'checkout', query: {app_id: '1', cat_id: '4', amount: '1440000'}}">{{$t('subscribe')}}</b-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="description">
            <h5>{{$t('purchase.ias_des')}}</h5>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    export default {
        data: () => ({
            ias_name: false,
            ias_cat_id: ''
        }),
        computed: mapGetters({
            user: 'auth/user'
        }),
        created() {
            var user_id = this.user.id
            this.getpurchaseIdByUserid(user_id)
        },
        methods: {
            async getpurchaseIdByUserid(id) {
                const {data} = await axios.get('/api/get/purchase/appID_catID/'+id)
                if(data) {
                    for (let i = 0; i < data.length; i++) {
                        if(data[i].app_name == 'IAS') {
                            this.ias_name = true
                            this.ias_cat_id = data[i].cat_id
                        }
                    }
                }              
            }
        }
    }
</script>

<style scoped>
    .ias {
    padding: 20px 0;
    }
    .ias .title {
    padding: 40px 5px 20px 5px;
    }
    .ias .description {
    padding: 10px 0 10px 30px;
    }
    .ias .body {
    padding: 20px 0;
    }
    .ias .body .body-pannel {
    padding: 0.2rem 1rem;
    }
    .ias .body .body-pannel .pannel {
    border-radius: 6px;
    background-color: #F9F9F9;
    transition: 0.3S
    }
    .ias .body .body-pannel .pannel:hover {
    box-shadow: 0 1.5px 12px 2px rgba(0, 0, 0, 0.74);
    transition: 0.3S
    }
    .ias .body .body-pannel .pannel .head {
    text-align: center;
    border-top-left-radius: 6px;
    border-top-right-radius: 6px;
    padding: 20px 10px 10px 10px;
    min-height:8rem;
    }
    .ias .body .body-pannel .pannel .head h4 {
    font-weight: 600;
    }
    .ias .body .body-pannel .pannel .cost {
    text-align: center;
    }
    .ias .body .body-pannel .pannel .cost h2 {
    font-weight: 700;
    }
    .ias .body .body-pannel .pannel .content {
    line-height: 2rem;
    padding: 1rem;
    }
    .ias .body .body-pannel .pannel .content ul {
    padding-left: 0;
    }
    .ias .body .body-pannel .pannel .content li {
    list-style-type: none;
    }
    .ias .body .body-pannel .pannel .content li svg {
    width: 3.5rem;
    }
    .ias .body .body-pannel .pannel .foot {
        padding: 0.5rem 4rem 2rem 4rem;
        text-align: center;
    }
    .ias .body .body-pannel .pannel .foot .btn-outline-primary {
        border-radius: 10px;
    }
</style>