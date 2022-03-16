<template>
    <button type="submit" class="btn btn-outline-success" @click="addProduct">
        <em class="fas fa-cart-plus"></em> Añadir
    </button>
</template>
<script>
export default {
    props: {
        productId: {
            type: Number
        }
    },
    methods: {
        addProduct () {
            axios
                .post('/cart', {
                    id: this.productId,
                })
                .then(response => {
                    this.$notify({ type: 'success', text: 'Producto agregado!' })

                    this.$root.$emit('product-added', {
                        count: response.data.count
                    })
                })
                .catch(error => {
                    console.log(error)
                })
        }
  },
}
</script>