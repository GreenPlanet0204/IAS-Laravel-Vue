<template>
    <div>
        <div class="header">
            <h1>{{$t('informations.title')}}</h1>
        </div>
        <div class="container content">
            <div class="no_datas" v-if="informations.length == '0'">
                <h5>There is no new Information</h5>
                <h6>(Please edit New Information)</h6>
            </div>
            <div v-else class="datas row">
                <div v-for="info in informations" :key="info.id" class="pannels col-md-3 col-sm-12">
                    <div class="pannel">
                        <div class="info_title">
                            <h5>
                                <router-link :to="{name: 'information_detail_en', query: {id: info.id, author: info.nikename?info.nikename:info.name}}">
                                    {{info.title != null && info.title.length>80 ? info.title.slice(0,80)+'...' : info.title}}
                                </router-link>
                            </h5>
                        </div>
                        <div class="info_date">
                            <span>{{info.created_at}}</span><br/>
                            <span>Author: <a href="#"><i>{{ info.nikename ? info.nikename : info.name }}</i></a></span>
                        </div>
                        <div class="info_content">
                            <h6>{{info.content != null && info.content.length>120 ? info.content.slice(0,120)+'...' : info.content}}</h6>
                        </div>
                        <div class="info_readmore">
                            <h6>
                                <router-link :to="{name: 'information_detail_en', query: {id: info.id, author: info.nikename?info.nikename:info.name}}">
                                    read details
                                </router-link>
                            </h6>
                        </div> 
                    </div>
                </div>
            </div>             

            <!-- edit new information form section -->
            <div v-if="user && user.role=='admin'" class="info_post_content">
                <div class="new_info_form">
                    <div class="form-title">
                        <h4>Please complete information details fields.</h4>
                    </div>
                    <form @submit.prevent="new_information_post" method="post">
                        <input type="hidden" v-model="userid" name="userid" />
                        <div class="mb-3 row">
                            <div class="col-md-4">
                                <label class="col-form-label">Please select Language of information</label>
                                <select v-model="lang" class="form-control" name="lang">
                                    <option value="en">English</option>
                                    <option value="jp">Japanese</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="col-form-label">Please select Homepage</label>
                                <select v-model="display_page" class="form-control" name="display_page">
                                    <option value="top">Homepage</option>
                                    <option value="customer">Customer</option>
                                    <option value="dealer">Dealer</option>
                                </select>
                            </div>
                            <div class="col-md-4">                                
                                <label class="col-form-label">Date</label>
                                <input v-model="date" class="form-control" type="date" name="date">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <label class="col-form-label">Title</label>
                                <input v-model="title" class="form-control" type="text" name="title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-12">
                                <label class="col-form-label">Content</label>
                                <textarea v-model="content" class="form-control" type="text" name="content"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-12 d-flex">
                                <!-- Submit Button -->
                                <b-button type="submit" variant="primary" :disabled="loading">
                                    <b-spinner small :hidden="!loading"></b-spinner>
                                    Create New Information
                                </b-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div v-else-if="!user" class="info_post_content">
                <h5>To edit New Information, please <router-link :to="{name: 'login'}">{{ $t('login') }}</router-link>.</h5>
            </div>            
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import swal from 'sweetalert2/dist/sweetalert2.js'
    
    export default{
        data: () => ({
            informations: '',
            loading: false,
            title: '',
            content: '',
            lang: '',
            display_page: '',
            date: '',
        }),
        methods: {
            async getInformations(lang) {
                var new_info_datas = await axios.get('/api/get/new_informations/'+lang)
                this.informations = new_info_datas.data
            },
            async new_information_post() {
                this.loading = true
                var {data} = await axios.post('/api/new_information/create', {
                    user_id: this.userid,
                    lang_page: this.lang,
                    display_page: this.display_page,
                    date: this.date,
                    title: this.title,
                    content: this.content
                })
                this.loading = false
                if (data) {
                    swal.fire({
                        icon: 'success',
                        title: this.$t('successTitle'),
                        text: this.$t('successText'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    }).then(() => {
                        this.$router.push({ name: 'en' })
                    })
                } else {                
                    swal.fire({
                        icon: 'warning',
                        title: this.$t('warningTitle'),
                        text: this.$t('warningText'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    })
                }
            },
        },
        computed: mapGetters({
            user: 'auth/user'
        }),
        created() {
            var lang = 'en'
            this.getInformations(lang)   
            this.userid = this.user.id 
        },
        mounted() {
            this.userid = this.user.id
        }
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
    .content .no_datas {
        text-align: center;
        padding-top: 30px;
    }
    .content .datas {
        padding-top: 30px;
    }
    .content .datas .pannels {
        padding: 30px 20px 20px 20px;
        min-height: 400px;
    }
    .content .datas .pannels .pannel {
        padding: 0px 10px;
        border-radius: 6px;
        background-color: #F9F9F9;
        box-shadow: 0 1.5px 12px 2px rgba(0, 0, 0, 0.27);
        transition: 0.3S;
        height: 100%;
    }
    .content .datas .pannels .pannel:hover {
        box-shadow: 0 1.5px 12px 2px rgba(0, 0, 0, 0.74);
        transition: 0.3S;
    }
    .content .datas .pannels .pannel .info_title {
        text-align: left; 
        padding: 20px 5px 7px 5px;       
    }    
    .content .datas .pannels .pannel .info_title h5 {
        word-break: break-all;     
    }  
    .content .datas .pannels .pannel .info_date {
        text-align: left; 
        padding: 7px 5px;       
    } 
    .content .datas .pannels .pannel .info_date span {
        font-size: 13px;      
    }
    .content .datas .pannels .pannel .info_content {
        text-align: left; 
        padding: 7px 5px;       
    }
    .content .datas .pannels .pannel .info_content h6 {
        word-break: break-all;
        display: inline-block     
    }
    .content .datas .pannels .pannel .info_readmore {
        text-align: left; 
        padding: 7px;       
    }
    .content .info_post_content {
        padding: 4rem 0 10px 0;
    }
    .content .info_post_content .new_info_form .form-title {
        text-align:center;
        padding: 20px 0;
        color: #007FED;
    }
    .content .info_post_content .new_info_form {
        padding: 20px 30px;
        background-color: #E6E6E6;
    }
    .content .info_post_content .new_info_form .d-flex {
        justify-content: end;
    }
</style>