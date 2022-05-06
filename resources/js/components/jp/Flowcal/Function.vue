<template>
    <div class="flowcal_function">
        <div class="container">
            <div class="title">
                <h2>{{$t('flowcal.function_title')}}</h2>
            </div>
            <div class="accordion" role="tablist">
                <div v-for="item in listdatas" :key="item.id">
                    <b-card no-body class="mb-1">
                    <b-card-header header-tag="header" class="p-1" role="tab">
                        <div class="list" v-b-toggle="'collapse_'+item.id" variant="info"><b-icon icon="caret-right-fill"></b-icon>{{ item.title }}</div>
                    </b-card-header>
                    <b-collapse :id="'collapse_'+item.id" accordion="my-accordion" role="tabpanel">
                        <b-card-body>
                            <b-card-text>{{ item.text }}</b-card-text>
                            <img :src="item.image" />
                        </b-card-body>
                    </b-collapse>
                    </b-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
          listdatas: [
              {
                  id: 1,
                  title: this.$t('flowcal.function1_title'),
                  text: this.$t('flowcal.function1_text'),
                  image: "",
              },{
                  id: 2,
                  title: this.$t('flowcal.function2_title'),
                  text: this.$t('flowcal.function2_text'),
                  image: "",
              },{
                  id: 3,
                  title: this.$t('flowcal.function3_title'),
                  text: this.$t('flowcal.function3_text'),
                  image: "",
              },{
                  id: 4,
                  title: this.$t('flowcal.function4_title'),
                  text: this.$t('flowcal.function4_text'),
                  image: "",
              },{
                  id: 5,
                  title: this.$t('flowcal.function5_title'),
                  text: this.$t('flowcal.function5_text'),
                  image: "",
              }
          ]
      }
    }
  }
</script>

<style scoped>
.flowcal_function {
    padding-top: 5rem;
    padding-bottom: 1rem;
}
.flowcal_function .container {
    width: 70%;
}
.flowcal_function .title {
  text-align: center;
  padding: 20px 0;
}
.flowcal_function .title h2 {
  text-transform: uppercase;
  color: #0D70FA;
}
.flowcal_function .card {
    background-color: unset;
    border: none;
}
.flowcal_function .card-header {
    background-color: unset;
    border-bottom-color: #939393;
}
.flowcal_function .list {
    padding: 10px;
}
.flowcal_function .list svg {
    margin-right: 5px;
}
.flowcal_function .list.not-collapsed svg {
    transform: rotate(90deg);
    transition: 0.3s
}
</style>