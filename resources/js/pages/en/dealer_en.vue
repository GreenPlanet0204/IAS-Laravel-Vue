<template>
    <div>
        <!-- IF Authentification -->
        <div v-if="user">

            <div v-if="user.role=='customer'">
                <Alertsection />
            </div>

            <div v-else>
                <!-- Campaign Information -->        
                <div class="container campaign">
                    <div class="title">
                        <h2>{{$t('dealer.campaign_title')}}</h2>
                    </div>
                    <div v-if="dealer_informations.length==0" class="body row">
                        <div class="text col-md-12 col-sm-12">
                            <h5>{{$t('dealer.campaign_con')}}</h5>
                        </div>
                    </div>
                    <div v-else class="body row">
                        <div v-for="info in dealer_informations" :key="info.id" class="body-pannel col-md-4 col-sm-12">
                            <div class="pannel">
                                <div class="head">
                                    <h5>
                                        <router-link :to="{name: 'information_detail_en', query: {id: info.id, author: info.name}}">
                                            {{info.title != null && info.title.length>40 ? info.title.slice(0,40)+'...' : info.title}}
                                        </router-link>
                                    </h5>
                                </div>
                                <div class="date">
                                    <h6>{{info.created_at}}</h6>
                                </div>
                                <div class="content">
                                    <h6>{{info.content != null && info.content.length>80 ? info.content.slice(0,80)+'...' : info.content}}</h6>
                                </div>
                                <div class="read">
                                    <h6>
                                        <router-link :to="{name: 'information_detail_en', query: {id: info.id, author: info.name}}">
                                            read details >>
                                        </router-link>
                                    </h6>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>

                <!-- Brochure Information -->
                <div class="container brochure">
                    <div class="title">
                        <h2>{{$t('dealer.brochure_title')}}</h2>
                    </div>
                    <div class="body row">
                        <div class="text col-md-9 col-sm-12">
                            <h5>{{$t('dealer.brochure_con')}}</h5>
                        </div>
                        <div class="button col-md-3 col-sm-12">
                            <b-button variant="outline-primary">{{$t('dealer.brochure_button')}}</b-button>
                        </div>
                    </div>
                </div>

                <!-- IAS -->
                <IAS />

                <!-- Flowcal -->
                <Flowcal />
            </div>
        </div>

        <div v-else>
            <Loginsection :registername='false' />
        </div>        
    </div>
</template>

<script>
import IAS from '~/components/en/dealer-order/IAS'
import Flowcal from '~/components/en/dealer-order/Flowcal'
import Loginsection from '~/pages/auth/login'
import Alertsection from '~/components/Alert'
import {mapGetters } from 'vuex'
import axios from 'axios'
import Cookies from 'js-cookie'

export default {
    data: () => ({
        dealer_informations: ''
    }),
    components: {
        IAS,
        Flowcal,
        Loginsection,
        Alertsection,
    },
    methods: {
        async getDealerInformations(lang) {
            var new_info_dealer_datas = await axios.get('/api/get/new_informations/dealer/'+lang)
            this.dealer_informations = new_info_dealer_datas.data
        }
    },
    computed: mapGetters({
        user: 'auth/user'
    }),
    created() {
        var lang = 'en'
        this.getDealerInformations(lang)
        Cookies.set('intended_url', this.$route.path)
    }
}
</script>

<style scoped>
.campaign,
.brochure {
    padding: 20px 0;
}
.campaign .title,
.brochure .title {
    padding: 20px 0;
}
.campaign .body .text,
.brochure .body .text  {
    padding: 10px 0;
    padding-left: 30px;
}
.brochure .body .button .btn-outline-primary {
    padding: 6px 40px;
    border-radius: 5px;
    color: #fff;
    background-color: #007FED;
    transition: 0.2s;
}
.brochure .body .button .btn-outline-primary:hover {
    color: #007FED;
    background-color: #fff;
    transition: 0.2s;
}
.campaign .body .body-pannel {
  padding: 1rem 2.5rem 2rem 2.5rem;
}
.campaign .body .body-pannel .pannel {
  box-shadow: 0 1.5px 12px 2px rgba(0, 0, 0, 0.06);
  border-radius: 12px;
  height: 100%;
}
.campaign .body .body-pannel .pannel .head {
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
  padding: 30px 16px 10px 16px;
}
.campaign .body .body-pannel .pannel .head h5 {
  line-height: 2rem;
  word-break: break-all;    
  padding: 0 25px; 
}
.campaign .body .body-pannel .pannel .content,
.campaign .body .body-pannel .pannel .read,
.campaign .body .body-pannel .pannel .date {
  padding: 10px 16px;
}
.campaign .body .body-pannel .pannel .content h6 {
  line-height: 1.5rem;
  padding: 10px 16px;
  word-break: break-all;     
}
.campaign .body .body-pannel .pannel .read {
  text-align: right;
}
.campaign .body .body-pannel .pannel .date {
  text-align: right;
}
</style>
