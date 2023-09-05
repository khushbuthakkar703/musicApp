@extends('layouts.campaignapp')

@section('content')
    <div class="container-fluid container">

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h3>Edit Campaign</h3>
                    </br>
                </div>

            </div>

        </div>

        <div class="row">
            @if (session('alert'))
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            @endif
            <form class="form-horizontal" method="POST" action="{{ route('campaign.edit',$campaigns->id) }}">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">


                <div class="form-group{{ $errors->has('campaign_name') ? ' has-error' : '' }}">
                    <label for="amount" class="col-md-4 control-label">Campaign Name</label>

                    <div class="col-md-6">
                        <input type="text" name="campaign_name" value="{{$campaigns->campaign_name}}"
                               class="form-control"/>

                        @if ($errors->has('campaign_name'))
                            <span class="help-block">
                                            <strong>{{ $errors->first('campaign_name') }}</strong>
                                        </span>
                        @endif

                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
