<template>
  <div>
    <GmapMap
      :center="{lat:10, lng:10}"
      :zoom="7"
      map-type-id="terrain"
      style="width: 500px; height: 300px"
    >

      <GmapMarker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :clickable="true"
        :draggable="true"
        @click="center=m.position"
      />
    </GmapMap>
  </div>

</template>

<script>

  export default {
    name: 'Map',
    data() {
        return {
         center: {
            lat: 10.0,
            lng: 10.0
          },
          markers: [{ position: {
              lat: 10.0,
              lng: 10.0
            }
            }, {  position: {
              lat: 11.0,
              lng: 11.0
            }
          }]
        };
      },
    methods: {

    },
    created() {
      console.log("am")
    } 
  };

</script>





