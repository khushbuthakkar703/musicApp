@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-info page-header-heading-icon"></span>Frequently Asked Questions <small>Straight from our support centre</small></h1>
                <p class="page-header-description">Having any of these common problems with the application? Hopefully the FAQs listed below will help. We also have 24/7 support through use of our <a href="{{ route('admin.appPages.enquiry') }}">support form</a>.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <!-- START CONTAINER -->
    <div class="row">
        <!-- START CONTENT ROW -->
        <div class="col-xs-12 col-md-3">
            <div class="list-group">
                <div class="list-group-item">
                    <h4 class="list-group-item-heading">Pick a category</h4>
                    <p class="list-group-item-text">We've received a lot of commonly asked questions, so we've split them into 5 handy categories.</p>
                </div>
                <a href="#" class="list-group-item active"><span class="fa fa-question-circle list-group-item-icon"></span> General</a>
                <a href="#" class="list-group-item"><span class="fa fa-credit-card list-group-item-icon"></span> Pricing &amp; Payments</a>
                <a href="#" class="list-group-item"><span class="fa fa-lock list-group-item-icon"></span> Security</a>
                <a href="#" class="list-group-item"><span class="fa fa-bolt list-group-item-icon"></span> Features</a>
                <a href="#" class="list-group-item"><span class="fa fa-users list-group-item-icon"></span> Affiliate Programme</a>
            </div>
        </div>
        <div class="col-xs-12 col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Find your question below, or <a href="{{ route('admin.appPages.enquiry') }}">submit one using our support form</a></div>
                <div class="panel-body">
                    <div class="faqs">
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> What is amet dolor a lorem? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Donec eget ex vitae ex eleifend mattis ac lacinia turpis. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> How do I non urna eleifend? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <h4>Iaculis vitae lorem eu</h4>
                                <p>
                                    Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare. Vivamus efficitur libero at luctus auctor. Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                                <h4>Eleifend rhoncus sem</h4>
                                <p>
                                    Donec eget ex vitae ex eleifend mattis ac lacinia turpis. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum.
                                </p>
                                <p>
                                    Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> When can the mollis odio at consequat finibus? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Donec eget ex vitae ex eleifend mattis ac lacinia turpis. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> Has the app got eget massa fermentum? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare. Vivamus efficitur libero at luctus auctor. Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> Do these all libero est, commodo id eros? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare. Vivamus efficitur libero at luctus auctor. Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> What is amet dolor a lorem? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Donec eget ex vitae ex eleifend mattis ac lacinia turpis. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> How do I non urna eleifend? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare. Vivamus efficitur libero at luctus auctor. Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> When can the mollis odio at consequat finibus? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Donec eget ex vitae ex eleifend mattis ac lacinia turpis. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum. Curabitur nec elementum diam, ac mattis erat. Praesent ac sem ullamcorper, iaculis dolor rhoncus, vehicula ipsum.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> Has the app got eget massa fermentum? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare. Vivamus efficitur libero at luctus auctor. Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                            </div>
                        </div>
                        <div class="faqs-question">
                            <h2 class="faqs-question-text"> Do these all libero est, commodo id eros? <span class="fa fa-minus faqs-question-toggle-icon-open"></span><span class="fa fa-plus faqs-question-toggle-icon-closed"></span></h2>
                            <div class="faqs-question-answer" style="display: none;">
                                <p>
                                    Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare. Vivamus efficitur libero at luctus auctor. Phasellus felis nisl, iaculis vitae lorem eu, eleifend rhoncus sem. Quisque eget massa fermentum felis fermentum ornare.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT ROW -->
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection