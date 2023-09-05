@extends('layouts.djmanager')
@section('content')

<div class="page-wrapper">

    <aside class="left-sidebar">

        <section class="sidebar-user-panel">

            <div id="user-panel-slide-toggleable">

                <div class="user-panel-profile-picture">

                    <img src="../img/user-1-profile.jpg" alt="Tyrone G">

                </div>

                <span class="user-panel-logged-in-text"><span class="fa fa-circle-o text-success user-panel-status-icon"></span> Logged in as <strong> Tyrone G</strong></span>

                <a href="../app-pages/profile/update.html" class="user-panel-action-link"><span class="fa fa-pencil"></span> Manage your account</a>

            </div>

            <!-- <button class="user-panel-toggler" data-slide-toggle="user-panel-slide-toggleable"><span class="fa fa-chevron-up" data-slide-toggle-showing></span><span class="fa fa-chevron-down" data-slide-toggle-hidden></span></button> -->

        </section>

        <ul class="sidebar-nav">

            <li class="sidebar-nav-heading">

                Components

            </li>

            <li class="sidebar-nav-link  active ">

                <a href="/">

                    <span class="typcn typcn-home sidebar-nav-link-logo"></span> Dashboard

                </a>

            </li>
            <li class="sidebar-nav-link">
                <a href="campaign_stats.html">
                    <span class="typcn typcn-key-outline sidebar-nav-link-logo"></span> Detailed Report
                </a>
            </li>

            <li class="sidebar-nav-link sidebar-nav-link-group ">


                <a data-subnav-toggle>
                    <span class="typcn typcn-document sidebar-nav-link-logo"></span> Something Else
                    <span class="fa fa-chevron-right subnav-toggle-icon subnav-toggle-icon-closed"></span>
                    <span class="fa fa-chevron-down subnav-toggle-icon subnav-toggle-icon-opened"></span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-nav-link">
                        <a href="campaign_overview.html">
                            <span class="typcn typcn-key sidebar-nav-link-logo"></span> Another Menu Item
                        </a>
                    </li>

                </ul>

            </li>





        </ul>

    </aside>          <header class="top-header">

        <a href="../index.html" class="top-header-logo">

            <img src="../img/mini logo.png" width="112" height="45" alt=""/></a>

        <nav class="navbar navbar-default">

            <div class="container-fluid">

                <div class="navbar-header">

                    <button type="button" class="navbar-sidebar-toggle" data-toggle-sidebar>

                        <span class="typcn typcn-arrow-left visible-sidebar-sm-open"></span>

                        <span class="typcn typcn-arrow-right visible-sidebar-sm-closed"></span>

                        <span class="typcn typcn-arrow-left visible-sidebar-md-open"></span>

                        <span class="typcn typcn-arrow-right visible-sidebar-md-closed"></span>

                    </button>

                </div>

                <ul class="nav navbar-nav navbar-left">

                    <li>

                        <form class="navbar-left navbar-search-form">

                            <button type="submit" class="navbar-search-btn"><span class="fa fa-search"></span></button>

                            <input type="text" class="navbar-search-box" placeholder="Find something...">

                        </form>

                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right" data-dropdown-in="flipInX" data-dropdown-out="zoomOut">

                    <li class="hidden-sm hidden-xs hidden-md"><a href="#">Welcome to <strong>Varello</strong>Admin.</a></li>

                    <li class="item-feed dropdown">

                        <a href="#" class="item-feed-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-envelope"></span> <span class="badge badge-primary item-feed-badge">15</span></a>

                        <ul class="dropdown-menu dropdown-menu-messages">

                            <li>

                                <a class="dropdown-menu-messages-item" href="#">

                                    <div class="dropdown-menu-messages-item-image">

                                        <img src="../img/james-taylor.jpg" alt="James T">

                                    </div>

                                    <div class="dropdown-menu-messages-item-ago">3hr ago</div>

                                    <div class="dropdown-menu-messages-item-content">

                                        <div class="dropdown-menu-messages-item-content-from"><span class="fa fa-circle-o text-success"></span> James Taylor</div>

                                        <div class="dropdown-menu-messages-item-content-snippet">Hey there man, do you...</div>

                                        <div class="dropdown-menu-messages-item-content-timestamp">12:03 AM on 19/05/2016</div>

                                    </div>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-menu-messages-item" href="#">

                                    <div class="dropdown-menu-messages-item-image">

                                        <img src="../img/user-1-profile.jpg" alt="Tyrone G">

                                    </div>

                                    <div class="dropdown-menu-messages-item-ago">3hr ago</div>

                                    <div class="dropdown-menu-messages-item-content">

                                        <div class="dropdown-menu-messages-item-content-from"><span class="fa fa-circle-o text-warning"></span> Tyrone G</div>

                                        <div class="dropdown-menu-messages-item-content-snippet">Hey there man, do you...</div>

                                        <div class="dropdown-menu-messages-item-content-timestamp">12:03 AM on 19/05/2016</div>

                                    </div>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-menu-messages-item" href="#">

                                    <div class="dropdown-menu-messages-item-image">

                                        <img src="../img/user-3-profile.jpg" alt="James T">

                                    </div>

                                    <div class="dropdown-menu-messages-item-ago">3hr ago</div>

                                    <div class="dropdown-menu-messages-item-content">

                                        <div class="dropdown-menu-messages-item-content-from"><span class="fa fa-circle-o text-danger"></span> Sandra Nelvo</div>

                                        <div class="dropdown-menu-messages-item-content-snippet">Hey there man, do you...</div>

                                        <div class="dropdown-menu-messages-item-content-timestamp">12:03 AM on 19/05/2016</div>

                                    </div>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-menu-link-lg" href="../app-pages/inbox.html">

                                    <span class="fa fa-envelope"></span> Go To Inbox

                                </a>

                            </li>

                        </ul>

                    </li>

                    <li class="item-feed dropdown">

                        <a href="#" class="item-feed-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-bell"></span> <span class="badge badge-danger item-feed-badge">7</span></a>

                        <ul class="dropdown-menu dropdown-menu-notifications">

                            <li>

                                <a class="dropdown-menu-notifications-item" href="#">

                                    <span class="dropdown-menu-notifications-item-content"><span class="fa fa-smile-o"></span> You got 3 likes</span>

                                    <span class="dropdown-menu-notifications-item-ago">3hr ago</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-menu-notifications-item" href="#">

                                    <span class="dropdown-menu-notifications-item-content"><span class="fa fa-line-chart"></span> Sales report available</span>

                                    <span class="dropdown-menu-notifications-item-ago">12hr ago</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-menu-notifications-item" href="#">

                                    <span class="dropdown-menu-notifications-item-content"><span class="fa fa-credit-card-alt"></span> 248 new subscriptions</span>

                                    <span class="dropdown-menu-notifications-item-ago">12hr ago</span>

                                </a>

                            </li>

                            <li>

                                <a class="dropdown-menu-link-md" href="#">

                                    <small>

                                        <span class="fa fa-bell"></span> See Notification History

                                    </small>

                                </a>

                            </li>

                        </ul>

                    </li>

                    <li><a href="/logout"><span class="fa fa-sign-out"></span> <span class="hidden-sm hidden-xs">Log out</span></a></li>

                </ul>

            </div>

        </nav>

    </header>            <div class="content-wrapper">

        <div class="content-dimmer"></div>

        <header class="page-header">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-xs-12 col-md-9">

                        <h1 class="page-header-heading"><span class="typcn typcn-home page-header-heading-icon"></span> User Dashboard <small>Campaign View</small></h1>

                        <p class="page-header-description">This page provides an overview of your music campaign, based on <a href="#">varying time periods</a>.</p>

                    </div>

                    <div class="col-xs-12 col-md-3">

                        <button type="button" class="btn btn-transparent btn-xl btn-faded pull-right visible-lg visible-md"><span class="fa fa-paint-brush"></span> Settings</button>

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

                                <span class="widget-fluctuation-description-amount text-success">+194</span>

                                <span class="widget-fluctuation-description-text">increase since<br>last week</span>

                            </section>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6 col-lg-4">

                    <div class="widget widget-statistic widget-primary">

                        <header class="widget-statistic-header">campaign points</header>

                        <div class="widget-statistic-body">

                            <span class="widget-statistic-value">27,294</span>

                            <button class="btn btn-sm btn-transparent-white" type="button">ADD POINTS</button>

                            <span class="widget-statistic-icon fa fa-credit-card-alt"></span>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6 col-lg-4">

                    <div class="widget widget-statistic widget-purple">

                        <header class="widget-statistic-header">Spin Ra</header>

                        <div class="widget-statistic-body">

                            <span class="widget-statistic-value">20<span style="font-size: 24px">Spin</span></span>

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

                            Spin History</header>

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
                            <div style="font-size: 16px">K.O. McCoy </div>
                            <div><strong>Label</strong></div>
                            <div style="font-size: 16px">O-Boy Entertainment </div>
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

                        <div><img src="../img/somewhereoutthere.jpg" alt="James Taylor, Employee of the Month" class="achievement-image">

                            <p class="achievement-description">Start date<strong> 6-01-2017</strong> Campaign active <strong>21 DAYS</strong></p>

                        </div>

                    </div>

                </div>

                <div class="col-lg-8">

                    <table class="table table-condensed">

                        <thead>

                        <tr>

                            <th width="9" class="hidden-xs hidden-sm">&nbsp;</th>
                            <th align="center" class="hidden-xs hidden-sm">DJ Name</th>

                            <th width="86" class="hidden-xs hidden-sm">City</th>

                            <th width="193">Club</th>

                            <th colspan="3"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td width="100%" align="center"><span style="text-align: center">Spins</span></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td width="37" align="center">LW </td>
                                        <td width="28" align="center">/</td>
                                        <td width="36" align="center">TW</td>
                                    </tr>
                                    </tbody>
                                </table></th>

                            <th width="50" align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td align="center"> <span class="widget-statistic-icon fa fa-arrow-circle-down"></span></td>
                                    </tr>
                                    </tbody>
                                </table></th>
                            <th width="146" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tbody>
                                    <tr>
                                        <td align="center">Manager</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </th>

                        </tr>
                        </thead>

                        <tbody>

                        <tr>

                            <td class="hidden-xs hidden-sm">1</td>
                            <td align="left" class="hidden-xs hidden-sm">Mark</td>

                            <td class="hidden-xs hidden-sm">Smith</td>

                            <td>marksmith@test.com</td>

                            <td width="47" align="center" class="hidden-xs hidden-sm"><a href="#">31</a></td>
                            <td width="30"></td>
                            <td width="47" align="center" class="hidden-xs hidden-sm"><a href="#">41</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center">Independent DJ</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">2</td>
                            <td align="left" class="hidden-xs hidden-sm">Jim</td>

                            <td class="hidden-xs hidden-sm">Johnson</td>

                            <td>jimjohnson@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">0</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">0</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span></td>
                            <td align="center">Independent DJ</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">3</td>
                            <td align="left" class="hidden-xs hidden-sm">Harry</td>

                            <td class="hidden-xs hidden-sm">Williams</td>

                            <td>harrywilliams@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">10</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">7</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center" class="text-right">&nbsp;</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">4</td>
                            <td align="left" class="hidden-xs hidden-sm">Bob</td>

                            <td class="hidden-xs hidden-sm">Jones</td>

                            <td>bobjones@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">5</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">3</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center" class="text-right">&nbsp;</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">5</td>
                            <td align="left" class="hidden-xs hidden-sm">Ryan</td>

                            <td class="hidden-xs hidden-sm">Brown</td>

                            <td><a href=""></a>ryanbrown@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">16</a></td>
                            <td>&nbsp;</td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">51</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center" class="text-right">&nbsp;</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">6</td>
                            <td align="left" class="hidden-xs hidden-sm">Ben</td>

                            <td class="hidden-xs hidden-sm">David</td>

                            <td>bendavis@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">19</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">102</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center">Independent DJ</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">7</td>
                            <td align="left" class="hidden-xs hidden-sm">Fred</td>

                            <td class="hidden-xs hidden-sm">Miller</td>

                            <td>fredmiller@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">0</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">0</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-danger"></span> </td>
                            <td align="center" class="text-right">&nbsp;</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">8</td>
                            <td align="left" class="hidden-xs hidden-sm">Paul</td>

                            <td class="hidden-xs hidden-sm">Wilson</td>

                            <td>paulwilson@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">0</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">11</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center" class="text-right">&nbsp;</td>

                        </tr>

                        <tr>

                            <td class="hidden-xs hidden-sm">9</td>
                            <td align="left" class="hidden-xs hidden-sm">James</td>

                            <td class="hidden-xs hidden-sm">Taylor</td>

                            <td>jamestaylor@test.com</td>

                            <td align="center" class="hidden-xs hidden-sm"><a href="#">4</a></td>
                            <td></td>
                            <td align="center" class="hidden-xs hidden-sm"><a href="#">0</a></td>
                            <td align="center"><span class="fa inbox-sidebar-icon fa-circle text-success"></span></td>
                            <td align="center" class="text-right">&nbsp;</td>

                        </tr>

                        </tbody>

                    </table>

                </div>



            </div>

            <footer class="content-wrapper-footer">

                &copy; Copyright 2016 <a href="http://www.varellothemes.com" target="_blank">s</a>.

            </footer></div>



    </div>

</div>

    @endsection