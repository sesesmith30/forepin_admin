import {MapElementFactory} from 'vue2-google-maps'

export default MapElementFactory({
  name: 'heatMap',
  ctr: () => google.maps.visualization.HeatmapLayer,
  //// The following is optional, but necessary if the constructor takes multiple arguments
  //// e.g. for GroundOverlay
  // ctrArgs: (options, otherProps) => [options],
  events: [],

  // Mapped Props will automatically set up
  //   this.$watch('propertyName', (v) => instance.setPropertyName(v))
  //
  // If you specify `twoWay`, then it also sets up:
  //   google.maps.event.addListener(instance, 'propertyName_changed', () => {
  //     this.$emit('propertyName_changed', instance.getPropertyName())
  //   })
  //
  // If you specify `noBind`, then neither will be set up. You should manually
  // create your watchers in `afterCreate()`.
  mappedProps: {
  
    //// If you have a property that comes with a `_changed` event,
    //// you can specify `twoWay` to automatically bind the event, e.g. Map's `zoom`:
    // zoom: {type: Number, twoWay: true}
  },
  // Any other properties you want to bind. Note: Must be in Object notation
  props: {
  	 points: {
      type: Array,
      required: true
    },
  },
  // Actions you want to perform before creating the object instance using the
  // provided constructor (for example, you can modify the `options` object).
  // If you return a promise, execution will suspend until the promise resolves
  beforeCreate (options) {},
  // Actions to perform after creating the object instance.
  afterCreate (directionsRendererInstance) {
  	console.log(this.points);

  	this.$watch('points', () => {

  		let path = new google.maps.LatLng(5.5579793, -0.2603767);

	  	let paths = this.points.map(
	        point => new google.maps.LatLng(point.lat, point.lng)
	      );


	  	console.log("paths" +paths);


	  	let x = new google.maps.visualization.HeatmapLayer({
	      data: paths,
	      map: directionsRendererInstance.map,
	      radius: 20
	    }); 
	    x.setMap(directionsRendererInstance.map)

  	})

  	


  },
})