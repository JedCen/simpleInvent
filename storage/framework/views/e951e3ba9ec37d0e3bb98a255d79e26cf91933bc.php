<!-- Compiled app javascript -->
<script src="<?php echo e(asset('/js/app.js')); ?>"></script>
<?php echo HTML::script('//maps.googleapis.com/maps/api/js?key='.env("GOOGLEMAPS_API_KEY").'&libraries=places&dummy=.js', array('type' => 'text/javascript')); ?>

