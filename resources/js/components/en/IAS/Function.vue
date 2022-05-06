<template>
    <div class="ias_function">
        <div class="container">
            <div class="title">
                <h2>{{$t('ias.function_title')}}</h2>
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
                  title: this.$t('ias.function1_title'),
                  text: this.$t('ias.function1_text'),
                  image: "/images/functions/IAS/ias_f_1_1.png",
              },{
                  id: 2,
                  title: this.$t('ias.function2_title'),
                  text: this.$t('ias.function2_text'),
                  image: "/images/functions/IAS/ias_f_1_2.png",
              },{
                  id: 3,
                  title: this.$t('ias.function3_title'),
                  text: this.$t('ias.function3_text'),
                  image: "/images/functions/IAS/ias_f_1_3.png",
              },{
                  id: 4,
                  title: this.$t('ias.function4_title'),
                  text: this.$t('ias.function4_text'),
                  image: "/images/functions/IAS/ias_f_1_4.png",
              },{
                  id: 5,
                  title: this.$t('ias.function5_title'),
                  text: this.$t('ias.function5_text'),
                  image: "",
              }
          ]
      }
    }
  }
</script>

<style scoped>
.ias_function {
    padding-top: 5rem;
    padding-bottom: 1rem;
}
.ias_function .container {
    width: 70%;
}
.ias_function .title {
  text-align: center;
  padding: 20px 0;
}
.ias_function .title h2 {
  text-transform: uppercase;
  color: #0D70FA;
}
.ias_function .card {
    background-color: unset;
    border: none;
}
.ias_function .card-header {
    background-color: unset;
    border-bottom-color: #939393;
}
.ias_function .list {
    padding: 10px;
}
.ias_function .list svg {
    margin-right: 5px;
}
.ias_function .list.not-collapsed svg {
    transform: rotate(90deg);
    transition: 0.3s
}
.ias_function .card-body img {
    max-width: 100%;
}
</style>