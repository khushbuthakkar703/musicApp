@extends('layouts.app')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" integrity="sha256-xqxV4FDj5tslOz6MV13pdnXgf63lJwViadn//ciKmIs=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
	<select class="js-example-basic-multiple form-control input-lg" name="states[]" multiple="multiple">
	  <option value="AL">Alabama</option>
	  <option value="WY">Wyoming</option>
	</select>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.js-example-basic-multiple').select2({
		    	'allowClear': true,
		    	 width: "resolve" 
		    });
		});
	</script>
@endsection