<template>
    <div>
        <div class="header">
            <div v-if="mobile" class="title" style="padding: 0 10px;">
                <h3>{{detail_data.title}}</h3>
            </div>
            <div v-else class="container title">
                <h1>{{detail_data.title}}</h1>
            </div>
        </div>
        <div class="container content">
            <div class="detail_des">
                <h6>あなたはここにいる:
                    <router-link :to="{ name: $t('home.url') }" style="display: inline">
                        {{$t('home.text')}}
                    </router-link>/
                    <router-link :to="{name: $t('informations.url')}" style="display: inline">
                        新しい情報
                    </router-link>
                    / {{detail_data.title}}
                </h6>
            </div>
            <div class="detail_content">
                <div class="detail_date">
                    <h6>{{detail_data.created_at}} by <a href="#"><i>{{author}}</i></a></h6>
                    <b-button v-if="user && user.id == detail_data.user_id" @click="edit_information(detail_data.title, detail_data.content)" v-b-modal.edit_information_modal variant="link">
                        <b-icon icon="pencil" style="padding-right: 5px;"></b-icon>{{$t('edit')}}
                    </b-button>
                </div>
                
                <div class="detail_content">
                    <h5>{{detail_data.content}}</h5>
                </div>
                
                <b-modal
                    hide-footer
                    id="edit_information_modal"
                    ref="edit_information_modal"
                    :title="$t('edit')"
                    size="xl"
                    scrollable
                >
                    <form @submit.prevent="update_information" method="post">
                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="body-pannel">
                                <b-form-input 
                                type="text"
                                v-model="editable_title"
                                required
                                ></b-form-input>
                            </div>
                        </div>  
                        <div class="col-md-12">
                            <div class="body-pannel">
                                <b-form-textarea 
                                type="text"
                                v-model="editable_content"  
                                rows="10"
                                required
                                ></b-form-textarea>
                            </div>
                        </div>                                
                        <div class="col-md-12 col-sm-12" style="padding-top: 5px;">
                            <div class="body-pannel" style="text-align:right;">
                                <b-button type="submit" variant="primary" :disabled="loading">
                                <b-spinner small :hidden="!loading"></b-spinner>
                                {{$t('update')}}
                                </b-button>
                            </div>
                        </div>                
                    </form>
                </b-modal>
            </div>           
        </div>

        <!-- Information List -->
        <InformationSection @selected="selectInfo" />

        <!-- Comment section -->
        <CommentSection :send-id="info_id" />
    </div>
</template>

<script>
    import axios from 'axios'
    import { mapGetters } from 'vuex'
    import swal from 'sweetalert2/dist/sweetalert2.js'
    import InformationSection from '~/components/NewInformations'
    import CommentSection from '~/components/Comment'
    
    export default{
        data: () => ({
            detail_data: '',
            author: '',
            info_id: '',
            editable_title: '',
            editable_content: '',
            loading: false
        }),
        components: {
           InformationSection,
           CommentSection
        },
        mounted() {
            if(screen.width <= 991) {
            this.mobile = true
            } else {
            this.mobile = false
            }
        },
        methods: {
            edit_information(title, content) {
                this.editable_title = title
                this.editable_content = content
            },
            async update_information() {
                this.loading = true
                var updated_info_detail_data = await axios.post('/api/post/information/update', {
                    title: this.editable_title,
                    content: this.editable_content,
                    info_id: this.info_id
                })
                if (updated_info_detail_data) {
                    swal.fire({
                        icon: 'success',
                        title: this.$t('successTitle'),
                        text: this.$t('successText'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    }).then(() => {
                        this.detail_data = updated_info_detail_data.data
                        this.info_id = updated_info_detail_data.data.id
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
                this.loading = false
                
            },
            async getInfoDetailData(id) {
                var info_detail_data = await axios.get('/api/get/information/detail/'+id)
                this.detail_data = info_detail_data.data
                this.info_id = info_detail_data.data.id
            },
            selectInfo(value) {
                this.getInfoDetailData(value[0])               
                this.author = value[1]
            }
        },
        computed: mapGetters({
            user: 'auth/user'
        }),
        created() {
            var id = this.$route.query.id
            this.author = this.$route.query.author
            this.getInfoDetailData(id)
        }
    }
</script>

<style scoped>
    .header {
        width: 100%;
        background-color: #211F40;
    }
    .header .title h1 {
        padding: 3rem 0;
        text-align: center;
        color: #fff;
        font-weight: 600;
        word-break: break-all;   
    }
    .container.title {
        width: 50%
    }
    .container.content {
        width: 80%;
    }
    .content .detail_des {
        padding: 10px 0;
    }
    .content .detail_content {
        padding-top: 30px;
    }
    .content .detail_content .pannels .pannel .info_title {
        text-align: center; 
        padding: 20px 5px 10px 5px;       
    }    
    .content .datas .pannels .pannel .info_title h5 {
        word-break: break-all;     
    }  
    .content .detail_content .detail_date {
        text-align: left; 
        padding: 10px 5px 10px 20px;   
        display: flex;
        justify-content: space-between;    
    }
    .content .detail_content .detail_content {
        text-align: left; 
        padding: 10px 5px;       
    }
    .content .detail_content .detail_content h5 {
        word-break: break-word;
        white-space: break-spaces;
        display: inline-block  
    }
</style>