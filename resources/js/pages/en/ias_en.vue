<template>
    <div>    
        <b-carousel
            id="carousel-fade"
            fade
            indicators
        >
            <div class="ias_welcome" :style="{padding: mobile ? '3% 0' : ''}">
                <div class="title">
                    <h3 v-if="mobile">{{$t('ias.title')}}</h3>
                    <h1 v-else>{{$t('ias.title')}}</h1>
                </div>
                <div class="button">
                    <b-button variant="outline-primary" :to="{ name: $t('purchase.url') }" class="purchase">{{$t('purchase.text')}}</b-button>
                    <b-button variant="outline-primary" :to="{ name: $t('catalog.url') }" class="catalog">{{$t('catalog.text')}}</b-button>
                </div>
            </div>
            <div class="color-overlay">
            </div>
            <b-img src="/images/slider/slide_1.png" class="ias_image"></b-img>
        </b-carousel>
        
        <!-- Description Section -->
        <Descriptionsection />

        <!-- Subscription Sale section -->
        <Subscriptionsection />

        <!-- main functions -->
        <Functionsection />

        <!-- contact us -->
        <Contactsection />

        <!-- customer -->
        <Customersection />
    </div>
</template>

<script>
import Descriptionsection from '~/components/en/IAS/Description'
import Subscriptionsection from '~/components/en/IAS/Subscription_sale'
import Functionsection from '~/components/en/IAS/Function'
import Contactsection from '~/components/en/IAS/Contact'
import Customersection from '~/components/en/IAS/Customer'

export default {
    data: () => ({
        mobile: ''
    }),
    components: {
        Descriptionsection,
        Subscriptionsection,
        Functionsection,
        Contactsection,
        Customersection
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
.ias_welcome {
    z-index: 900;
    text-align: center;
    position: absolute;
    width: 100%;
    padding: 15% 0;
}
.ias_image {
    width: 100%;
    height: 100%;
}
.ias_welcome .title {
    padding: 10px 0;
}
.ias_welcome .title h1,
.ias_welcome .title h3 {
    color: white;
    font-weight: 600;
}
.ias_welcome .button {
    display: flex;
    justify-content: space-around;
    padding: 20px 0;
}
.ias_welcome .button .purchase.btn-outline-primary {
    border-radius: 20px;
    border-color: #007FED;
    color: #fff;
    background-color: #007FED;
    padding: 10px 35px;
    font-size: 15px;
   
}
.ias_welcome .button .purchase.btn-outline-primary:hover {
    background-color: #fff;
    color: #007FED;
}
.ias_welcome .button .catalog.btn-outline-primary {
    border-radius: 20px;
    border-color: #007FED;
    color: #007FED;
    background-color: #fff;
    padding: 10px 35px;
    font-size: 15px;
}
.ias_welcome .button .catalog.btn-outline-primary:hover {
    background-color: unset;
    color: #fff;
    border-color: #fff;
}
.color-overlay {
    background-color: #04015e;
    opacity: 0.5;
    transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    position: absolute;
    z-index: 100;
}
</style>