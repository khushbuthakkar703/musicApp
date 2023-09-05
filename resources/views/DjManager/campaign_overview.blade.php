@extends('layouts.djmanager')
@section('content')
    <header class="page-header">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-xs-12 col-md-9">

                            <h1 class="page-header-heading"><span
                                        class="typcn typcn-home page-header-heading-icon"></span> Campaign Details
                                <small></small>
                            </h1>

                            <p class="page-header-description">This page provides an overview of your music campaign,
                                based on</p>

                        </div>

                    </div>

                </div>

            </header>

            <div class="container-fluid">

                <div class="row">

                    <div class="col-lg-4">

                        <div class="widget widget-default widget-fluctuation">

                            <header class="widget-header">

                                TOTAL SPINS
                            </header>

                            <div class="widget-body">

                                <section class="widget-fluctuation-period">

                                    <span class="widget-fluctuation-period-text"><strong><a href="#">&lt;</a> Week / June 18-24 <a
                                                    href="#">&gt;</a></strong></span><br>

                                    <button class="btn btn-sm btn-transparent-white" type="button"><span
                                                class="fa fa-calendar"></span> View Different Month
                                    </button>

                                </section>

                                <section class="widget-fluctuation-description">

                                    <span class="widget-fluctuation-description-amount text-success">$194</span>

                                    <span class="widget-fluctuation-description-text">increase since<br>last week</span>

                                </section>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6 col-lg-4">

                        <div class="widget widget-statistic widget-primary">

                            <header class="widget-statistic-header">campaign Balance</header>

                            <div class="widget-statistic-body">

                                <span class="widget-statistic-value">$27,294</span>

                                <button class="btn btn-sm btn-transparent-white" type="button">ADD POINTS</button>

                                <span class="widget-statistic-icon fa fa-credit-card-alt"></span>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6 col-lg-4">

                        <div class="widget widget-statistic widget-purple">

                            <header class="widget-statistic-header">Spin Rate</header>

                            <div class="widget-statistic-body">

                                <span class="widget-statistic-value">$20/<span
                                            style="font-size: 24px">Spin</span></span>

                                <span class="widget-statistic-description">Amount DJs will earn each succussfully reported spin. <strong>CAN NOT BE CHANGED</strong></span>

                                <span class="widget-statistic-icon fa fa-support"></span>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-8">

                        <div class="widget widget-default">

                            <header class="widget-header">

                                Spin History
                            </header>

                            <div class="widget-body widget-body-md">

                                <canvas id="graph-monthly-registrations" class="widget-graph-md"></canvas>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="widget widget-default">

                            <header class="widget-header">

                                Campaign Details

                                <div class="widget-header-actions">

                            </header>

                            <div class="widget-body widget-body-md">

                                <div><strong>Song Title</strong></div>
                                <div style="font-size: 16px">Somewhere Out There</div>
                                <div><strong>Artist Name </strong></div>
                                <div style="font-size: 16px">K.O. McCoy</div>
                                <div><strong>Label</strong></div>
                                <div style="font-size: 16px">O-Boy Entertainment</div>
                                <div><strong>Genre</strong></div>
                                <div style="font-size: 16px">R & B</div>
                                <div class="row margin-top-15"></div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="row">

                    <div class="col-lg-4">

                        <div class="widget widget-primary widget-achievement">

                            <div><img src="../img/somewhereoutthere.jpg" alt="James Taylor, Employee of the Month"
                                      class="achievement-image">

                                <p class="achievement-description">Start date<strong> 6-01-2017</strong> Campaign active
                                    <strong>21 DAYS</strong></p>

                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8">

                        <table class="table table-condensed">

                            <thead>

                            <tr>

                                <th width="24" rowspan="2" class="hidden-xs hidden-sm">&nbsp;</th>
                                <th width="95" rowspan="2" align="center" class="hidden-xs hidden-sm">DJ Name</th>

                                <th width="98" rowspan="2" class="hidden-xs hidden-sm">City</th>

                                <th width="145" rowspan="2">Club</th>

                                <th colspan="7">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">SPINS</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th width="67" rowspan="2" align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center"><span
                                                        class="widget-statistic-icon fa fa-arrow-circle-down"></span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                            </tr>
                            <tr>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">S</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">M</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">T</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">W</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">T</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">F</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                                <th align="center">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center">S</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr>

                                <td class="hidden-xs hidden-sm">1</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Mark</a></td>

                                <td class="hidden-xs hidden-sm">Nashville</td>

                                <td>Illusion</td>

                                <td width="34" align="center" class="hidden-xs hidden-sm"><a
                                            href="/djmanagers/daily.html">2</a></td>
                                <td width="28" align="center" class="hidden-xs hidden-sm"><a
                                            href="/djmanagers/daily.html">1</a></td>
                                <td width="32" align="center" class="hidden-xs hidden-sm"><a
                                            href="/djmanagers/daily.html">0</a></td>
                                <td width="39" align="center" class="hidden-xs hidden-sm"><a
                                            href="/djmanagers/daily.html">0</a></td>
                                <td width="38" align="center" class="hidden-xs hidden-sm"><a
                                            href="/djmanagers/daily.html">2</a></td>
                                <td width="46" align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td width="39" align="center" class="hidden-xs hidden-sm"><a
                                            href="/djmanagers/daily.html">2</a></td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">2</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ Jim</a>
                                </td>

                                <td class="hidden-xs hidden-sm">Atlanta</td>

                                <td>The Spot</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">3</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Harry</a></td>

                                <td class="hidden-xs hidden-sm">Memphis</td>

                                <td>Hitville</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">4</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ Ben</a>
                                </td>

                                <td class="hidden-xs hidden-sm">New York</td>

                                <td>Coyote Ugly</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">5</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Grapevine</td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>

                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">6</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>WKND</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">7</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        James</a></td>

                                <td class="hidden-xs hidden-sm">Birmingham</td>

                                <td>Limelight</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">8</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>Silverlight</td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>

                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">9</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>WKND</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">10</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Bob</a></td>

                                <td class="hidden-xs hidden-sm">Charlotte</td>

                                <td>The Club</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">11</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Ryan</a></td>

                                <td class="hidden-xs hidden-sm">Poenix</td>

                                <td><a href=""></a>Diamond Blacks</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">12</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ Ben</a>
                                </td>

                                <td class="hidden-xs hidden-sm">New York</td>

                                <td>Rage</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">13</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Grapevine</td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>

                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">14</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>Urban</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">15</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ Ben</a>
                                </td>

                                <td class="hidden-xs hidden-sm">New York</td>

                                <td>Crush</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">16</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Beehive</td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>

                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">17</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>Noize</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">18</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        James</a></td>

                                <td class="hidden-xs hidden-sm">Birmingham</td>

                                <td>Limelight</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">19</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Buzz</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">20</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>Hurricanes</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">21</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Name</a></td>

                                <td class="hidden-xs hidden-sm">Birmingham</td>

                                <td>Limelight</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">22</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Grapevine</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">23</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>WKND</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">24</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ Ben</a>
                                </td>

                                <td class="hidden-xs hidden-sm">New York</td>

                                <td>Coyote Ugly</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">25</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Grapevine</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">2</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">26</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djjim.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>WKND</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">27</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        James</a></td>

                                <td class="hidden-xs hidden-sm">Birmingham</td>

                                <td>Limelight</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">28</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Grapevine</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">29</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>WKND</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">30</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        James</a></td>

                                <td class="hidden-xs hidden-sm">Birmingham</td>

                                <td>Limelight</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>
                            <tr>

                                <td class="hidden-xs hidden-sm">31</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Fred</a></td>

                                <td class="hidden-xs hidden-sm">Little Rock</td>

                                <td>The Grapevine</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">0</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">32</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        Paul</a></td>

                                <td class="hidden-xs hidden-sm">Knoxville</td>

                                <td>WKND</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">2</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            <tr>

                                <td class="hidden-xs hidden-sm">33</td>
                                <td align="left" class="hidden-xs hidden-sm"><a href="/djmanagers/djspinreport.html">DJ
                                        James</a></td>

                                <td class="hidden-xs hidden-sm">Birmingham</td>

                                <td>Limelight</td>

                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">0</a>
                                </td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><a href="/djmanagers/daily.html">1</a></td>
                                <td align="center" class="hidden-xs hidden-sm"><a href="/djmanagers/daily.html">1</a>
                                </td>
                                <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span>
                                </td>
                            </tr>

                            </tbody>

                        </table>

                    </div>


                </div>
        </div>


@endsection

