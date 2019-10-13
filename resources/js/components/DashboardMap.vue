<template>
  <div>
    <br>

    <gmap-map
      ref="map"
      :center="center"
      :zoom="12"
      :options="{
        mapTypeControl: false,
      }"
      style="width:100%;  height: 100px;border-radius: 8px;"
    >

  
      
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :icon="{ 
          url: 'https://img.icons8.com/?id=488&format=png&size=500&color='+getColorCodeFromUserId(m.promoterId)+'',
          scaledSize: {width: 25, height: 25, f: 'px', b: 'px'}
        }"
        @click="openWindow(m)"
        
      ></gmap-marker>


        <gmap-info-window 
            @closeclick="infoWinOpen=false" 
            :opened="infoWinOpen" 
            :position="infoWindowPos"
             :options="{
                pixelOffset: {
                  width: 0,
                  height: -15
                }
              }"
        >
            <label>
              Name: {{ infoData[0] }}
              <br><br>
              Locality: {{ infoData[2] }}
               <br><br>
              <!-- <div v-if="isOutlet"> -->
                <a :href='`${ infoData[1] }`' >{{ infoData[1] }}</a>  
                <br><br>
                </i></label>
              <!-- </div> -->

            </label>
        </gmap-info-window> 


    </gmap-map>
  </div>
</template>

<script>
  
  export default {
    name: 'DashboardMap',
    data() {
      return {
        center: { lat: 5.5600141, lng: -0.230021 },
        infoWindowPos: {lat: 0, lng: 0},
        infoWinOpen: false,
        markers:[],
        infoData: [],

        mounted() {
              //set bounds of the map
          this.$refs.gmap.$mapPromise.then((map) => {
            const bounds = new google.maps.LatLngBounds()
            for (let m of this.markers) {
              bounds.extend({lat: Number(m.latitude), lng: Number(m.longitude)})
            }
            map.fitBounds(bounds);
          });
        },

        created() {
          axios.get("api/outlets").then(function(response) {
            response.data.forEach(function(data) {
              this.markers.push(data);
              this.center = { lat: Number(data.latitude), lng: Number(data.longitude) };
            });
          });
        },

        methods: {
          openWindow (marker) {

            this.infoData[1] = "http://68.183.151.163/admin/outlet/"+marker.id+"/details";
            this.infoData[0] = marker.outlet_name;
            this.infoData[2] = marker.locality;

            let position = { 
              lat: Number(marker.latitude), 
              lng: Number(marker.longitude)
            };

            // this.center = marker.position
            this.$refs.map.panTo(position);

            // console.log("ref is "+this.$refs.map);

            this.infoWindowPos = position;
            this.infoWinOpen = true;

        },
        }
      }
    }

  }

</script>