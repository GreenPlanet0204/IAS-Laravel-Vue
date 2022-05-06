<template>
  <VueScrollFixedNavbar>
    <!-- Authenticated -->
    <div v-if="user">
      <div v-if="user.role=='admin'" class="login-dropdown" @mouseover="profileOver" @mouseleave="profileLeave">
        <img :src="user.photo_url" class="rounded-circle profile-photo me-1">
        <b-dropdown id="dropdown-right" right :text="user.name" size="small" variant="none" split-variant="none" ref="dropdown">
          <b-dropdown-item @click="adminDashboardShow"><fa icon="cog" fixed-width />{{ $t('dashboard') }}</b-dropdown-item>
          <b-dropdown-item href="#" @click.prevent="logout"><fa icon="sign-out-alt" fixed-width />{{ $t('logout') }}</b-dropdown-item>
        </b-dropdown>
      </div>   
      <div v-else class="login-dropdown" @mouseover="profileOver" @mouseleave="profileLeave">
        <img :src="user.photo_url" class="rounded-circle profile-photo me-1">
        <b-dropdown id="dropdown-right" right :text="user.name" size="small" variant="none" split-variant="none" ref="dropdown">
          <b-dropdown-item :to="{ name: 'settings.profile' }" ><fa icon="cog" fixed-width />{{ $t('settings') }}</b-dropdown-item>
          <b-dropdown-item href="#" @click.prevent="logout"><fa icon="sign-out-alt" fixed-width />{{ $t('logout') }}</b-dropdown-item>
        </b-dropdown>
      </div>
    </div>
    <!-- Guest -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      
      <div class="container">
        <router-link :to="{ name: $t('home.url') }" class="navbar-brand">
          <img :src="logo" />
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" >
          <span class="navbar-toggler-icon" />
        </button>

        <div id="navbar" class="collapse navbar-collapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link :to="{ name: $t('home.url') }" class="nav-link" active-class="active">
                {{ $t('home.text') }}
              </router-link>
            </li>

            <li class="nav-item dropdown" @mouseover="productOver" @mouseleave="productLeave">
              <router-link v-if="mobile" :to="{ name: $t('products.url') }"  class="nav-link" active-class="active" style="display: inline">
                {{ $t('products.text') }}                
              </router-link>
              <router-link v-else :to="{ name: $t('products.url') }"  class="nav-link dropdown-toggle" active-class="active">
                {{ $t('products.text') }}                
              </router-link>
              <div class="toggle-button-icon" :style="{display: mobile ? 'inline' : 'none'}" @click="productMenuClick">
                  <b-icon v-if="productShow" icon="chevron-bar-up"></b-icon>
                  <b-icon v-else icon="chevron-bar-down"></b-icon>
              </div>
              <div class="dropdown-menu" :style="{ display: productShow ? 'block' : 'none' } ">
                <router-link :to="{ name: $t('ias.url') }" class="nav-link dropdown-item">
                  {{ $t('ias.text') }}
                </router-link>
                <router-link :to="{ name: $t('flowcal.url') }" class="nav-link dropdown-item">
                  {{ $t('flowcal.text') }}
              </router-link>
              </div>
            </li>

            <li v-if="user && user.role == 'customer'" class="nav-item dropdown" @mouseover="purchaseOver" @mouseleave="purchaseLeave">
              <router-link v-if="mobile" :to="{ name: $t('purchase.url') }"  class="nav-link" active-class="active" style="display: inline">
                {{ $t('purchase.text') }}
              </router-link>
              <router-link v-else :to="{ name: $t('purchase.url') }"  class="nav-link dropdown-toggle" active-class="active">
                {{ $t('purchase.text') }}
              </router-link>
              <div class="toggle-button-icon" :style="{display: mobile ? 'inline' : 'none'}" @click="purchaseMenuClick">
                  <b-icon v-if="purchaseShow" icon="chevron-bar-up"></b-icon>
                  <b-icon v-else icon="chevron-bar-down"></b-icon>
              </div>
              <div class="dropdown-menu" :style="{ display: purchaseShow ? 'block' : 'none' } ">
                <router-link :to="{ name: $t('transaction.url') }" class="nav-link dropdown-item">
                  {{ $t('transaction.text') }}
                </router-link>
                <router-link :to="{ name: $t('purchase_list.url') }" class="nav-link dropdown-item">
                  {{ $t('purchase_list.text') }}
                </router-link>
              </div>
            </li>

            <li v-else class="nav-item">
              <router-link :to="{ name: $t('purchase.url') }" class="nav-link" active-class="active">
                {{ $t('purchase.text') }}
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: $t('carrer.url') }" class="nav-link" active-class="active">
                {{ $t('carrer.text') }}
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: $t('contact.url') }" class="nav-link" active-class="active">
                {{ $t('contact.text') }}
              </router-link>
            </li>

            <li class="nav-item">
              <router-link :to="{ name: $t('dealer.url') }" class="nav-link" active-class="active">
                {{ $t('dealer.text') }}
              </router-link>
            </li>

            <!--<li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>-->

            <!-- <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li> -->
          </ul>

          <ul class="navbar-nav">
            <locale-dropdown />
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
  </VueScrollFixedNavbar>
</template>

<script>
import { VueScrollFixedNavbar } from "vue-scroll-fixed-navbar"
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'
import Logo from '~/assets/images/logo.png'
import Cookies from 'js-cookie'

export default {
  components: {
    LocaleDropdown,
    VueScrollFixedNavbar
  },

  data: () => ({
    logo: Logo,
    fixed: false,
    productShow: false,
    purchaseShow: false,
    togglebuttonShow: false,
    mobile: ''
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  mounted() {
    if(screen.width <= 991) {
      this.mobile = true
    } else {
      this.mobile = false
    }
  },

  created() {
    this.locale = Cookies.get('locale')
  },

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: this.locale })

      // Redirect to login.
      //window.location.href='/'
    },
    productOver() {
      this.productShow = true;
    },
    productLeave() {
      this.productShow = false;
    },
    purchaseOver() {
      this.purchaseShow = true;
    },
    purchaseLeave() {
      this.purchaseShow = false;
    },
    profileOver() {
      this.$refs.dropdown.visible = true;
    },
    profileLeave() {
      this.$refs.dropdown.visible = false;
    },
    adminDashboardShow() {
      this.$emit("user_admin", false);
      this.$router.push({name: 'dashboard'})
    },
    productMenuClick() {
      if (this.productShow == true) {
        this.productShow = false;
      } else {
        this.productShow = true;
      }
    },
    purchaseMenuClick() {
      if (this.purchaseShow == true) {
        this.purchaseShow = false;
      } else {
        this.purchaseShow = true;
      }
    }
  }
}
</script>

<style scoped>
.kRFLgj .login-dropdown {
  text-align: right;
  background-color: white;
}
.kRFLgj .login-dropdown img {
  margin-top: 5px;
  width: 35px;
  height: 35px;
}
.kRFLgj .sticky .login-dropdown {
  text-align: right;
  background-color: white;
  display: none;
}
.navbar {
  font-weight: 500;
}
.kRFLgj .nav-item {
  padding: 0 7px;
  transition: all 0.3s cubic-bezier(.46,.03,.52,.96);
  padding-bottom: 10px
}
.kRFLgj .navbar-light .navbar-nav .nav-link {
    color: #007FED;
    font-size: 18px;
}
.kRFLgj .navbar-light .navbar-nav .nav-link:hover{
    color: #000;
}
.kRFLgj .navbar img {
    width: 80%;
    transition: all 0.3s cubic-bezier(.46,.03,.52,.96);
}
.kRFLgj .sticky .nav-item {
    transition: all 0.3s cubic-bezier(.46,.03,.52,.96);
    padding: 0 5px;
}
.kRFLgj .sticky .navbar img {
    width: 40%;
    transition: all 0.3s cubic-bezier(.46,.03,.52,.96);
}
.kRFLgj .sticky .bg-white {
    background-color:#007FED;
}
.kRFLgj .nav-item .dropdown-menu,
.kRFLgj .sticky .nav-item .dropdown-menu {
  margin-top: -5px;
  padding: 0 5px;
}
.toggle-button-icon {
  position: relative;
  float: right;
  color: #007FED;
}
</style>


