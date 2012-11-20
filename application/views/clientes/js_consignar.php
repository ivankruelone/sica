<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
<script language="javascript" type="text/javascript">
  var geocoder;
  var map;
  var latitud;
  var longitud;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var myOptions = {
      zoom: 16,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  }
  
  initialize();

  function codeAddress(address) {
    if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
          var marker = new google.maps.Marker({
              map: map, 
              position: results[0].geometry.location
          });
          
          var latitud = map.getCenter().lat();
          var longitud = map.getCenter().lng();
          
          
        } else {
          alert("La Geolocalizacion no fue posible, por la siguiente razon: " + status);
        }
      });
    }
    
   
  }
  
      var address = $( '#direccion' ).html();

  
  codeAddress(address);
</script>