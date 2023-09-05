@extends('layouts.djmanager')

@section('content')
<header class="page-header">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-xs-12 col-md-9">

                            <h1 class="page-header-heading"><span class="typcn typcn-chart-line page-header-heading-icon"></span> Campaign Statistics<small></small></h1>

                            <p class="page-header-description">For Campaign <a href="campaign_overview.html">K.O. McCoy</a>.</p>

                        </div>

                        <div class="col-xs-12 col-md-3">



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

                                    <span class="widget-fluctuation-period-text"><strong><a href="#">&lt;</a> Week / June 18-24 <a href="#">&gt;</a></strong></span><br>

                                    <button class="btn btn-sm btn-transparent-white" type="button"><span class="fa fa-calendar"></span> View Different Month</button>

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

                                <button class="btn btn-sm btn-transparent-white" type="button">ADD FUNDS</button>

                                <span class="widget-statistic-icon fa fa-credit-card-alt"></span>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6 col-lg-4">

                        <div class="widget widget-statistic widget-purple">

                            <header class="widget-statistic-header">Spin Rate</header>

                            <div class="widget-statistic-body">

                                <span class="widget-statistic-value">$20/<span style="font-size: 24px">Spin</span></span>

                                <span class="widget-statistic-description">Amount DJs will earn each succussfully reported spin. <strong>CAN NOT BE CHANGED</strong></span>

                                <span class="widget-statistic-icon fa fa-support"></span>

                            </div>

                        </div>

                    </div>

                </div>







            </div><div class="widget widget-default">
                <header class="widget-header">
                    Detailed Report</header>
                <div class="widget-body table-responsive">
                    <table border="1" align="center" class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>DJ Name</th>
                            <th>City</th>
                            <th>Club</th>
                            <th>Genre</th>
                            <th align="center">S</th>
                            <th align="center">M</th>
                            <th align="center">T</th>
                            <th align="center">W</th>
                            <th align="center">T</th>
                            <th align="center">F</th>
                            <th align="center">S</th>
                            <th class="text-right">Week Total</th>
                            <th class="text-right">Spins To Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>DJ Doe</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Rock</td>
                            <td align="center" class="text-right">1</td>
                            <td align="center" class="text-right">1</td>
                            <td align="center" class="text-right">0</td>
                            <td align="center" class="text-right">0</td>
                            <td align="center" class="text-right">2</td>
                            <td align="center" class="text-right">2</td>
                            <td align="center" class="text-right">2</td>
                            <td class="text-right">8</td>
                            <td class="text-right">20</td>
                        </tr>
                        <tr>
                            <th bgcolor="#6B6B6B" scope="row">2</th>
                            <td bgcolor="#6B6B6B">DJ Mann</td>
                            <td bgcolor="#6B6B6B">&nbsp;</td>
                            <td bgcolor="#6B6B6B">&nbsp;</td>
                            <td bgcolor="#6B6B6B">&nbsp;</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">1</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">1</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">1</td>
                            <td bgcolor="#6B6B6B" class="text-right">3</td>
                            <td bgcolor="#6B6B6B" class="text-right">14</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>DJ Jim</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td align="center" class="text-right">2</td>
                            <td align="center" class="text-right">0</td>
                            <td align="center" class="text-right">0</td>
                            <td align="center" class="text-right">0</td>
                            <td align="center" class="text-right">1</td>
                            <td align="center" class="text-right">2</td>
                            <td align="center" class="text-right">1</td>
                            <td class="text-right">6</td>
                            <td class="text-right">60</td>
                        </tr>
                        <tr>
                            <th bgcolor="#6B6B6B" scope="row">4</th>
                            <td bgcolor="#6B6B6B">DJ Vera</td>
                            <td bgcolor="#6B6B6B">&nbsp;</td>
                            <td bgcolor="#6B6B6B">&nbsp;</td>
                            <td bgcolor="#6B6B6B">&nbsp;</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">1</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">0</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">2</td>
                            <td align="center" bgcolor="#6B6B6B" class="text-right">2</td>
                            <td bgcolor="#6B6B6B" class="text-right">5</td>
                            <td bgcolor="#6B6B6B" class="text-right">12</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
 </div>

@endsection