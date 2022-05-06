<template>
    <div class="container applications">
      <div class="title">
        <h2>{{$t('products.title')}}</h2>
      </div>
      <div class="body row">
        <div v-for="item in appimages" :key="item.id" class="pannel col-md-3 col-sm-12">
            <router-link :to="{ name: item.urlname }">
                <div class="image">
                    <img :src="item.image" />
                    <div class="subtitle">
                        <h5>{{item.text}}</h5>
                    </div>
                </div>
            </router-link>    
        </div>
      </div>
    </div>
</template>

<script>
export default {
    data () {
        return {
            appimages : [
                {
                    id: 1,
                    urlname: this.$t('ias.url'),
                    image: "/images/applications/application-01.jpg",
                    text: this.$t('products.imaging'),
                },{
                    id: 2,
                    urlname: this.$t('flowcal.url'),
                    image: "/images/applications/application-02.jpg",
                    text: this.$t('products.flow'),
                },{
                    id: 3,
                    urlname: "",
                    image: "/images/applications/application-03.jpg",
                    text: this.$t('products.3D'),
                },{
                    id: 4,
                    urlname: "",
                    image: "/images/applications/application-04.jpg",
                    text: this.$t('products.kermilmi'),
                },{
                    id: 5,
                    urlname: "",
                    image: "/images/applications/application-05.png",
                    text: this.$t('products.NGS'),
                },{
                    id: 6,
                    urlname: "",
                    image: "/images/applications/application-06.jpg",
                    text: this.$t('products.CT'),
                },{
                    id: 7,
                    urlname: "",
                    image: "/images/applications/application-07.png",
                    text: this.$t('products.drone'),
                }
            ]
        }
    }
}
</script>

<style scoped>
.applications .title {
    padding: 40px 0px;
    text-align: center;
}
.applications .body {
    padding: 20px 3rem;
}
.applications .body .pannel {
    position: relative;
    padding: 0px 40px;
    min-height: 15rem;
    margin: 30px 0;
}
.applications .body .pannel .image {
    text-align:center;
    position: absolute;
    top: 0;
    height: 100%;
    transition: 0.3S;
}
.applications .body .pannel .image:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    transition: 0.3S;
}
.applications .body .pannel .image img {
    width: 90%;
    height: 90%;
    z-index: -100;
}
.applications .body .image .subtitle {
    position:absolute;
    bottom: 0;
    width: 100%;
    text-align: center;
    background-color: #fff;
    padding: 10px 0;
}
</style>