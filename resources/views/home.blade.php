@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/bulkinvite"><input type="button" value="BulkInvite" class="btn-primary"></a>
                    <a href="/invite"><input type="button" value="Invite" class="btn-primary"></a>
                    <a href="/dj/register"><input type="button" value="DJ Register" class="btn-primary"></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
