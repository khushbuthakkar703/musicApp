<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel DataTables Tutorial</title>

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            padding-top: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Dj Name</th>
            <th>Song Name</th>
            <th>artist website</th>
            <th>Played Time</th>

        </tr>
        </thead>
        <tbody>
        @foreach($jsonrecords as $data)
            <tr>
                <td>

                {{ $data['playedByDj'] }}

                <td>
                    {{ $data['music']->song_title }}
                    {{--{{$data.song_name}}--}}


                </td>
                <td>
                    {{ $data['music']->artist_website }}
                    {{--{{ $data['company_name'] }}--}}
                    {{--{{$data.company_name}}--}}
                </td>
                <td>
                    {{ $data['played_time'] }}

                </td>
            </tr>
            @endforeach
            </tbody>
    </table>

</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"> </script>
<!-- App scripts -->
</body>
</html>