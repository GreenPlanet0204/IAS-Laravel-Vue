<template>
</template>

<script>
import swal from 'sweetalert2/dist/sweetalert2.js'
import { mapGetters } from 'vuex'
export default {
    data: () => ({
    }),
    computed: mapGetters({
        user: 'auth/user'
    }),
    beforeMount() {
        if(this.user.role == 'customer') {
            swal.fire({
                icon: 'warning',
                title: this.$t('agencyalertTitle'),
                text: this.$t('agencyalertText'),
                reverseButtons: true,
                confirmButtonText: this.$t('ok'),
                cancelButtonText: this.$t('cancel')
            }).then(() => {
                this.$router.push({ name: 'home' })
            })
        } else if (this.user.role == 'agency') { 
            swal.fire({
                icon: 'warning',
                title: this.$t('customeralertTitle'),
                text: this.$t('customeralertText'),
                reverseButtons: true,
                confirmButtonText: this.$t('ok'),
                cancelButtonText: this.$t('cancel')
            }).then(() => {
                this.$router.push({ name: 'home' })
            })
        };
        
    }
}
</script>