
 var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
      '<div id="bodyContent">'+
      '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b> <br>, is a large ' +
      'sandstone rock formation<br> in the southern part of the '+
      'Heritage Site.</p>'+
      '<p>Attribution: Uluru, <br><a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
      'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
      '<br>(last visited June 22, 2009).</p>'+
      '</div>'+
      '</div>';

   var infowindow = new google.maps.InfoWindow({
      content: contentString
  });



var map;
$(document).ready(function () {
	(map = new GMaps({
		div: "#gmaps-markers",
		lat: 5.5600141,
		lng: -0.2057437
	})).addMarker({
		lat: 5.588943,
		lng: -0.230021,
		title: "Lima",
		details: {
			database_id: 42,
			author: "HPNeo"
		},
		click: function (a) {
			infowindow.open(map,a);
		}
	}), (map = new GMaps({
		div: "#gmaps-overlay",
		lat: 5.588943,
		lng: -0.230021
	})).drawOverlay({
		lat: map.getCenter().lat(),
		lng: map.getCenter().lng(),
		content: '<div class="gmaps-overlay">Our Office!<div class="gmaps-overlay_arrow above"></div></div>',
		verticalAlign: "top",
		horizontalAlign: "center"
	}), map = GMaps.createPanorama({
		el: "#panorama",
		lat: 42.3455,
		lng: -71.0983
	}), (map = new GMaps({
		div: "#gmaps-types",
		lat: -12.043333,
		lng: -77.028333,
		mapTypeControlOptions: {
			mapTypeIds: ["hybrid", "roadmap", "satellite", "terrain", "osm"]
		}
	})).addMapType("osm", {
		getTileUrl: function (a, e) {
			return "https://a.tile.openstreetmap.org/" + e + "/" + a.x + "/" + a.y + ".png"
		},
		tileSize: new google.maps.Size(256, 256),
		name: "OpenStreetMap",
		maxZoom: 18
	}), map.setMapTypeId("osm")
});