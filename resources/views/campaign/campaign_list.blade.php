@extends('layouts.campaignapp')

@section('content')
    <div class="container-fluid container">

        @if (session('alert'))
            <div class="row">
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h3>Campaign List</h3>
                    </br>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($campaignLists as $campaignList)
                        <tr>
                            <td>{{$campaignList->id}}</td>
                            <td>{{$campaignList->campaign_name}}</td>
                            <td>{{ date('d/m/Y h:i A',strtotime($campaignList->created_at))}}</td>
                            <td>
                                <a href="/campaign/use/{{$campaignList->id}}"> <i class="fa fa-eye"></i></a>
                                <a href="/campaign/edit/{{$campaignList->id}}"> <i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

@endsection
