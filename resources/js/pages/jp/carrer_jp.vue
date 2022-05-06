<template>
    <div>
        <div class="header">
            <h6 :style="{padding: mobile ? '1rem 0 0 0' : ''}">{{$t('carrer.job')}}</h6>
            <h1>{{$t('carrer.title')}}</h1>
        </div>
        <div class="container">
            <!-- Join us Today -->
            <div class="join">
                <h4>{{$t('carrer.job_title')}}</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="title">
                            <span>{{$t('carrer.job_des_title')}}</span>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="content">
                            <h6>{{$t('carrer.job_des_1')}}</h6>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="content">
                            <h6>{{$t('carrer.job_des_2')}}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Become An Associate -->
            <Associatesection />

            <!-- Apply Now For Success -->
            <Apllysection />
        </div>
    </div>
</template>

<script>
import Associatesection from '~/components/jp/carrer/Associate'
import Apllysection from '~/components/jp/carrer/Apply'

export default {
    data:() => ({
        mobile: ''
    }),
    components: {
        Associatesection,
        Apllysection
    },
    mounted() {
        if(screen.width <= 991) {
            this.mobile = true
        } else {
            this.mobile = false
        }
    }
}
</script>

<style scoped>
.header {
    width: 100%;
    background-color: #211F40;
    height: 150px;
}
.header h6 {
    padding-top: 2rem;
    text-align: center;
    color: #fff;
}
.header h1 {
    text-align: center;
    color: #fff;
    font-weight: 600;
}
.join {
    padding-top: 3rem;
}
.join h5 {
    padding: 1rem 1rem;
}
.join .title {
    border-left: 3px solid #007FED;
    height: 100%;
    padding-left: 10px
}
.join .title span {
    font-size: 30px;
    line-height: 2.5rem;
}
</style>