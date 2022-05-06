<template>
    <div>
        <!-- Description -->
        <div class="container description">
            <h5>{{$t('products.description')}}</h5>
        </div>

        <!-- List of Applications -->
        <Applicationsection />
    </div>
</template>

<script>
import Applicationsection from '~/components/en/products/Application'

export default {
    components: {
        Applicationsection
    }
}
</script>

<style scoped>
.container.description {
    padding: 50px 4rem;
}
</style>
