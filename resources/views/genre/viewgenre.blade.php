@extends('v2.layouts.layout')
@section('content')
    <a href="/genres/create"> <input type="button" class="btn btn-primary" value="Add Genre    "></a>
    <div class="page-wrapper">

        <div class="col-md-4">
               <table class="table table-condensed">
                   <thead>
                   <th>
                       Genre
                   </th>
                   <th colspan="2">
                       Actions
                   </th>
                   </thead>
                   <tbody>
                        @foreach($musicTypes as $genre)
                            <tr>
                                <td>
                                    {{$genre->name}}
                                <td>
                                    {{ Form::open(['route' => ['editgenre', $genre->id], 'method' => 'put']) }}
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-faded-blue" value="Edit">
                                    {{ Form::close() }}

                                </td>
                                <td>
                                    {{ Form::open(['route' => ['deletegenre', $genre->id], 'method' => 'post']) }}
                                    {{ csrf_field() }}
                                    <!-- <input type="submit" class="btn btn-danger" value="Delete"> -->
                                    {{ Form::close() }}

                                </td>
                            </tr>
                        @endforeach
                   </tbody>
               </table>
        </div>
    </div>
    <div class="pagination">
    {!! $musicTypes->render() !!}
    </div>
@endsection
