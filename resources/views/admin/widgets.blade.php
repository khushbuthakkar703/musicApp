@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-shopping-bag page-header-heading-icon"></span> Widgets</h1>
                <p class="page-header-description">There are many different widget components available in Varello. You can use these to arrange and display your information in a variety of useful formats.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="margin-top-0">Value Fluctuation Widgets <small>Good for a simple comparison tool</small></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget widget-default widget-fluctuation">
                <header class="widget-header">
                    Monthly Revenue
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    <section class="widget-fluctuation-period">
                        <span class="widget-fluctuation-period-text"><strong>$249,452</strong> in <strong>2016</strong></span><br>
                        <button class="btn btn-sm btn-transparent btn-transparent-faded-blue" type="button"><span class="fa fa-calendar"></span> View Different Year</button>
                    </section>
                    <section class="widget-fluctuation-description">
                        <span class="widget-fluctuation-description-amount text-success">+$45,463</span>
                        <span class="widget-fluctuation-description-text">increase on this<br>period last year</span>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget widget-primary widget-fluctuation">
                <header class="widget-header">
                    Monthly Revenue
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    <section class="widget-fluctuation-period">
                        <span class="widget-fluctuation-period-text"><strong>$249,452</strong> in <strong>2016</strong></span><br>
                        <button class="btn btn-sm btn-transparent-white" type="button"><span class="fa fa-calendar"></span> View Different Year</button>
                    </section>
                    <section class="widget-fluctuation-description">
                        <span class="widget-fluctuation-description-amount">+$45,463</span>
                        <span class="widget-fluctuation-description-text">increase on this<br>period last year</span>
                    </section>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <div class="widget widget-purple widget-fluctuation">
                <header class="widget-header">
                    Monthly Revenue
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    <section class="widget-fluctuation-period">
                        <span class="widget-fluctuation-period-text"><strong>$249,452</strong> in <strong>2016</strong></span><br>
                        <button class="btn btn-sm btn-transparent-white" type="button"><span class="fa fa-calendar"></span> View Different Year</button>
                    </section>
                    <section class="widget-fluctuation-description">
                        <span class="widget-fluctuation-description-amount">+$45,463</span>
                        <span class="widget-fluctuation-description-text">increase on this<br>period last year</span>
                    </section>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <h4 class="margin-top-0">Statistic Widgets <small>For when you need to showcase numbers</small></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="widget widget-statistic widget-default">
                <header class="widget-statistic-header">Profit this quarter</header>
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">$27,294</span>
                    <span class="widget-statistic-description">That's <strong>$2,593 more</strong> than this quarter last year</span>
                    <span class="widget-statistic-icon fa fa-credit-card-alt"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget widget-statistic widget-primary">
                <header class="widget-statistic-header">Closed support cases</header>
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">59%</span>
                    <span class="widget-statistic-description">That's <strong>12 less</strong> than this time last week</span>
                    <span class="widget-statistic-icon fa fa-support"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget widget-statistic widget-purple">
                <header class="widget-statistic-header">Closed support cases</header>
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">59%</span>
                    <span class="widget-statistic-description">That's <strong>12 less</strong> than this time last week</span>
                    <span class="widget-statistic-icon fa fa-support"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget widget-statistic-mini widget-default">
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">10</span>
                    <span class="widget-statistic-icon fa fa-bullhorn"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget widget-statistic-mini widget-faded-blue">
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">6345</span>
                    <span class="widget-statistic-icon fa fa-bolt"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget widget-statistic-mini widget-info">
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">42</span>
                    <span class="widget-statistic-icon fa fa-diamond"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget widget-statistic-mini widget-danger">
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">374</span>
                    <span class="widget-statistic-icon fa fa-line-chart"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget widget-statistic-mini widget-success">
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">93%</span>
                    <span class="widget-statistic-icon fa fa-smile-o"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="widget widget-statistic-mini widget-pink">
                <div class="widget-statistic-body">
                    <span class="widget-statistic-value">73</span>
                    <span class="widget-statistic-icon fa fa-rss"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h4 class="margin-top-0">Achievement Widgets <small>A showcased picture with some content</small></h4>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-6 col-lg-4">
            <div class="widget widget-default widget-achievement">
                <div class="widget-body widget-body-lg">
                    <h2 class="achievement-heading">James Taylor</h2>
                    <h3 class="achievement-subheading">Employee of the Month</h3>
                    <img src="img/james-taylor.jpg" alt="James Taylor, Employee of the Month" class="achievement-image">
                    <p class="achievement-description">James made <strong>1,294 new sales</strong> in just <strong>31 days</strong></p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4">
            <div class="widget widget-info widget-achievement">
                <div class="widget-body widget-body-lg">
                    <h2 class="achievement-heading">Michael Powers</h2>
                    <h3 class="achievement-subheading">Employee of the Year</h3>
                    <img src="img/user-2-profile.jpg" alt="Michael Powers, Employee of the Year" class="achievement-image">
                    <p class="achievement-description">Michael made <strong>24,129 new sales</strong> in just <strong>365 days</strong></p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="widget widget-success widget-achievement">
                <div class="widget-body widget-body-lg">
                    <h2 class="achievement-heading">Sandra Nelvo</h2>
                    <h3 class="achievement-subheading">Employee of the Quarter</h3>
                    <img src="img/user-3-profile.jpg" alt="Sandra Nelvo, Employee of the Quarter" class="achievement-image">
                    <p class="achievement-description">Sandra made <strong>11,425 new sales</strong> in just <strong>91 days</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h4 class="margin-top-0">Social Widgets <small>For a chatroom, comment board, or any other applicable social setting</small></h4>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-6 col-lg-4">
            <div class="widget widget-default">
                <header class="widget-header">
                    <span class="fa fa-user"></span> Chatbox with Sandra
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    <div class="social-conversation">
                        <div class="social-conversation-item social-conversation-item-right">
                            <img src="img/user-1-profile.jpg" alt="Tyrone G" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago text-primary">Just now</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Tyrone Gary</div>
                                <div class="social-conversation-item-message-content">How much money will this project make?</div>
                                <div class="social-conversation-item-message-timestamp">10:16AM - 17.05.2016</div>
                            </div>
                        </div>
                        <div class="social-conversation-item">
                            <img src="img/user-3-profile.jpg" alt="Sandra T" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago">11m ago</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Sandra Nelvo</div>
                                <div class="social-conversation-item-message-content">I have been writing up the proposal for our latest project. It will be very lucrative</div>
                                <div class="social-conversation-item-message-timestamp">10:15AM - 17.05.2016</div>
                            </div>
                        </div>
                        <div class="social-conversation-item social-conversation-item-right">
                            <img src="img/user-1-profile.jpg" alt="Tyrone G" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago">14h ago</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Tyrone Gary</div>
                                <div class="social-conversation-item-message-content">Hey Sandra, what have you been working on today?</div>
                                <div class="social-conversation-item-message-timestamp">10:12AM - 17.05.2016</div>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-left">Respond to Sandra</h4>
                    <textarea placeholder="Write your message here..." name="respond_sandra" class="form-control" id="respond_sandra" cols="30" rows="5"></textarea>
                    <button type="button" class="btn btn-transparent btn-transparent-primary pull-right margin-top-5"><span class="fa fa-send"></span> Send</button>
                </div>
            </div>
        </div>


        <div class="col-sm-6 col-lg-4">
            <div class="widget widget-info">
                <header class="widget-header">
                    <span class="fa fa-user"></span> Chatbox with James
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    <div class="social-conversation">
                        <div class="social-conversation-item social-conversation-item-right">
                            <img src="img/user-1-profile.jpg" alt="Tyrone G" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago"><strong>Just now</strong></div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Tyrone Gary</div>
                                <div class="social-conversation-item-message-content">How much money will this project make?</div>
                                <div class="social-conversation-item-message-timestamp">10:16AM - 17.05.2016</div>
                            </div>
                        </div>
                        <div class="social-conversation-item">
                            <img src="img/james-taylor.jpg" alt="James T" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago">11m ago</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">James Taylor</div>
                                <div class="social-conversation-item-message-content">I have been writing up the proposal for our latest project. It will be very lucrative</div>
                                <div class="social-conversation-item-message-timestamp">10:15AM - 17.05.2016</div>
                            </div>
                        </div>
                        <div class="social-conversation-item social-conversation-item-right">
                            <img src="img/user-1-profile.jpg" alt="Tyrone G" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago">14h ago</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Tyrone Gary</div>
                                <div class="social-conversation-item-message-content">Hey James, what have you been working on today?</div>
                                <div class="social-conversation-item-message-timestamp">10:12AM - 17.05.2016</div>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-left">Respond to James</h4>
                    <textarea placeholder="Write your message here..." name="respond_james" class="form-control" id="respond_james" cols="30" rows="5"></textarea>
                    <button type="button" class="btn btn-transparent pull-right margin-top-5"><span class="fa fa-send"></span> Send</button>
                </div>
            </div>
        </div>


        <div class="col-sm-12 col-lg-4">
            <div class="widget widget-success">
                <header class="widget-header">
                    <span class="fa fa-user"></span> Chatbox with Michael
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    <div class="social-conversation">
                        <div class="social-conversation-item social-conversation-item-right">
                            <img src="img/user-1-profile.jpg" alt="Tyrone G" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago"><strong>Just now</strong></div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Tyrone Gary</div>
                                <div class="social-conversation-item-message-content">How much money will this project make?</div>
                                <div class="social-conversation-item-message-timestamp">10:16AM - 17.05.2016</div>
                            </div>
                        </div>
                        <div class="social-conversation-item">
                            <img src="img/user-2-profile.jpg" alt="Michael T" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago">11m ago</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Michael Powers</div>
                                <div class="social-conversation-item-message-content">I have been writing up the proposal for our latest project. It will be very lucrative</div>
                                <div class="social-conversation-item-message-timestamp">10:15AM - 17.05.2016</div>
                            </div>
                        </div>
                        <div class="social-conversation-item social-conversation-item-right">
                            <img src="img/user-1-profile.jpg" alt="Tyrone G" class="social-conversation-item-image">
                            <div class="social-conversation-item-ago">14h ago</div>
                            <div class="social-conversation-item-message">
                                <div class="social-conversation-item-message-from">Tyrone Gary</div>
                                <div class="social-conversation-item-message-content">Hey James, what have you been working on today?</div>
                                <div class="social-conversation-item-message-timestamp">10:12AM - 17.05.2016</div>
                            </div>
                        </div>
                    </div>
                    <h4 class="text-left">Respond to Michael</h4>
                    <textarea placeholder="Write your message here..." name="respond_michael" class="form-control" id="respond_michael" cols="30" rows="5"></textarea>
                    <button type="button" class="btn btn-transparent pull-right margin-top-5"><span class="fa fa-send"></span> Send</button>
                </div>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-xs-12">
            <h4 class="margin-top-0">Standard Widgets <small>You can put just about anything inside these widget windows. They are simply purpose-built panels.</small></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    <span class="fa fa-user"></span> Dedicated Server Load
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body widget-body-md">
                    <div>CPU Load <span class="pull-right text-muted">28% / 100%</span></div>
                    <div class="progress">
                      <div class="progress-bar progress-bar-default" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 34%;">
                        <span class="sr-only">34% CPU Power In Use</span>
                    </div>
                </div>
                <div>CPU Load <span class="pull-right text-muted">28% / 100%</span></div>
                <div class="progress">
                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 28%;">
                    <span class="sr-only">28% Ram Used</span>
                </div>
            </div>
            <div>CPU Load <span class="pull-right text-muted">28% / 100%</span></div>
            <div class="progress">
              <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 84%;">
                <span class="sr-only">84% Full</span>
            </div>
        </div>
        <div class="row margin-top-15">
            <div class="col-xs-6"><button class="btn btn-block btn-default">Purge Cache</button></div>
            <div class="col-xs-6"><button class="btn btn-block btn-default">Reset Server</button></div>
        </div>
    </div>
</div>
</div>
<div class="col-md-6">
    <div class="widget widget-default">
        <header class="widget-header">
            Website Registrations
            <div class="widget-header-actions">
                <span class="widget-header-action fa fa-cog"></span>
                <span data-close-widget class="widget-header-action fa fa-close"></span>
            </div>
        </header>
        <div class="widget-body widget-body-md">
            <canvas id="graph-monthly-registrations" class="widget-graph-md"></canvas>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="widget widget-default">
            <header class="widget-header">
                <span class="fa fa-user"></span> App Users
                <div class="widget-header-actions">
                    <span class="widget-header-action fa fa-cog"></span>
                    <span data-close-widget class="widget-header-action fa fa-close"></span>
                </div>
            </header>
            <div class="widget-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th class="hidden-xs hidden-sm">#</th>
                            <th class="hidden-xs hidden-sm">First Name</th>
                            <th class="hidden-xs hidden-sm">Last Name</th>
                            <th>Email</th>
                            <th>Quota</th>
                            <th class="text-right">Manage<span class="hidden-xs hidden-sm"> User</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="hidden-xs hidden-sm">1</td>
                            <td class="hidden-xs hidden-sm">Mark</td>
                            <td class="hidden-xs hidden-sm">Smith</td>
                            <td><a href="mailto:marksmith@test.com">marksmith@test.com</a></td>
                            <td><div data-toggle="tooltip" data-placement="left" title="3GB / 10GB used"><span class="piety-pie">3/10</span></div></td>
                            <td class="text-right"><button class="btn btn-faded btn-transparent btn-xs"><span class="fa fa-pencil"></span> <span class="hidden-xs hidden-sm">Edit</span></button> <button class="btn btn-faded btn-transparent btn-transparent-danger btn-xs"><span class="fa fa-trash"></span> <span class="hidden-xs hidden-sm">Delete</span></button></td>
                        </tr>
                        <tr>
                            <td class="hidden-xs hidden-sm">2</td>
                            <td class="hidden-xs hidden-sm">Jim</td>
                            <td class="hidden-xs hidden-sm">Johnson</td>
                            <td><a href="mailto:jimjohnson@test.com">jimjohnson@test.com</a></td>
                            <td><div data-toggle="tooltip" data-placement="left" title="5.63GB / 10GB used"><span class="piety-pie">5.63/10</span></div></td>
                            <td class="text-right"><button class="btn btn-faded btn-transparent btn-xs"><span class="fa fa-pencil"></span> <span class="hidden-xs hidden-sm">Edit</span></button> <button class="btn btn-faded btn-transparent btn-transparent-danger btn-xs"><span class="fa fa-trash"></span> <span class="hidden-xs hidden-sm">Delete</span></button></td>
                        </tr>
                        <tr>
                            <td class="hidden-xs hidden-sm">3</td>
                            <td class="hidden-xs hidden-sm">Harry</td>
                            <td class="hidden-xs hidden-sm">Williams</td>
                            <td><a href="mailto:harrywilliams@test.com">harrywilliams@test.com</a></td>
                            <td><div data-toggle="tooltip" data-placement="left" title="2.56GB / 10GB used"><span class="piety-pie">2.56/10</span></div></td>
                            <td class="text-right"><button class="btn btn-faded btn-transparent btn-xs"><span class="fa fa-pencil"></span> <span class="hidden-xs hidden-sm">Edit</span></button> <button class="btn btn-faded btn-transparent btn-transparent-danger btn-xs"><span class="fa fa-trash"></span> <span class="hidden-xs hidden-sm">Delete</span></button></td>
                        </tr>
                        <tr>
                            <td class="hidden-xs hidden-sm">4</td>
                            <td class="hidden-xs hidden-sm">Bob</td>
                            <td class="hidden-xs hidden-sm">Jones</td>
                            <td><a href="mailto:bobjones@test.com">bobjones@test.com</a></td>
                            <td><div data-toggle="tooltip" data-placement="left" title="0.02GB / 10GB used"><span class="piety-pie">0.02/10</span></div></td>
                            <td class="text-right"><button class="btn btn-faded btn-transparent btn-xs"><span class="fa fa-pencil"></span> <span class="hidden-xs hidden-sm">Edit</span></button> <button class="btn btn-faded btn-transparent btn-transparent-danger btn-xs"><span class="fa fa-trash"></span> <span class="hidden-xs hidden-sm">Delete</span></button></td>
                        </tr>
                        <tr>
                            <td class="hidden-xs hidden-sm">5</td>
                            <td class="hidden-xs hidden-sm">Ryan</td>
                            <td class="hidden-xs hidden-sm">Brown</td>
                            <td><a href="mailto:ryanbrown@test.com">ryanbrown@test.com</a></td>
                            <td><div data-toggle="tooltip" data-placement="left" title="0GB / 10GB used"><span class="piety-pie">0/10</span></div></td>
                            <td class="text-right"><button class="btn btn-faded btn-transparent btn-xs"><span class="fa fa-pencil"></span> <span class="hidden-xs hidden-sm">Edit</span></button> <button class="btn btn-faded btn-transparent btn-transparent-danger btn-xs"><span class="fa fa-trash"></span> <span class="hidden-xs hidden-sm">Delete</span></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')
</div>
@endsection