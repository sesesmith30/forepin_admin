<template>
    <div class="container">
        <donut-chart style="height: 250px;"
          id="donut" 
          :data="donutData" 
          colors='[ "#FF6384", "#36A2EB" ]' 
          resize="true">
        </donut-chart>
    </div>
</template>

<script>
  import Raphael from 'raphael/raphael'
  global.Raphael = Raphael
  import { DonutChart } from 'vue-morris'
    export default {
        props: ['actives'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                 donutData: [
                  { label: 'Active', value: this.actives },
                  { label: 'Inactive', value: 0 },
                ],
            }
        },
        components: {
            DonutChart
        }

    }
</script>
