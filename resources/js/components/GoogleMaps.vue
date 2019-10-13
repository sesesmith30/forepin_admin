<template>
  <div>
    <br>

     <!--  <div class="row"> 
          
          <div class="col-md-6">
              <select @change="onUserChange($event)" ref="promoter" style="width: 100%" class="form-control">
                <option value="0">All Promoters</option>
                <option v-for="promoter in systemPromoters" :value="promoter.userId"> {{ promoter.label }} </option>
              </select>
          </div>

          <div class="col-md-5">
            <input type="text"
            data-range="false"
            data-multiple-dates-separator=" - "
            data-language="en"
            data-date-format="yyyy-mm-dd"
            ref="time"
            placeholder="Select Time range" 
            class="datepicker-here form-control"/>
          </div>

          <div class="col-md-1">
              <button v-on:click="onFilterTapped()" class="btn btn-primary pull-right" style="width: 80%">
                <i class="fa fa-refresh"></i>
              </button>
          </div>

      </div> -->
     <!--  <div class="row">
        <div class="col-md-6">
          <b>Name:</b> <span > {{ selectedUser.user.name }} </span><br>
          <b>Section:</b> <span > {{ selectedUser.user.client_type }}</span><br>
          <b>Collections:</b> <span > Ghc {{ selectedUser.collection }} </span><br>
          <b>Orders:</b> <span > Ghc {{ selectedUser.orders }} </span><br>
          <b>Visits:</b> <span > {{ selectedUser.visits }} </span><br>
          <a href="">View more</a>
        </div>
      </div> -->
      
      <br>

    <gmap-map
      ref="map"
      :center="center"
      :zoom="10"
      :options="{
        mapTypeControl: false,
        fullscreenControl: false,
        zoomControl: true,
        gestureHandling: 'greedy'
      }"
      style="width:100%;  height: 600px;"
    >

      <HeatMap :points="path"/>
      
      <gmap-cluster>
        <gmap-marker
          :key="index"
          v-for="(m, index) in markers"
          :position="m.position"
          :icon="{ 
            url: 'https://img.icons8.com/?id=488&format=png&size=500&color='+getColorCodeFromUserId(m.promoterId)+'',
            scaledSize: {width: 25, height: 25, f: 'px', b: 'px'}
          }"
          @click="openWindow(m,false)"
        ></gmap-marker>
      </gmap-cluster>


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
              <!-- <div v-if="isOutlet"> -->
                <a :href='`${ infoData[1] }`' >{{ infoData[1] }}</a>  
                <br><br>
                <label v-if="infoData[2]">Batter Level : <i class="fa fa-battery-three-quarters"> {{ infoData[2] }}</i></label>
              <!-- </div> -->

            </label>
        </gmap-info-window> 
      <gmap-cluster>
      <gmap-marker
        :key="index"
        v-for="(m, index) in promoters"
        :position="m.position",
        :icon="{ 
          url: 'https://img.icons8.com/?id=12684&format=png&size=500&color='+getColorByPromoterId(m.userId,m.timestamp)+'',
          scaledSize: {width: 25, height: 25, f: 'px', b: 'px'}
        }"
        @click="openWindow(m,true)"
      ></gmap-marker>
    </gmap-cluster>


    </gmap-map>
  </div>
</template>

<script>

import HeatMap from './heatMap.js'

export default {
  
  components: {HeatMap},

  name: "GoogleMap",
  data() {
    return {
      // default to Montreal to keep it simple
      // change this to whatever makes sense
      center: { lat: 5.5600141, lng: -0.230021 },
      markers: [],
      places: [],
      promoters: [],
      systemPromoters: [],
      currentPlace: null,
      info_marker: null,
      isOutlet: false,
      time: '',
      selectedUser: {
        user: {
          name: null
        },
      },
      heatMap: [],
      infoData: [],
      infowindow: {lat: 10, lng: 10.0},
      window_open: false,
      path: [
      ]
    };
  },

  mounted() {
    this.geolocate();

  },
  created() {
    this.time = this.getDesiredDate();
    console.log("am created");
    this.initApp()

    let currentDate = this.time;

    const self = this;
    axios.get(`/api/promoter/0/session/${currentDate}`).then(function(response){
        response.data.forEach(function (data) {
            var promoterId = 0;
            if (data.promoter != undefined || data.promoter != null) {
              promoterId = data.promoter.id;
            }
            self.addMarkerWithCoodinates(Number(data.logitude),Number(data.latitude),data.outlet_name,data.id);
        });
      });

    var users = firebase.database().ref('Users');

    users.on("value",function(snapshot) {

        self.promoters = [];
        console.log(self.promoters);

        snapshot.forEach(function(child){
          let val = child.val();
          // let currentDate = self.formatDate(new Date());
          console.log("time is "+self.time);
          let currentDate = self.formatDate(new Date(self.time));
          console.log("currentDate is "+currentDate);

          window.myVar = val;

          self.addPromoterMarker(val.current.latitude,val.current.longitude,val.current.name,val.current.userId,val.current.timestamp,val.current.batter_level);

          var today = val[currentDate];

          if ( today != null ) {

            console.log("today is "+today);

            Object.keys(today).forEach(function( todayKey ){

                var todayData = today[todayKey];

                let position = {lat: todayData.latitude,lng: todayData.longitude};

                self.heatMap.push({ position: position });

                self.path.push(position);

            });
          }

        });

        self.systemPromoters = self.promoters;
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
    onUserChange(event) {

      let userId = event.target.value;

      console.log("user is "+userId+" and time is "+this.time);

      let self = this;
      axios.get(`/api/loadUserMapStat/${userId}/on/${this.time}`).then(function(res){
          self.selectedUser = res.data;  
      })


    },

    openWindow (marker,isOutlet) {

        this.infoData[0] = marker.label;

        if (isOutlet) {
          this.infoData[1] = "http://68.183.151.163/promoter/"+marker.userId+"/show";
          this.infoData[2] = marker.batteryLevel;
        }else {
          this.infoData[1] = "http://68.183.151.163/admin/outlet/"+marker.userId+"/details";
          this.infoData[0] = marker.name;
          this.infoData[2] = "";
        }

        // this.center = marker.position
        this.$refs.map.panTo(marker.position);

        // console.log("ref is "+this.$refs.map);

        this.infowindow = marker.position;
        this.window_open = true;
        this.isOutlet = isOutlet;

    },
    addMarkerWithCoodinates(lat,lng,name,userId,promoterId) {
        const marker = {
          lat: lat,
          lng: lng
        };
        this.markers.push({promoterId: promoterId, userId: userId, name: name,position: marker});
        this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
    },

    addPromoterMarker(lat,lng,name,userId,timestamp,batteryLevel) {
        const marker = {
          lat: lat,
          lng: lng,
        };
        this.promoters.push({ userId: userId,batteryLevel: batteryLevel,label: name,position: marker,timestamp: timestamp, });
        // this.places.push(this.currentPlace);
        this.center = marker;
        this.currentPlace = null;
    },

    getColorNameFromUserId(userId) {
        if(userId == 1) {
            return "yellow"
        }else if(userId == 2) {
            return "blue"
        }else if(userId == 3) {
            return "red"
        }else if(userId == 4)  {
          return "green"
        }else {
          return "pink"
        }
    },
    getDesiredDate() {
      
      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
      var yyyy = today.getFullYear();

      today = yyyy + '-' + mm + '-' + dd;

      return today;
    },

    getColorCodeFromUserId(userId) {


        if(userId == 1) {
            return "CCCC00"
        }else if(userId == 2) {
            return "0000FF"
        }else if(userId == 3) {
            return "FF0000"
        }else if(userId == 4)  {
          return "00FF00"
        }else {
          return "FF69B4"
        }

    },
    getColorByPromoterId (userId,timestamp) {

      let currentTimestamp = new Date().getTime();
      let diffInMin = Math.ceil ( Math.abs( currentTimestamp - timestamp )  / (1000 * 60) );


      if (diffInMin > 5)  {
        return "000000";
      }else {
        return "FF0000";
      }
    },
    onFilterTapped () {

      let currentTimeFromRef = this.$refs.time.value;
      var currentDate = currentTimeFromRef;
      let currentPromoter = this.$refs.promoter.value;


      console.log("currentTimeFromRef is "+currentTimeFromRef);



      this.markers = [];


      const self = this;

      console.log("currentDate is "+currentDate+ " and current promoter "+currentPromoter);

      axios.get(`/api/promoter/${currentPromoter}/session/${currentDate}`).then(function(response){
        response.data.forEach(function (data) {
            var promoterId = 0;
            if (data.promoter != undefined || data.promoter != null) {
              promoterId = data.promoter.id;
            }
            self.addMarkerWithCoodinates(Number(data.logitude),Number(data.latitude),data.outlet_name,data.id,promoterId);
        });
      });


      var users = firebase.database().ref('Users');
      users.off("value");

      this.promoters = [];

      users.on("value",function(snapshot) {

        self.promoters = [];
        console.log(self.promoters);

        snapshot.forEach(function(child){
          let val = child.val();
          

          let currentDate = self.$refs.time.value;

          console.log("currentDate is "+currentDate);


          window.myVar = val;

          if (val.current.userId != currentPromoter) {
              return;
          }

          console.log("promoter is "+val.current.userId+" and currentPromoter is "+currentPromoter);


          self.addPromoterMarker(val.current.latitude,val.current.longitude,val.current.name,val.current.userId,val.current.timestamp,val.current.batter_level);

          var today = val[currentDate];

          if ( today != null ) {

            console.log("today is "+today);

            Object.keys(today).forEach(function( todayKey ){

                var todayData = today[todayKey];

                let position = {lat: todayData.latitude,lng: todayData.longitude};

                self.heatMap.push({ position: position });

                self.path.push(position);

            });
          }

        });
      });

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