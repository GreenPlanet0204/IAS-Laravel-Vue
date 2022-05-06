<template>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <h5>Life Analytics</h5>
                    <div class="content">
                        <span>{{ $t('foot_description') }}<br /></span>
                        <span>support@lifeanalytics.org</span>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h5 style="padding:0 20px;">{{ $t('sitemap') }}</h5>
                    <div class="menu">
                        <router-link :to="{ name: $t('home.url') }" class="nav-link" active-class="active">
                            {{ $t('home.text') }}
                        </router-link>
                        <router-link :to="{ name: $t('products.url') }" class="nav-link" active-class="active">
                            {{ $t('products.text') }}
                        </router-link><a></a>
                        <router-link :to="{ name: $t('purchase.url') }" class="nav-link" active-class="active">
                            {{ $t('purchase.text') }}
                        </router-link>
                        <router-link :to="{ name: $t('carrer.url') }" class="nav-link" active-class="active">
                            {{ $t('carrer.text') }}
                        </router-link><a></a>
                        <router-link :to="{ name: $t('contact.url') }" class="nav-link" active-class="active">
                            {{ $t('contact.text') }}
                        </router-link>
                        <router-link :to="{ name: $t('dealer.url') }" class="nav-link" active-class="active">
                            {{ $t('dealer.text') }}
                        </router-link><a></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

.footer {
  padding: 30px 0;
  border-top:1px solid gainsboro;
}
.footer.row {
    margin: 0;
}
.footer .content{
  padding: 18px 0;
  line-height: 2rem
}
.footer .menu {
  padding: 10px 0;
  line-height: 2rem
}
.footer .content >span {
  font-size: 15px;
}
</style>
