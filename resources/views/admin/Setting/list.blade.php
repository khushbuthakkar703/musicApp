@extends('layouts.admin')

@section('content')
    <div class="page-wrapper">
    <header class="page-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <h5 class="page-header-heading"><span class="typcn typcn-clipboard page-header-heading-icon">

                        </span> Setting</h5>
                </div>
            </div>
        </div>
    </header>


        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="widget widget-default">
                    {{--<header class="widget-header">
                        Advertisement
                    </header>--}}
                    <div class="widget-body">
                        <form method="POST" action="{{ route('setting.store') }}">

                            @foreach($setting as $list)
                                {{--{{dd($list)}}--}}
                                <label for="username">{{ ucwords(str_replace('_',' ' ,$list->field))}}</label>
                                <input type="text" name="{{$list->field}}" id="{{$list->field}}"
                                       value="{{ $list->value }}"
                                       class="form-control">

                                <p class="help-block"></p>
                            @endforeach

                            <button type="submit" class="btn btn-transparent">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
            </div>

        </div>


    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="widget widget-default">
                <div class="widget-header">
                    Lockdown Feature
                </div>

                <div class="widget-body">
                    <a href="{{route('backupspinrate')}}"> <input type="button" name="test" class="btn btn-danger" value="Backup Spinrate"> </a>
                    <a href="{{route('setspinrate')}}"> <input type="button" name="test" class="btn btn-danger" value="Apply $2"> </a>
                    <a href="{{route('restorespinrate')}}"> <input type="button" name="test" class="btn btn-danger" value="Rollback"> </a>
                </div>


         </div>
        </div>
    </div>

@endsection