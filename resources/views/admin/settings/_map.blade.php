@section('head')
<style>
#map_tile {
	height: 300px;
}
</style>
@endsection
<div class="col-lg-6">
    <form class="form-horizontal" action="{{ url('/admin/settings') }}" method="POST">
    	<input type="hidden" name="_method" value="PATCH">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    	<input type="hidden" name="page" value="map">
        <div class="form-group">
            <label class="control-label col-md-4" for="address">Address <span class="text-danger" title="Required">*</span></label>
            <div class="col-md-8">
                <textarea name="address" class="form-control" required id="address" rows="5">{{ $settings['address'] or '' }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4" for="phone2">Map  <span class="text-danger" title="Required">*</span></label>
            <div class="col-md-8">
            	<input type="hidden" name="marker" value="{{ $settings['marker'] or '' }}">
            	<input type="hidden" name="map_zoom" value="{{ $settings['map_zoom'] or '' }}">
				<div id="map_tile"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
</div>

@section('scripts')
<script>
  var map;
  var marker;
@php
$marker = explode(',', $settings['marker']);
@endphp
  var center = {
  	lat: {{ $marker[0] }}, lng: {{ $marker[1] }}
  };
  function initMap() {
    map = new google.maps.Map(document.getElementById('map_tile'), {
      center: center,
      zoom: {{ $settings['map_zoom'] }},
    });
    marker = new google.maps.Marker({
    	position: center,
    	map: map
    });
    map.addListener('zoom_changed', function(e) {
    	$('input[name=map_zoom]').val(map.getZoom());
    });
    map.addListener('click', function(e) {
    	marker.setMap(map);
    	var pos = e.latLng;
    	marker.setPosition(pos);
    	$('input[name=marker]').val(pos.lat() + ',' + pos.lng());
    });
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJsjOZOz4KNd2h_trNMgSpEF8TB5zJzCg&callback=initMap" async defer></script>
@endsection