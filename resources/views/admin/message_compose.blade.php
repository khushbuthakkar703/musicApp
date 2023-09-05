@extends('layouts.admin')
@section('content')
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
                <form action="{{ route('admin.message.send') }}" method="post">
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
                            <textarea name="message" class="form-control"></textarea>
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
    <table id="dj_list" class="table">
        <thead>
            <tr>
                <th><input type="checkbox" id="check_all" ></th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody style="height: 300px;overflow-y:scroll;">
            @foreach($user as $row)
            <tr class="table-row">
                <td>
                    <input type="checkbox" name="djs" value="{{$row->id}}" class="icheck" >
                </td>
                <td>{{$row->username}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->role}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>
@endsection
@section('custom_js')
<script type="text/javascript">
$('#check_all').change(function(){
    $('.icheck').not(this).prop('checked', this.checked);
                var favorite = [];
            $.each($("input[name='djs']:checked"), function(){
                favorite.push($(this).val());
            });
            $('#bulk_djs').val(JSON.stringify(favorite))
            // alert("My favourite sports are: " + favorite.join(", "));
});
$('.icheck').change(function(){
    // $('.icheck').not(this).prop('checked', this.checked);
                var favorite = [];
            $.each($("input[name='djs']:checked"), function(){
                favorite.push($(this).val());
            });
            $('#bulk_djs').val(JSON.stringify(favorite))
            // alert("My favourite sports are: " + favorite.join(", "));
});
$('.dropdown-menu li').bind('click', function () {
var val =$(this).find('a').html();
var attr=$(this).parent('ul').attr('data-attr');
if(val=="All")
{
$('#dj_list').find('.table-row').css('display','block');
}
else
{
$('#dj_list').find('.table-row').css('display','none');
var critriaAttribute = '';
critriaAttribute += '[data-' + attr + '="' + val + '"]';
$('#dj_list').find('.table-row' + critriaAttribute).css('display','block');
}

});

 $(document).ready( function () {
  
  var table = $('#dj_list').DataTable({
        "oLanguage": {
            "sInfo": "Showing _START_ to _END_ of _TOTAL_ items."
        },
        "pagingType": "full_numbers",
            "searching": true,
            "aoColumnDefs" : [
             {
               'bSortable' : false,
               'aTargets' : [3]
             }]

         
    });

    $("#dj_list thead th").each( function ( i ) {
        if(i==3)
        {
         if ($(this).text() !== '') {
            var isStatusColumn = (($(this).text() == 'Status') ? true : false);
            if(i==3)
            {
                    var select = $('<select style="background-color: #3a4144;border: 0.2px solid #fff;padding: 3px;"><option value="" selected="selected">All Role</option></select>')
                .appendTo( $(this).empty() )
                .on( 'change', function () {
                    var val = $(this).val();
                    
                    table.column( i )
                        .search( val ? '^'+$(this).val()+'$' : val, true, false )
                        .draw();
                } );
            
            }
            // Get the Status values a specific way since the status is a anchor/image
            if (isStatusColumn) {
                var statusItems = [];
                
                /* ### IS THERE A BETTER/SIMPLER WAY TO GET A UNIQUE ARRAY OF <TD> data-filter ATTRIBUTES? ### */
                table.column( i ).nodes().to$().each( function(d, j){
                    var thisStatus = $(j).attr("data-filter");
                    if($.inArray(thisStatus, statusItems) === -1) statusItems.push(thisStatus);
                } );
                
                statusItems.sort();
                                
                $.each( statusItems, function(i, item){
                    select.append( '<option value="'+item+'">'+item+'</option>' );
                });
                  

            }
            // All other non-Status columns (like the example)
            else {
                table.column( i ).data().unique().sort().each( function ( d, j ) {
                        if(d!="")
                        {  
                            select.append( '<option value="'+d+'">'+d+'</option>' );
                        }
                } );    
            }
            
        }
    }
    } );
  
  
  
  
} );

</script>
@endsection