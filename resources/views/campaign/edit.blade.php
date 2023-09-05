@extends('layouts.campaignapp')
@section('content')
<title>SpinStatz | Set Spin</title>
<div class="container-fluid container">
  <div class="row">
    <div class="col-md-6 col-xs-12">
      <div class="widget widget-default">
        <header class="widget-header">Set your Spin Rate. This is the amount that will be paid to DJs each time they play your song.</header>
        <div class="widget-body">
          <form method="POST" action="/user/campaign/update" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label for="spinrate">Choose Rate</label>
              <select name="spinrate" id="spinrate" class="form-control" @if($campaign->spin_rate)  disabled @endif>
                  <option value="10">10</option>
                  <option value="15">15</option>
                  <option value="20">20</option>
                  <option value="25">25</option>
                  <option value="30">30</option>
                  <!-- <option value="30">60</option> -->

              </select>
            {{--<input type="number" name="spinrate" id="spinrate" class="form-control" placeholder="Spin Rate" required value="{{$campaign->spin_rate}}" @if($campaign->spin_rate)  disabled @endif>--}}
            @if ($errors->has('spinrate'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('spinrate') }}</strong>
                </span>
            @endif

            <span class="help-block has-warning">
                    <strong>You can set spin rate only once</strong>
            </span>
                <input type="Submit" class ="next-btn btn btn-lg btn-primary" value="Set" @if($campaign->spin_rate)  disabled @endif>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
<script>
    $(document).ready(function(){
        $.get( "/datas/countries.json", function( data ) {
            $.each(data,function(index,stateObject){
                $('.countryOption').append('<option  value="'+stateObject.code+'">'+
                    stateObject.name + '</option>');
            });
        });
    });
</script>
@endsection
<style>
.media-widget {
    display: none;
}

</style>
