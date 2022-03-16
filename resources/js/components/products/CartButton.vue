<template>
    <a href="/cart" class="btn btn-outline-dark mx-3">
        <i class="bi-cart-fill me-1"></i>
        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ count }}</span>
    </a>
</template>
<script>
export default {
    props: {
        currentCount: {
            type: Number
        }
    },
    data () {
        return {
            count: 0
        }
    },
    mounted () {
        this.count = this.currentCount

        this.$root.$on('product-added', data => {
            this.count = data.count
        })
    }
}
</script>