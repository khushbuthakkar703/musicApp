@extends('layouts.djmanager')
@section('content')
<title>SpinStatz | Compose Message</title>
<style type="text/css">
tbody {
height:300px;
overflow:auto;
overflow-x:hidden;
}
.dataTables_filter label
{
color:#fff;
}
.dataTables_length select,input
{
background-color: #3a4144;border: 0.2px solid #fff;padding: 3px;
}
.dataTables_wrapper .dataTables_length {
float: left;
}
.dataTables_wrapper .dataTables_filter {
float: right;
text-align: right;
}
</style>
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span
                class="typcn typcn-arrow-forward page-header-heading-icon"></span> Compose Message
                </h1>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="panel">
                <form action="{{ route('djmanager.message.send') }}" method="post">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="message-field">
                            <label>DJ Email</label>
                            <select name="recever_id" class="form-control">
                                <option value="">Select Email</option>
                                <?php
                                foreach ($user as $users)
                                {
                                
                                echo '<option value="'. $users->id .'">'. $users->email .'</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" name="djs" id="bulk_djs">
                        </div>
                        <div class="message-field">
                            <label>Create Message</label>
                            <textarea name="message" id="editor1" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button type="submit" class="btn btn-transparent btn-transparent-primary"><span
                        class="fa fa-share"></span> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="title"><span class="fa fa-lightbulb-o"></span> Need Help?</h4>
                </div>
                <div class="panel-body">
                    <p>When composing a message, you can use all the provided <strong>formatting tools</strong>
                    above the text area to change the styling of your message</p>
                    <p>You can send a message to multiple people, but be aware that, unless you put them in the
                        <strong>bcc section</strong>, their profile will be shown to other users in the
                        application.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br>
    {{-- Filter Results --}}
    <div class="btn-group" style="display: none;">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        Genre <span class="caret"></span>
        </button>
        {{-- <?php
        foreach ($genrs as $value) {
        $genersList[]=$value->genrs;
        }
        ?> --}}
        <ul class="dropdown-menu" data-attr="genrs">
            <li><a href="javascript:void(0);">All</a></li>
            {{-- <?php
            foreach (array_unique($genersList) as $value) {
            ?> --}}
            <li><a href="javascript:void(0);"><?php echo $value; ?></a></li>
            {{--  <?php
            }
            ?> --}}
        </ul>
    </div>
    {{--  <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        Country <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" data-attr="country">
            <li><a href="javascript:void(0);">All</a></li>
            <li><a href="javascript:void(0);">US</a></li>
            <li><a href="javascript:void(0);">China</a></li>
            <li><a href="javascript:void(0);">UK</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        State <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" data-attr="state">
            <li><a href="javascript:void(0);">All</a></li>
            <li><a href="javascript:void(0);">NJ</a></li>
            <li><a href="javascript:void(0);">NY</a></li>
            <li><a href="javascript:void(0);">Texas</a></li>
        </ul>
    </div>
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        City <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" data-attr="city">
            <li><a href="javascript:void(0);">All</a></li>
            <li><a href="javascript:void(0);">Atlanta</a></li>
            <li><a href="javascript:void(0);">Miami</a></li>
            <li><a href="javascript:void(0);">Nashville</a></li>
        </ul>
    </div> --}}
    <div class="panel">
        
        <div class="panel-body" style="overflow-x: auto;">
        <table id="example" class="table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox"></th>
                            <th>DJ Name</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Genres</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     <tbody style="height: 300px;overflow-y:scroll;">
            @foreach($user as $row)
            <?php
            $genersList=array();
            foreach ($genrs as $value) {
            if($row->id==$value->dj_id)
            {
            $genersList[]=$value->genrs;
            }
            }
            
            ?>
            <tr class="table-row" data-country="{{$row->country}}" data-city="{{$row->city}}" data-state="{{$row->state}}" data-genrs="<?php echo implode('|', $genersList); ?>">
            <td><input type="checkbox" name="djs" value="{{$row->id}}" class="icheck1" ></td>
                <td>{{$row->dj_name}}</td>
                <td>{{$row->country}}</td>
                <td>{{$row->state}}</td>
                <td>{{$row->c_name}}</td>
                <td >
                <div style="width:120px;word-wrap: break-word">
                    <?php
                    $genersList=array();
                    foreach ($genrs as $value) {
                    if($row->id==$value->dj_id)
                    {
                    $genersList[]=$value->genrs;
                    }
                    }
                    echo implode('|', $genersList);
                    ?>
                    </div>
                </td>
                <td>
                {{$row->phone_number}}</td>
                <td>@if($row->blocked =='no')
                                <label class="btn btn-success btn-xs verified"><span
                                            class="fa fa-check"></span>Verified
                                </label>
                            @elseif($row->blocked =='yes')
                                <label class="btn btn-transparent btn-transparent-danger btn-xs not-verified"
                                        ><span class="fa fa-eject"></span> Not Verified
                                </label>
                            @endif
                            </td>
            </tr>
            @endforeach

                </table>
        </div>
    </div>
    
    
</div>
@endsection
@section('custom_js')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> --}}

<script type="text/javascript">
// CKEDITOR.editorConfig = function (config) {
//     config.language = 'es';
//     config.uiColor = '#F7B42C';
//     config.height = 300;
//     // config.toolbarCanCollapse = true;
//     config.toolbarStartupExpanded = true;
// };
// CKEDITOR.replace('editor1');




$('.dropdown-menu li').bind('click', function () {
  var val = $(this).find('a').html();
  var attr = $(this).parent('ul').attr('data-attr');
  if (val == "All") {
    $('#dj_list').find('.table-row').css('display', 'block');
  } else {
    $('#dj_list').find('.table-row').css('display', 'none');
    var critriaAttribute = '';
    critriaAttribute += '[data-' + attr + '="' + val + '"]';
    $('#dj_list').find('.table-row' + critriaAttribute).css('display', 'block');
  }
});

function updateDataTableSelectAllCtrl(table) {
  // var $table             = table.table().node();

  var $table = table.rows({
    page: 'current'
  }).nodes();
  var $chkbox_all = $('tbody input[type="checkbox"]', $table);
  var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
  var chkbox_select_all = $('thead input[name="select_all"]', $table);
  // console.log($('thead input[name="select_all"]', $table));
  // If none of the checkboxes are checked

  if ($chkbox_checked.length === 0) {
    chkbox_select_all.checked = false;
    if ('indeterminate' in chkbox_select_all) {
      chkbox_select_all.indeterminate = false;
    }

    // If all of the checkboxes are checked
  } else if ($chkbox_checked.length === $chkbox_all.length) {
    chkbox_select_all.checked = true;
    if ('indeterminate' in chkbox_select_all) {
      chkbox_select_all.indeterminate = false;
    }

    // If some of the checkboxes are checked
  } else {
    chkbox_select_all.checked = true;
    if ('indeterminate' in chkbox_select_all) {
      chkbox_select_all.indeterminate = true;
    }
  }
}

$(document).ready(function () {
  // Array holding selected row IDs
  var rows_selected = [];
  var table = $('#example').DataTable({
    'columnDefs': [{
      'targets': [0, 2, 3, 4, 5],
      'searchable': false,
      'orderable': false,
      'width': '10%',
      'className': 'dt-body-center',
      // 'render': function (data, type, full, meta){

      //     return '<input name="djs" value="1" type="checkbox">';
      // }
    }],
    'order': [1, 'asc'],
    'rowCallback': function (row, data, dataIndex) {
      // Get row ID
      var rowId = data[0];

      // If row ID is in the list of selected row IDs
      if ($.inArray(rowId, rows_selected) !== -1) {
        $(row).find('input[type="checkbox"]').prop('checked', true);
        $(row).addClass('selected');
      }
    }
  });


  $("#example thead th").each(function (i) {
    if (i == 2 || i == 3 || i == 4) {
      if ($(this).text() !== '') {
        var isStatusColumn = (($(this).text() == 'Status') ? true : false);
        if (i == 2) {
          var select = $('<select style="background-color: #3a4144;border: 0.2px solid #fff;padding: 3px;"><option value="" selected="selected">All Country</option></select>')
            .appendTo($(this).empty())
            .on('change', function () {
              var val = $(this).val();

              table.column(i)
                .search(val ? '^' + $(this).val() + '$' : val, true, false)
                .draw();
            });

        }
        if (i == 3) {
          var select = $('<select style="background-color: #3a4144;border: 0.2px solid #fff;padding: 3px;"><option value="" selected="selected">All State</option></select>')
            .appendTo($(this).empty())
            .on('change', function () {
              var val = $(this).val();

              table.column(i)
                .search(val ? '^' + $(this).val() + '$' : val, true, false)
                .draw();
            });

        }
        if (i == 4) {
          var select = $('<select style="width:100px;background-color: #3a4144;border: 0.2px solid #fff;padding: 3px;"><option value="" selected="selected">All City</option></select>')
            .appendTo($(this).empty())
            .on('change', function () {
              var val = $(this).val();

              table.column(i)
                .search(val ? '^' + $(this).val() + '$' : val, true, false)
                .draw();
            });

        }

        // Get the Status values a specific way since the status is a anchor/image
        if (isStatusColumn) {
          var statusItems = [];

          /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
          table.column(i).nodes().to$().each(function (d, j) {
            var thisStatus = $(j).attr("data-filter");
            if ($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
          });

          statusItems.sort();

          $.each(statusItems, function (i, item) {
            select.append('<option value="' + item + '">' + item + '</option>');
          });

        }
        // All other non-Status columns (like the example)
        else {
          table.column(i).data().unique().sort().each(function (d, j) {
            if (d != "") {
              select.append('<option value="' + d + '">' + d + '</option>');
            }
          });
        }

      }
    }
  });

  var favorite = [];
  // Handle click on checkbox
  $('#example tbody').on('click', 'input[type="checkbox"]', function (e) {
    var $row = $(this).closest('tr');

    // Get row data
    var data = table.row($row).data();

    // Get row ID
    var rowId = data[0];

    // Determine whether row ID is in the list of selected row IDs 
    var index = $.inArray(rowId, rows_selected);

    // If checkbox is checked and row ID is not in list of selected row IDs
    if (this.checked && index === -1) {
      rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
    } else if (!this.checked && index !== -1) {
      rows_selected.splice(index, 1);
    }

    if (this.checked) {
      favorite.push($(this).val());
      console.log(favorite);
      $row.addClass('selected');
    } else {
      favorite.pop();
      $row.removeClass('selected');
    }
    $('#bulk_djs').val("");
    $('#bulk_djs').val(JSON.stringify(favorite));
      // Update state of "Select all" control
    updateDataTableSelectAllCtrl(table);

    // Prevent click event from propagating to parent
    e.stopPropagation();
  });

  // Handle click on table cells with checkboxes
  $('#example').on('click', 'tbody td, thead th:first-child', function (e) {
    $(this).parent().find('input[type="checkbox"]').trigger('click');
  });

  // $('input[name="select_all"]').change(function (e) {
  //   var favorite = [];
  //   $.each($("input[name='djs']:checked"), function () {
  //     favorite.push($(this).val());
  //     // e.stopPropagation();
  //   });
  //   $('#bulk_djs').val("");
  //   $('#bulk_djs').val(JSON.stringify(favorite));
  // });

  // $('input[class="icheck1"]').change(function (e) {
  //   var favorite = [];
  //   $.each($("input[name='djs']:checked"), function () {
  //     favorite.push($(this).val());
  //     // e.stopPropagation();
  //   });
  //   $('#bulk_djs').val("");
  //   $('#bulk_djs').val(JSON.stringify(favorite));
  // });

  // Handle click on "Select all" control
  $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {

    if (this.checked) {

      $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');

    } else {

      $('#bulk_djs').val("");
      $('#example tbody input[type="checkbox"]:checked').trigger('click');
    }

    // Prevent click event from propagating to parent
    e.stopPropagation();
  });
  // var favorite = [];
  // $('.icheck1').change(function () {
  //   console.log('sds');
  //   if (this.checked) {
  //     console.log(favorite)
  //     favorite.push($(this).val());
  //     $('#bulk_djs').val(JSON.stringify(favorite))
  //   } else {
  //     favorite.pop();
  //     $('#bulk_djs').val(JSON.stringify(favorite))
  //   }
  // });

  // Handle table draw event
  table.on('draw', function () {
    // Update state of "Select all" control
    updateDataTableSelectAllCtrl(table);
  });

  // Handle form submission event 
  $('#frm-example').on('submit', function (e) {
    var form = this;

    // Iterate over all selected checkboxes
    $.each(rows_selected, function (index, rowId) {
      // Create a hidden element 
      $(form).append(
        $('<input>')
        .attr('type', 'hidden')
        .attr('name', 'id[]')
        .val(rowId)
      );
    });

    // FOR DEMONSTRATION ONLY     

    // Output form data to a console     
    $('#example-console').text($(form).serialize());
    console.log("Form submission", $(form).serialize());

    // Remove added elements
    $('input[name="id\[\]"]', form).remove();

    // Prevent actual form submission
    e.preventDefault();
  });
});


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.2/adapters/jquery.js"></script>
<script type="text/javascript">
  $('textarea#editor1').ckeditor({
height: "300px",
toolbarStartupExpanded: true,
width: "100%"
});
</script>
    @endsection