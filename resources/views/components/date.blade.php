@push('footer')
<link rel="stylesheet" href="{{ url('vendors/datepicker/daterangepicker.css') }}" type="text/css">
<script src="{{ url('vendors/datepicker/daterangepicker.js') }}"></script>
<script>
$('.date').daterangepicker({
  singleDatePicker: true,
  locale: {
        format: 'YYYY-MM-DD'
    },
});
</script>
@endpush