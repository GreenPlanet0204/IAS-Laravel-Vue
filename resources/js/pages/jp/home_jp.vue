<template>
  <div>
    <Imageslider />

    <!--About section -->
    <Aboutsection />

    <!-- Fields of application -->
    <Fieldsection />
    
    <!--Features of Product Group -->
    <Featuresection />

    <!-- Introduction -->
    <Introductionsection />

    <!-- Subscription Type -->
    <Subscriptionsection />

    <!-- Contact Us -->
    <Contactsection />

    <!-- New Infomation -->
    <Informationsection />

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script>
import Imageslider from '~/components/HomeImageSlider'
import Aboutsection from '~/components/jp/home/About'
import Fieldsection from '~/components/jp/home/Field'
import Featuresection from '~/components/jp/home/Features'
import Introductionsection from '~/components/jp/home/Introduction'
import Subscriptionsection from '~/components/jp/home/Subscription'
import Contactsection from '~/components/jp/home/Contact'
import Informationsection from '~/components/jp/home/Information'
import Footer from '~/components/Footer'
export default {
  components: {
      Imageslider,
      Aboutsection,
      Featuresection,
      Fieldsection,
      Introductionsection,
      Subscriptionsection,
      Contactsection,
      Informationsection,
      Footer
  }
}
</script>

<style scoped>
.imageslider {
    width: 100%;
}
</style>
