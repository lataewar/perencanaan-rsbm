@if (Session::has('success'))
  <input type="hidden" id="ss_type" value="success">
  <input type="hidden" id="ss_msg" value="{{ Session::get('success') }}">
@elseif (Session::has('error'))
  <input type="hidden" id="ss_type" value="error">
  <input type="hidden" id="ss_msg" value="{{ Session::get('error') }}">
@else
  <input type="hidden" id="ss_type" value="">
  <input type="hidden" id="ss_msg" value="">
@endif
