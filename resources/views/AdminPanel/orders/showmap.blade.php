<div class="modal fade text-md-start" id="showmap{{ $order->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{ trans('common.show') }}</h1>
                </div>
                <style>
                
                </style>
               <div id="map{{ $order->id }}" style="width:100%; height: 400px;" ></div>



<script>
function fitBoundsToCoordinates(lat1, lng1, lat2, lng2,map) {
  

  const bounds = new google.maps.LatLngBounds();

  // Create LatLng objects for the two coordinates
  const point1 = new google.maps.LatLng(lat1, lng1);
  const point2 = new google.maps.LatLng(lat2, lng2);

  // Extend the bounds to include both points
  bounds.extend(point1);
  bounds.extend(point2);

  // Fit the map bounds to the calculated bounds
  map.fitBounds(bounds);
}
function initMap() {




  var origin = { lat: {{$order->address->latitude}}, lng: {{$order->address->longitude}} };
  var destination = { lat: {{$order->delivery()->first()->latitude}}, lng: {{$order->delivery()->first()->longitude}} };

  var map = new google.maps.Map(document.getElementById('map{{ $order->id }}'), {
    center: origin,
    zoom: 14
  });
fitBoundsToCoordinates({{$order->address->latitude}},{{$order->address->longitude}},{{$order->delivery()->first()->latitude}},{{$order->delivery()->first()->longitude}},map);
  // Define the origin marker
  var originMarker = new google.maps.Marker({
    position: origin,
    map: map,
    icon: '{{asset('assets/img/icons/profile.png')}}',
  });

  // Define the destination marker
  var destinationMarker = new google.maps.Marker({
    position: destination,
    map: map,

    icon: '{{asset('assets/img/icons/motorcycle.png')}}',
  });

  try {
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer({
      map: map,
      suppressMarkers: true
    });

    var request = {
      origin: origin,
      destination: destination,
      travelMode: google.maps.TravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
      if (status === google.maps.DirectionsStatus.OK) {
        directionsRenderer.setDirections(response);
      } else {
       
      }
    });
  } catch (error) {
  
  }
}
initMap()
</script>
      
        
            </div>
        </div>
    </div>
</div>
