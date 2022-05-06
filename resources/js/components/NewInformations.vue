<template>
    <div class="container new_information">
        <div v-if="informations.length != '0'">
            <div v-for="i in informations.length" :key="i" class="author_pannel col-md-12">
                <div class="author_pan col-md-12">
                    <b-card><h5>{{authors[i-1]}}</h5></b-card>
                </div>
                <div class="information_list_pan col-md-12 row">
                    <div v-for="j in informations[i-1].length" :key="j">
                        <b-card>
                            <h6 @click="selectInfo(informations[i-1][j-1].id, informations[i-1][j-1].nikename?informations[i-1][j-1].nikename:informations[i-1][j-1].name)">
                                {{informations[i-1][j-1].title != null && informations[i-1][j-1].title.length>80 ? informations[i-1][j-1].title.slice(0,80)+'...' : informations[i-1][j-1].title}}
                            </h6>
                            <!-- <router-link :to="{name: 'information_detail_'+locale, query: {id: informations[i-1][j-1].id, author: informations[i-1][j-1].name}}">
                                {{informations[i-1][j-1].title != null && informations[i-1][j-1].title.length>80 ? informations[i-1][j-1].title.slice(0,80)+'...' : informations[i-1][j-1].title}}
                            </router-link> -->
                        </b-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import { Mapgetters } from 'vuex'

    export default {
        data: () => ({            
            informations: [],
            authors: ''
        }),
        methods: {
            async getInformations(lang) {
                var new_info_datas = await axios.get('/api/get/new_informations/'+lang)
                var author = []
                var store_author = ''
                for (let i in Object.keys(new_info_datas.data)){
                    store_author = new_info_datas.data[i].nikename?new_info_datas.data[i].nikename:new_info_datas.data[i].name
                    if (author == null) {
                        author = [store_author]
                    } else {
                        if (author == store_author) {
                            author = [store_author]
                        } else {
                            author.push(store_author)
                        }
                    }
                }
                var informations = []
                var author_only_infos = []
                for (let j=0; j < author.length; j++) {
                    author_only_infos = []
                    for (let k in Object.keys(new_info_datas.data)) {
                        if (new_info_datas.data[k].nikename == author[j] || new_info_datas.data[k].name == author[j]) {
                            author_only_infos.push(new_info_datas.data[k])
                        }
                    } 
                    informations.push(author_only_infos)
                }
                this.authors = author
                this.informations = informations
            },
            selectInfo(info_id, info_name) {
                this.$emit("selected", [info_id, info_name])
                window.scrollTo(0,0)
            }
        },
        created() {
            this.locale = this.$root.$i18n. locale
            this.getInformations(this.locale)  
        }
    }
</script>

<style>
    .new_information .author_pannel {
        padding: 15px 0;
    }
    .new_information .author_pannel .author_pan h5 {
        padding: 10px;
        padding-left: 15px;
    }
    .new_information .author_pannel .information_list_pan {
        padding: 15px 20px;
        justify-content: space-around;
    }
    .new_information .author_pannel .information_list_pan .card {
        margin: 5px 0;
    }
    .new_information .author_pannel .information_list_pan .card h6 {
        color: #007FED;
    }
    .new_information .author_pannel .information_list_pan .card h6:hover {
        color: #000;
        cursor: pointer;
    }

</style>