<template>
    <!-- <date-picker v-model="range" lang="en" confirm range type="date" format="YYYY-MM-DD" width="500"></date-picker> -->
    <section>
      <date-picker
        v-model="range"
        confirm
        range
        type="date"
        :default-value="new Date().setHours(12, 0, 0, 0)"
        :disabled-date="notBeforeToday"
        :disabled-time="notBeforeTodayTwelveOClock"
        value-type="format"
      ></date-picker>
    </section>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';

    export default {
        components: {
            DatePicker 
        },
        data() {
            return {
                time: '',
                range: ''
            }
        },
        watch: {
            range(){
                this.$emit('input', this.range)
            }
        },
        methods: {
            notBeforeToday(date) {
                return date > new Date(new Date().setHours(0, 0, 0, 0));
            },
            notBeforeTodayTwelveOClock(date) {
                return date < new Date(new Date().setHours(12, 0, 0, 0));
        },
        }
}
</script>
