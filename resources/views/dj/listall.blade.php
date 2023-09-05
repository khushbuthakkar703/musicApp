@extends('layouts.app')

@section('content')
<title>SpinStatz | DJ List</title>
<img src="http://spinstatz.com/wp-content/uploads/2018/02/nerve.png" alt=""/> 
<img src="http://spinstatz.com/wp-content/uploads/2018/08/fleetdjs.png" alt=""/>
<img src="http://spinstatz.com/wp-content/uploads/2018/08/skratcher.png" alt=""/>
<img src="http://spinstatz.com/wp-content/uploads/2018/08/BentonEnt_Logo_Final1.png" alt=""/>
<img src="http://spinstatz.com/wp-content/uploads/2018/08/ricosanchez-1.png" alt=""/>
<img src="http://spinstatz.com/wp-content/uploads/2018/08/hoodcertified.png" alt=""/>
<img src="http://spinstatz.com/wp-content/uploads/2018/08/bryantd.png" alt=""/>
<style>
    .list-group-1 {
        display: none;
    }

</style>
    <div class="widget widget-default">

        <div class="widget-body table-responsive">
            <table border="1" align="center" class="table table-striped">
                <thead>

                <tr>
                    <th width="25%" height="41" colspan="2">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">DJ Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="25%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">State</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="25%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">City</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="25%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Club Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="25%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Club Capacity</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>

                <tbody>
                @foreach($djs as $dj)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$dj->dj_name}}</td>
                    <td>{{$dj->state}}</td>
                    <td>{{$dj->city}}</td>
                    <td>
                        @php($club = \App\Club::where('dj_id',$dj->id)->first())
                        {{$club->name or '--'}}
                    </td>
                    <td>
                        {{$club->capacity or '--'}}
                    </td>

                </tr>
                    
                @endforeach
                <tr>
               
            </table>
            {{ $djs->links() }}
        </div>
    </div>



<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });

    document.getElementsByClassName("history")[0].classList.add('active');
    tabcontent = document.getElementsByClassName("list-group");
    document.getElementById("details1").style.display = "block";

    function openDetails(id){
        
        for (var i = tabcontent.length-1; i >= 0; i--) {
            tabcontent[i].style.display = "none";
        }
        document.getElementById("details"+ id).style.display = "block";
        //console.log("details opened", id)

    }

</script>
 -->
@endsection


