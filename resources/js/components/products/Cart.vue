<template>
    <div class="card">
        <div class="card-header card-header-primary">
            <div class="card-title"><strong></strong></div>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-end">Subtotal</th>
                        <th scope="col" class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, index) in products" :key="product.id">
                        <th scope="row">1</th>
                        <td>{{ product.name }}</td>
                        <td class="w-25">
                            <div class="input-group w-50">
                                <button class="btn btn-outline-secondary" type="button" @click="decrement(product)">-</button>
                                <span type="text" class="form-control" name="quantity" :value="product.qty">{{ product.qty }}</span>
                                <button class="btn btn-outline-secondary" type="button" @click="increment(product)">+</button>
                            </div>
                            <!-- <input type="number" class="form-control col-sm-2" name="quantity" :value="product.qty"> -->
                        </td>
                        <td class="text-center">{{ product.price }}</td>
                        <td class="text-end">{{ product.qty * product.price }}</td>
                        <td class="text-end">
                                <button class="btn btn-danger" @click="remove(product.rowId, index)">
                                    <i class="fas fa-trash"></i>
                                </button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row">Total</th>
                        <td colspan="4" class="text-end">{{ total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer justify-content-center">
            <div class="btn-group">
                <a href="/payments" class="btn btn-primary mx-3">
                    <em class="fas fa-money-bill"></em> Generar Pago
                </a>
                <button class="btn btn-danger" @click="destroy">
                    <em class="fas fa-trash"></em> Vaciar carrito
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    props: {
        content: {
            type: Object|Array,
            default: []
        }
    },
    mounted(){
        this.products = Array.isArray(this.content) ? this.content : Object.values(this.content)
    },
    data(){
        return {
            products: [],
        }
    },
    computed: {
        total () {
            return Object.values(this.products).reduce((total, product) => {
                return total + (product.qty * product.price)
            }, 0)
        }
    },
    methods: {
        destroy () {
            axios
                .delete('/cart')
                .then(response => {
                    window.location.href = '/'
                })
                .catch(error => {
                    this.$notify({ type: 'error', text: 'Ha ocurrido un error' })
                })
        },
        remove (id, index) {
            axios
                .delete('/cart/' + id)
                .then(response => {
                    this.products.splice(index, 1)
                    this.$notify({ type: 'success', text: 'Producto eliminado!' })
                })
                .catch(error => {
                    this.$notify({ type: 'error', text: 'Ha ocurrido un error' })
                })
        },
        increment (product) {
            axios
                .put('/cart/' + product.rowId + '/increment')
                .then(response => {
                    if (response.data.qty > product.qty) {
                        product.qty = response.data.qty
                        this.$notify({ type: 'success', text: 'Uno más!' })    
                    }
                })
                .catch(error => {
                    this.$notify({ type: 'error', text: 'Ha ocurrido un error!' })
                })
        },
        decrement (product) {
            axios
                .put('/cart/' + product.rowId + '/decrement')
                .then(response => {
                    product.qty = response.data.qty
                    this.$notify({ type: 'success', text: 'Uno menos!' })
                })
                .catch(error => {
                    this.$notify({ type: 'error', text: 'Ha ocurrido un error!' })
                })
        }
    },
};
</script>