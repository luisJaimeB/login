<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">description</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal" @click="detail"><i class="material-icons">person</i></button>
        </td>
      </tr>
      <product-show v-for="product in products.data" :key="product.id" :product="product"></product-show>
    </tbody>
  </table>
</template>

<script>
import ProductShow from './ProductShow'

export default {
    components: {
        ProductShow
    },
    props: {
        products: {
            type: Object
        }
    },
    methods: {
    detail(data){
      this.info=data
      $('#detailModal').modal('show')
    }
  }

}
</script>

<style lang="scss" scoped>

</style>