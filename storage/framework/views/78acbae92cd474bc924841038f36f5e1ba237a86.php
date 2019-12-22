

<?php $__env->startSection('template_linked_css'); ?>
  <!-- Css Extras -->
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datepicker/datepicker3.css')); ?>">
<?php $__env->stopSection(); ?>

  <!-- DataTables -->
  <script src="<?php echo e(asset('plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
  <script>
    $(document).ready(function(){
      $( "#datepicker" ).datepicker({
      format: "mm/dd/yy",
      weekStart: 0,
      calendarWeeks: true,
      autoclose: true,
      todayHighlight: true,
      rtl: true,
      orientation: "auto"
      });
    });
  </script>
