<template>
    <div>
        <!-- If Authentification -->
        <div v-if="user">
            
            <div v-if="user.role == 'agency'">
                <Alertsection />
            </div>

            <div v-else>
                 <!-- IAS Image analysis web application -->
                <IAS />

                <!-- FlowCal flowcytomery analysis Web application -->
                <Flowcal />
            </div>
        </div>
        <div v-else>
            <Loginsection :registername='true'/>
        </div>
    </div>
</template>

<script>
import IAS from '~/components/jp/catalog/IAS'
import Flowcal from '~/components/jp/catalog/Flowcal'
import Loginsection from '~/pages/auth/login'
import Alertsection from '~/components/Alert'
import { mapGetters } from 'vuex'
import Cookies from 'js-cookie'

export default {
    components: {
        IAS,
        Flowcal,        
        Loginsection,
        Alertsection
    },
    computed: mapGetters({
        user: 'auth/user'
    }),
    created() {
        Cookies.set('intended_url', this.$route.path)
    }
}
</script>
