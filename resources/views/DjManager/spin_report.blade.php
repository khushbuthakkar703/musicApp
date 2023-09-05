@extends('layouts.djmanager')
@section('content')
    <header class="page-header">
        <div class="row">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td align="center">
                        <table width="95%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <button class="btn btn-transparent btn-xs"><span
                                            class="fa fa-pencil"></span> <span
                                            class="hidden-xs hidden-sm hidden-md">Edit</span></button>&nbsp;
                                <div class="btn btn-transparent btn-transparent-danger btn-xs"><span
                                            class="fa fa-eject"></span> <span
                                            class="hidden-xs hidden-sm hidden-md">Ban</span>
                                    <td width="36%">
                                        <div class="panel panel-default">

                                            <div class="panel-body">
                                                <div class="profile-details">
                                                    <div class="profile-details-profile-picture">
                                                        <img src="../img/dj-xxl.png" alt="Tyrone Gary">
                                                    </div>
                                                    <div class="profile-details-info">
                                                        <h2 class="profile-details-info-name">DJ Mark</h2>
                                                        <p class="profile-details-info-summary">Custom
                                                            description entered by DJ.</p>
                                                        <ul class="profile-details-info-contact-list">
                                                            <li class="profile-details-info-contact-list-item">
                                                                <a href="mailto:tyrone.gary@example.com"><span
                                                                            class="fa fa-envelope profile-details-info-contact-list-item-icon"></span>marksmith@example.com</a>
                                                            </li>
                                                            <li class="profile-details-info-contact-list-item">
                                                                <span class="fa fa-phone profile-details-info-contact-list-item-icon"></span>
                                                                +0 1234 56879
                                                            </li>
                                                            <li class="profile-details-info-contact-list-item">
                                                                <a href="#"> <span
                                                                            class="fa fa-twitter profile-details-info-contact-list-item-icon"></span>@djmark</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="64%" valign="middle">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tbody>
                                            <tr>
                                                <td width="53%" height="117">
                                                    <div class="widget widget-statistic-mini widget-success">
                                                        <div class="widget-statistic-body">
                                                            <span class="widget-statistic-value">Total Spins / 175</span>
                                                            <span class="widget-statistic-icon fa fa-diamond"></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width="47%" rowspan="2">
                                                    <div class="panel-heading">
                                                        <strong>Club Information</strong></div>

                                                    <ul class="list-group">
                                                        <li class="list-group-item">
                                                            <strong>Address:</strong> 214 Club Rd
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Country: </strong>United States
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Location:</strong> Nashville, TN
                                                        </li>
                                                        <li class="list-group-item"><strong><strong>Capacity:</strong>
                                                            </strong>800
                                                        </li>
                                                        <li class="list-group-item">
                                                            <strong>Contact:</strong> Ted Melvin
                                                        </li>
                                                        <li class="list-group-item"><strong>Phone:</strong>
                                                            804-642-5431
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <span class="fa fa-info-circle"></span>&nbsp;&nbsp;DJ
                                                            Information
                                                        </div>
                                                        <table class="table">
                                                            <tbody>
                                                            <tr>
                                                                <th align="left">Name</th>
                                                                <td>Mark Smith</td>
                                                            </tr>
                                                            <tr>
                                                                <th align="left">Genre</th>
                                                                <td>Rock</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Software</th>
                                                                <td>Serato</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Coalition Name</th>
                                                                <td>Plug DJs</td>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="2"><a
                                                                            href="messages/compose.html"
                                                                            class="btn btn-block btn-success"><span
                                                                                class="fa fa-paper-plane"></span>
                                                                        Message DJ</a></th>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table width="100%" border="0" cellspacing="0"
                                                           cellpadding="0">

                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </header>
    <div class="widget widget-default">

        <div class="widget-body table-responsive">
            <table border="1" align="center" class="table table-striped">
                <thead>

                <tr>
                    <th width="5%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">

                        </table>
                    </th>
                    <th width="18%" height="41">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Dj Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="21%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Song Name</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="16%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Artist's website</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                    <th width="12%">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td align="center">Played Time</td>
                            </tr>
                            </tbody>
                        </table>
                    </th>
                </tr>

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
    </div>


@endsection
