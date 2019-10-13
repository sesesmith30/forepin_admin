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
      style="width:100%;  height: 300px;"
    >
      <HeatMap :points="path"/>
      
      <gmap-marker
        :key="index"
        v-for="(m, index) in markers"
        :position="m.position"
        :icon="{ 
          url: 'https://image.icons8.com/?id=13010&format=png&size=500&color=000000',
          scaledSize: {width: 25, height: 25, f: 'px', b: 'px'}
        }"
        @click="openWindow(m,false)"
      ></gmap-marker>


       <gmap-info-window 
            @closeclick="window_open=false" 
            :opened="window_open" 
            :position="infowindow"
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

              <div v-if="isOutlet">
                <a :href='`${ infoData[1] }`' >{{ infoData[1] }}</a>  
              </div>

            </label>
        </gmap-info-window> 

      <gmap-marker
        :key="index"
        v-for="(m, index) in promoters"
        :position="m.position"
        @click="openWindow(m,true)"
      ></gmap-marker>


    </gmap-map>
  </div>
</template>

<script>

import HeatMap from './heatMap.js'

export default {
  
  components: {HeatMap},

  name: "PromoterMap",
  data() {
    return {
      // default to Montreal to keep it simple
      // change this to whatever makes sense
      center: { lat: 5.5600141, lng: -0.230021 },
      markers: [],
      places: [],
      promoters: [],
      currentPlace: null,
      info_marker: null,
      isOutlet: false,
      infoData: [],
      infowindow: {lat: 10, lng: 10.0},
      window_open: false,
      path: [
      ]
    };
  },
  props: {
    id: {
      type: String,
      required: true
    },
  },

  mounted() {
    this.geolocate();

  },
  created() {

    this.initApp()

    const self = this;
    axios.get("/api/promoter/32323/outlets/"+this.id).then(function(response){
        response.data.forEach(function (data) {
            self.addMarkerWithCoodinates(Number(data.logitude),Number(data.latitude),data.outlet_name,data.id);
        });
    });

    var users = firebase.database().ref('Users');

    users.on("value",function(snapshot) {

        self.promoters = [];
        console.log(self.promoters);


        snapshot.forEach(function(child){
          let val = child.val();
          let currentDate = self.formatDate(new Date());

          window.myVar = val;
          
          self.addPromoterMarker(val.current.latitude,val.current.longitude,val.current.name,val.current.userId);

          var today = val["2019-06-24"];

          Object.keys(today).forEach(function( todayKey ){

              var todayData = today[todayKey];


              self.path.push({lat: todayData.latitude,lng: todayData.longitude});

          });

        });
    });

     


  },
  methods: {
    // receives a place object via the autocomplete component
    setPlace(place) {
      this.currentPlace = place;
    },

    formatDate(date) {
      var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();

      if (month.length < 2) month = '0' + month;
      if (day.length < 2) day = '0' + day;

      return [year, month, day].join('-');
    },

    initApp () {
        const config = {
            apiKey: "AIzaSyCW3AkoT3tIRJLBMF9jUCrikea5Cf1gbRU",
            authDomain: "promo-pitch-1550250738193.firebaseapp.com",
            databaseURL: "https://promo-pitch-1550250738193.firebaseio.com",
            projectId: "promo-pitch-1550250738193",
            storageBucket: "promo-pitch-1550250738193.appspot.com",
            messagingSenderId: "701189542587"
        };


        firebase.initializeApp(config);
    },

    openWindow (marker,isOutlet) {
        // console.log(this);
        

        console.log(this.outlet)
        this.infoData[0] = marker.label;
        this.infoData[1] = "https://google.com/"+marker.userId;

        this.center = marker.position
        this.infowindow = marker.position;
        this.window_open = true;
        this.isOutlet = isOutlet;

    },
    addMarkerWithCoodinates(lat,lng,name,userId) {
        const marker = {
          lat: lat,
          lng: lng
        };
        this.markers.push({ userId: userId, name: name,position: marker });
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
    },

    addPromoterMarker(lat,lng,name,userId) {
        const marker = {
          lat: lat,
          lng: lng,
        };
        this.promoters.push({ userId: userId ,label: name,position: marker });
        // this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
    },

    geolocate: function() {
      navigator.geolocation.getCurrentPosition(position => {
        this.center = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
      });
    }
  }
};
</script>