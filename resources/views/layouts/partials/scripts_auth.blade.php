<!-- Compiled app javascript -->
<script src="{{ asset('/js/app.js') }}"></script>
{!! HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')) !!}
