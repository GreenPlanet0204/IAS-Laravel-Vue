<template>
    <div class="container information">
      <div class="title">
        <h2>{{$t('homepage.info_title')}}</h2>
        <router-link :to="{name: $t('informations.url')}" class="infos_link_css">{{$t('homepage.infos_link_des')}}</router-link>
      </div>
      <div class="body row">
        <div v-for="info in informations" :key="info.id" class="body-pannel col-md-4 col-sm-12">
          <div class="pannel">
              <div class="head">
                  <h5>
                    <router-link :to="{name: 'information_detail_jp', query: {id: info.id, author: info.nikename?info.nikename:info.name}}">
                        {{info.title != null && info.title.length>80 ? info.title.slice(0,80)+'...' : info.title}}
                    </router-link>
                  </h5>
              </div>
              <div class="content">
                  <h6>{{info.content != null && info.content.length>60 ? info.content.slice(0,60)+'...' : info.content}}</h6>
              </div>
              <div class="read">
                  <h6>
                      <router-link :to="{name: 'information_detail_jp', query: {id: info.id, author: info.nikename?info.nikename:info.name}}">
                          詳細を読む >>
                      </router-link>
                  </h6>
              </div>
              <div class="date">
                  <h6>{{info.created_at}}</h6>
              </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
    import axios from 'axios'
    
    export default{
        data: () => ({
            informations: '',
        }),
        methods: {
            async getInformations(lang) {
                var new_info_datas = await axios.get('/api/get/new_informations/'+lang)
                this.informations = new_info_datas.data
            }
        },
        created() {            
            var lang = this.$root.$i18n.locale
            this.getInformations(lang)
        }
    }
</script>

<style scoped>
.information {
  padding: 50px 0;
}
.information .title {
  text-align: center;
  padding: 40px 0;
}
.information .title .infos_link_css {
  padding-left: 5px;
  font-size: 12px;
  color: #007EFD;
}
.information .body {
  padding: 20px 0;
}
.information .body .body-pannel {
  padding: 1rem 3.5rem 2rem 3.5rem;
  min-height: 400px;
}
.information .body .body-pannel .pannel {
  box-shadow: 0 1.5px 12px 2px rgba(0, 0, 0, 0.2);
  border-radius: 5px;
  height: 100%;
}
.information .body .body-pannel .pannel .head {
  border-top-left-radius: 12px;
  border-top-right-radius: 12px;
  padding: 30px 15px 7px 15px;
}
.information .body .body-pannel .pannel .head h5 {
  line-height: 1.8rem;
  word-break: break-all;    
  padding: 0 10px; 
}
.information .body .body-pannel .pannel .content {
  padding: 7px 15px;
}
.information .body .body-pannel .pannel .content h6 {
  line-height: 1.2rem;
  padding: 0 10px;
  word-break: break-all;     
}
.information .body .body-pannel .pannel .read {
  text-align: left;
  padding: 7px 25px;
  text-transform: uppercase; 
}
.information .body .body-pannel .pannel .date {
  text-align: left;
  padding: 7px 25px;
}
</style>