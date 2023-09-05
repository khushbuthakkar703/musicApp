@extends('v2.layouts.layout')
@section('content')

<style type="text/css">
              .table-hover thead tr:hover th, .table-hover tbody tr:hover td {
                  background-color: #D1D119;
              }

                .dataTables_filter label {
                    color: #fff;
                    float: right;
                }

                .dataTables_length select, input {
                    background-color: #3a4144;
                    /*border: 0.2px solid #fff;*/
                    padding: 3px;
                }

                .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                    padding: 3px !important;
                }
                .widget_search {
                    margin-top: 35px;
                    position: relative;
                    margin-right: 12px;
                }
                #search_loader {
                    position: absolute;
                    right: 5px;
                    top: 6px;
                    font-size: 17px;
                 }
                .paginate_enabled_next {
                  float: right;
                }
            </style>
<div class="container-fluid">
  @if($spin != null)
    <div class="row">
        <div class="widget widget-default widget-fluctuation">
          @php
              $message = json_decode($spin->message, true)

          @endphp
            <header class="widget-header">
                Music Played by  {{$message['payload']['dj_name']}} on  <span style="color: red; font-weight: bold;" id="played_timestamp">{{$message['payload']['played_timestamp']}}</span>

                <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Filter Video
                </button>

            </header>
            <div class="widget-body">
                <div class="col-lg-6">
                    <video width="90%" height="60%" controls autoplay="true">
                        <source src="http://spinstatz.org/records/{{$message['payload']['video_link']}}" type="video/webm">
                Your browser does not support the video tag.
                    </video>

                </div>
                <div class="col-lg-6">
                  <table id="example" class="table table-hover">

                  <thead>
                    <tr>
                      <th>S.N.</th>
                      <th>Song Name</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>0</td>
                        <td>No Music Found</td>
                        <td>
                          <a href="/update/spins?messageId={{$spin->id}}&songId=0">
                                <button class="button btn-danger">Select
                                </button>
                          </a>
                        </td>
                      </tr>
                    @foreach($musics as $music)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$music->song_title}}</td>
                            <td>
                              <a href="/update/spins?messageId={{$spin->id}}&songId={{$music->id}}">
                                <button class="button btn-success">Select
                                </button>
                              </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    @else
      <div class="row"  style="height: 500px">
        NO VIDEOS REMAINING
      </div>
    @endif
          <!-- Modal -->
@if(auth()->user()->role == "keyer")
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="GET">
          <div class="form-group">
            <label>DJ Name</label>
              <select name="djId" class="js-example-basic-single" class="mdb-select md-form" style="color: black">
                  @foreach($djs as $dj)
                      <option value="{{$dj->user_id}}">{{$dj->dj_name}}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group">
            <label>Date after</label>
            <input type="date" name="dateAfter">
          </div>
          <div class="form-group">
            <label>Date before</label>
            <input type="date" name="dateBefore">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Submit">
      </div>
      </form>
    </div>
      @endif
  </div>
</div>


  <script>
      $(document).ready(function() {
          $('.js-example-basic-multiple').select2({
              matcher: matchStart,
              theme: "classic"
          });
      });

  $(function(){
    var table = $("#example").dataTable();
    $('input')[2].focus();

    var time = $("#played_timestamp").text()
    d = new Date(parseInt(time)*1000);
    $("#played_timestamp").html(d)

  });

      function matchStart(params, data) {
          // If there are no search terms, return all of the data
          if ($.trim(params.term) === '') {
              return data;
          }

          // Skip if there is no 'children' property
          if (typeof data.children === 'undefined') {
              return null;
          }

          // `data.children` contains the actual options that we are matching against
          var filteredChildren = [];
          $.each(data.children, function (idx, child) {
              if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                  filteredChildren.push(child);
              }
          });

          // If we matched any of the timezone group's children, then set the matched children on the group
          // and return the group object
          if (filteredChildren.length) {
              var modifiedData = $.extend({}, data, true);
              modifiedData.children = filteredChildren;

              // You can return modified objects from here
              // This includes matching the `children` how you want in nested data sets
              return modifiedData;
          }

          // Return `null` if the term should not be displayed
          return null;
      }

  </script>
@endsection
