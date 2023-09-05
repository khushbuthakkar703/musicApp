@extends('layouts.admin')
@section('content')
<div class="container-fluid">
	@if ($errors->any())
	     {{ implode('', $errors->all('<div>:message</div>')) }}
	@endif

	@if (\Session::has('success'))
	    <div class="alert alert-success">
	        <ul>
	            <li>{!! \Session::get('success') !!}</li>
	        </ul>
	    </div>
	@endif
	<div class="row">
		<div class="widget widget-default widget-fluctuation">
			<header class="widget-header">
            	Add Missing Spin
            </header>
			<div class="widget-body">
				<form method="post" action={{route('spin.missing')}}>
					<label>Message</label>
					<textarea name="message" class="form-control" rows="5" id="comment">
						
					</textarea>

					<input type="submit" value="Submit" class="btn">
				</form>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	
</style>
@endsection
