<template>
    <div class="container comment">
        <div class="comment_title">
            <h5>{{$t('comment_title')}}</h5>
        </div>

        <!-- Display Comments -->
        <div v-if="comments_data.length != '0'" class="display_comments">
            <b-card v-for="comment in comments_data" :key="comment.id">
                <template #header>
                    <div class="text-md-start" style="display:flex;">
                        <img :src="comment.photo_url" class="rounded-circle profile-photo me-1">
                        <h5 class="mb-0 text-md-start" style="padding-left: 10px;">{{comment.nikename ? comment.nikename : comment.name }}</h5>
                    </div>
                    <div class="text-md-end">
                        <b-button @click="reply_param(comment.info_id, comment.id)" v-b-modal="'modal_reply_'+comment.info_id+'_'+comment.id" variant="link">{{$t('reply')}}</b-button>
                        <b-button @click="view_reply_action(comment.id)" v-b-modal="'modal_view_'+comment.info_id+'_'+comment.id"  variant="link">{{$t('answers_view')}}</b-button>
                        <b-button v-if="user && user.id == comment.user_id" @click="edit_comment_param(comment.info_id, comment.id, comment.comment)" v-b-modal="'modal_edit_'+comment.info_id+'_'+comment.id"  variant="link">{{$t('edit')}}</b-button>
                        <b-button v-if="user && user.id == comment.user_id" @click="delete_comment_action(comment.info_id, comment.id)" variant="link">{{$t('delete')}}</b-button>

                        <!-- Modal part -->
                        <!-- reply modal -->
                        <b-modal
                            hide-footer
                            :id="'modal_reply_'+comment.info_id+'_'+comment.id"
                            :ref="'modal_reply_'+comment.info_id+'_'+comment.id"
                            :title="$t('reply')"
                        >
                            <form @submit.prevent="reply_post" method="post">
                                <div class="col-md-12">
                                    <div class="body-pannel">
                                        <b-form-textarea 
                                        type="text"
                                        v-model="reply"            
                                        rows="3" 
                                        ref="reply"
                                        required
                                        ></b-form-textarea>
                                    </div>
                                </div>                                
                                <div class="col-md-12 col-sm-12" style="padding-top: 5px;">
                                    <div class="body-pannel" style="text-align:right;">
                                        <b-button type="submit" variant="primary" :disabled="loading">
                                        <b-spinner small :hidden="!loading"></b-spinner>
                                        {{$t('reply')}}
                                        </b-button>
                                    </div>
                                </div>                
                            </form>
                        </b-modal>
                        <!-- view reply modal -->
                        <b-modal
                            hide-footer
                            scrollable
                            :id="'modal_view_'+comment.info_id+'_'+comment.id"
                            :ref="'modal_view_'+comment.info_id+'_'+comment.id"
                            :title="$t('all_answers')"
                        >
                            <div v-if="reply_data.length===0">
                                <h5>{{$t('all_answers_no_data_des')}}</h5>
                            </div>
                            <div v-else>
                                <b-card v-for="reply in reply_data" :key="reply.id" style="padding: 5px 0;">
                                    <b-card-body>
                                        <div class="text-md-start" style="display:flex;">
                                            <img :src="'/upload/users/'+reply.photo_url" class="rounded-circle profile-photo me-1">
                                            <h6 class="mb-0 text-md-start" style="padding-left: 10px;">{{reply.comment_answer}}</h6>
                                        </div>
                                    </b-card-body>
                                </b-card>
                            </div>                            
                        </b-modal>
                        <!-- edit comment modal -->
                        <b-modal
                            hide-footer
                            :id="'modal_edit_'+comment.info_id+'_'+comment.id"
                            :ref="'modal_edit_'+comment.info_id+'_'+comment.id"
                            :title="$t('edit')"
                        >
                            <form @submit.prevent="edit_comment_post" method="post">
                                <div class="col-md-12">
                                    <div class="body-pannel">
                                        <b-form-textarea 
                                        type="text"
                                        v-model="edit_comment_content"            
                                        rows="3"
                                        required
                                        ></b-form-textarea>
                                    </div>
                                </div>                                
                                <div class="col-md-12 col-sm-12" style="padding-top: 5px;">
                                    <div class="body-pannel" style="text-align:right;">
                                        <b-button type="submit" variant="primary" :disabled="loading">
                                        <b-spinner small :hidden="!loading"></b-spinner>
                                        {{$t('post_comment')}}
                                        </b-button>
                                    </div>
                                </div>                
                            </form>
                        </b-modal>
                    </div>
                </template>
                <b-card-body>
                    <h5>{{comment.comment}}</h5>
                </b-card-body>                
            </b-card>
        </div>

        <!-- edit new comment -->
        <div v-if="user" >
            <form @submit.prevent="comment_post" method="post">
                <div class="col-md-12">
                    <label class="col-form-label">{{$t('comment')}}</label>
                    <div class="body-pannel">
                        <b-form-textarea 
                        type="text"
                        v-model="comment"            
                        rows="5" 
                        ref="comment"
                        ></b-form-textarea>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12" style="padding-top: 5px;">
                    <div class="body-pannel" style="text-align:right;">
                        <b-button type="submit" variant="primary" :disabled="loading">
                        <b-spinner small :hidden="!loading"></b-spinner>
                        {{$t('post_comment')}}
                        </b-button>
                    </div>
                </div>                
            </form>
        </div>
        <div v-else>
            <h6>In order to edit new comment, Please <router-link :to="{name: 'login'}">{{ $t('login') }}</router-link></h6>
        </div>

    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios'
    import swal from 'sweetalert2/dist/sweetalert2.js'
    export default{
        props: {
            sendId: {type: Number}
        },
        watch: {
            sendId: {
                immediate: true,
                deep: true,
                handler(newValue, oldValue) {  
                    if(newValue && oldValue ) {
                        this.getComments(newValue)
                    }
                    this.new_comment_info_id = newValue
                }
            }
        },
        data: () => ({
            new_comment_info_id: '',
            comment: '',
            reply: '',
            loading: false,
            comments_data: [],
            //params for reply post action
            reply_comment_id: '',
            reply_info_id: '',
            reply_data: [],
            //params for edit comment action
            edit_comment_id: '',
            edit_info_id: '',
            edit_comment_content: ''
        }),
        computed: mapGetters({
            user: 'auth/user'
        }),
        created() {
            var locale = this.$root.$i18n.locale
            var info_id = this.$route.query.id
            this.getComments(info_id)
        },
        methods: {
            async getComments(id) {
                const {data} = await axios.get('/api/get/comments/'+id)
                for (let i=0 ; i < data.length ; i++) {
                    if (data[i]['photo_url'] == null) {
                        data[i]['photo_url'] = "https://www.gravatar.com/avatar/%s.jpg?s=200&d=https://ui-avatars.com/api/"+data[i]['name']
                    } else {
                        data[i]['photo_url'] = "/upload/users/"+data[i]['photo_url']
                    }
                }
                this.comments_data = data
            },

            //comment post
            async comment_post(){
                this.loading = true
                if (this.$refs.comment.value == "") {
                    this.$refs.comment.focus()
                } else {
                    var {data} = await axios.post('/api/comment/post', {
                        user_id: this.user.id,
                        info_id: this.new_comment_info_id,
                        comment: this.comment
                    }) 
                    if (data) {
                        swal.fire({
                            icon: 'success',
                            title: this.$t('successTitle'),
                            text: this.$t('successText'),
                            reverseButtons: true,
                            confirmButtonText: this.$t('ok'),
                            cancelButtonText: this.$t('cancel')
                        }).then(() => {
                            this.getComments(data.info_id)
                            this.comment = ''
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
                }                 
                this.loading = false               
            },

            //reply post
            reply_param(info_id, comment_id) {
                this.reply_comment_id=comment_id
                this.reply_info_id=info_id
            },
            async reply_post(){
                if (!this.user) {
                    swal.fire({
                        icon: 'warning',
                        title: this.$t('warningTitle'),
                        text: this.$t('must_login_content'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    })
                } else {
                    this.loading = true
                    var {data} = await axios.post('/api/reply/post', {
                        user_id: this.user.id,
                        info_id: this.reply_info_id,
                        comment_id: this.reply_comment_id,
                        comment_answer: this.reply,
                    }) 
                    if (data) {
                        swal.fire({
                            icon: 'success',
                            title: this.$t('successTitle'),
                            text: this.$t('successText'),
                            reverseButtons: true,
                            confirmButtonText: this.$t('ok'),
                            cancelButtonText: this.$t('cancel')
                        }).then(() => {
                            this.reply=''
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
                }                             
            },

            //view all_answers
            async view_reply_action(comment_id) {
                var {data} = await axios.get('/api/get/answers/'+comment_id)
                this.reply_data = data
            },

            //edit comment
            edit_comment_param(info_id, comment_id, comment) {
                this.edit_info_id = info_id
                this.edit_comment_id = comment_id
                this.edit_comment_content = comment
            },
            async edit_comment_post() {
                this.loading = true
                var {data} = await axios.post('/api/comment/edit', {
                    id: this.edit_comment_id,
                    comment: this.edit_comment_content
                })
                if (data) {
                    swal.fire({
                        icon: 'success',
                        title: this.$t('successTitle'),
                        text: this.$t('successText'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    }).then(() => {
                        this.getComments(this.edit_info_id)
                        this.edit_comment_content=''
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

            //delete comment
            async delete_comment_action(info_id, comment_id){                
                var {data} = await axios.get('/api/comment/delete/'+info_id+'/'+comment_id)
                if (data) {
                    swal.fire({
                        icon: 'success',
                        title: this.$t('successTitle'),
                        text: this.$t('successText'),
                        reverseButtons: true,
                        confirmButtonText: this.$t('ok'),
                        cancelButtonText: this.$t('cancel')
                    }).then(() => {
                        this.comments_data = data
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

        }
    }
</script>

<style>
    .comment .comment_title {
        padding-top: 15px;
    }
    .comment .display_comments {
        padding: 15px 0;
    }
    .comment .display_comments .card {
        margin: 10px 0 10px 20px;
    }
    .comment .display_comments .card .card-header img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }
</style>