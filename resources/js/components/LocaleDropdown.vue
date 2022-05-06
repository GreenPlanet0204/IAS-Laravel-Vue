<template>
  <li v-if="Object.keys(locales).length > 1" class="nav-item dropdown bottom" @mouseover="languageOver" @mouseleave="languageLeave">
    <a v-if="mobile" class="nav-link" href="#" role="button"
       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline"
    >
      {{ $t('language') }}
    </a>
    <a v-else class="nav-link dropdown-toggle" href="#" role="button"
       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
    >
      {{ $t('language')}}
    </a>
    <div class="toggle-button-icon" :style="{display: mobile ? 'inline' : 'none'}" @click="langMenuClick">
        <b-icon v-if="langShow" icon="chevron-bar-up"></b-icon>
        <b-icon v-else icon="chevron-bar-down"></b-icon>
    </div>
    <div class="dropdown-menu" :style="{ display: langShow ? 'block' : 'none' }">
      <a v-for="(value, key) in locales" :key="key" class="dropdown-item" href="#"
         @click.prevent="setLocale(key)"
      >
        {{ $t(value) }}
      </a>
    </div>
  </li>
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  data: () => ({
    langShow: false,
    mobile: ''
  }),

  mounted() {
    if(screen.width <= 991) {
      this.mobile = true
    } else {
      this.mobile = false
    }
  },

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
      this.$router.push({ name: locale  })
    },
    languageOver() {
      this.langShow = true;
    },
    languageLeave() {
      this.langShow = false;
    },
    langMenuClick() {
      if(this.langShow == true) {
        this.langShow = false;
      } else {
        this.langShow = true;
      }
    }
  }
}
</script>

<style scoped>
.bottom {
  padding-bottom: 20px;
  font-size: 18px;
}
.nav-item .nav-link {
    color: #007FED;
}
.nav-item .nav-link:hover {
    color: #000;
}
.dropdown-item:hover {
  color: #007FED;
}
.nav-item .dropdown-menu {
  margin-top: -5px;
}
.toggle-button-icon {
  position: relative;
  float: right;
  color: #007FED;
}
</style>
