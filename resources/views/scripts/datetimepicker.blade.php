
{{-- FYI: Datatables do not support colspan or rowpan --}}
@section('template_linked_css')
  <!-- Css Extras -->
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
@endsection

  <!-- DataTables -->
  <script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
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
