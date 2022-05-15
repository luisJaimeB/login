<template>
    <div class="card mb-3">
        <div class="row d-flex justify-content-center">
            <div class="col-8">
            <div class="card-body d-flex justify-content-center">
                <!-- <div class="row">
                    <div class="col-12 mt-3">
                        <label for="filters" class="form-label">Escoge un dato de exporte</label>
                        <select v-model="exporteDate" id="exporteDate" class="form-select">
                            <option value="" selected disabled>Escoge un dato...</option>
                            <option value="email">Correo electrónico</option>
                            <option value="address">Dirección de correspondencia</option>
                        </select>
                    </div>
                </div> -->
                <div class="row">
                    <div class="col-6">
                        <label class="card-title">Rango de fecha: </label>
                    </div>
                    <div class="col-6">
                        <p class="card-text me-1">
                            <date-picker-input v-model="date"></date-picker-input>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <div class="text-right">
                    <button class="btn btn-sm btn-info" :disabled="!hasDateRange" @click="redirect">
                        <!-- <i class="fas fa-file-pdf fa-lg"></i> --> Generar
                    </button>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import DatePickerInput from './DatePickerInput'

export default {
    components: {
        DatePickerInput
    },
    data(){
        return {
            date: []
        }
    },
    computed: {
        hasDateRange(){
            return this.date.length === 2
        }
    },
    methods: {
        redirect(){
            window.location.href = `/admin/report/invoices/?start_date=${this.date[0]}&end_date=${this.date[1]}`
        }
    }
}
</script>