@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-sort-alphabetically page-header-heading-icon"></span> Typography</h1>
                <p class="page-header-description">The standard typography from Bootstrap looks fantastic in VarelloAdmin.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Headings
                </header>
                <div class="widget-body">
                    <p>Standard headings <code>&lt;h1&gt;</code> through to <code>&lt;h6&gt;</code> are available through their elements, or using classes with the element name</p>
                    <h1>Heading 1</h1>
                    <h2>Heading 2</h2>
                    <h3>Heading 3</h3>
                    <h4>Heading 4</h4>
                    <h5>Heading 5</h5>
                    <h6>Heading 6</h6>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Standard Copy
                </header>
                <div class="widget-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non dolor eu orci faucibus commodo. Duis tellus sem, feugiat non turpis quis, pellentesque fermentum libero. Maecenas quam nisi, imperdiet ac dolor aliquam, suscipit tempor metus.</p><p>Nulla sit amet justo ac dolor consectetur vehicula eu in tortor. Nullam sit amet porttitor lorem. Suspendisse potenti. Aliquam laoreet arcu ut lectus iaculis, vel dapibus sapien dignissim. Praesent hendrerit elit a leo pharetra, vel convallis metus elementum. Nunc ut neque metus.</p>
                    <p>Nam eget facilisis nisi, at gravida lectus. Etiam egestas nibh lacus, eu condimentum quam pretium sed. Nulla ullamcorper odio est, in porta orci condimentum vel. Curabitur sed justo sed nunc vestibulum vehicula eu vel ex.</p>
                    <p>Nam eget facilisis nisi, at gravida lectus. Etiam egestas nibh lacus, eu condimentum quam pretium sed. Nulla ullamcorper odio est, in porta orci condimentum vel. Curabitur sed justo sed nunc vestibulum vehicula eu vel ex.</p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Inline Text Elements
                </header>
                <div class="widget-body">
                    <p>Lorem ipsum <mark>dolor sit amet</mark>, consectetur adipiscing elit. Mauris non dolor eu orci faucibus commodo. Duis tellus sem, feugiat non turpis quis, pellentesque fermentum libero. Maecenas quam nisi, <del>imperdiet ac dolor aliquam,</del> suscipit tempor metus.</p><p>Nulla sit <s>amet justo</s> ac dolor consectetur vehicula eu in tortor. Nullam sit amet porttitor lorem. Suspendisse potenti. <ins>Aliquam laoreet arcu ut lectus iaculis,</ins> vel dapibus sapien dignissim. Praesent hendrerit elit a leo pharetra, vel convallis metus elementum. Nunc ut neque metus.</p>
                    <p>Nam eget facilisis nisi, <u>at gravida lectus.</u> Etiam egestas nibh lacus, <em>eu condimentum quam pretium sed.</em> Nulla ullamcorper odio est, in porta orci condimentum vel. Curabitur sed justo sed nunc vestibulum vehicula eu vel ex.</p>
                    <p><strong>Nam eget facilisis nisi, at gravida lectus.</strong> <small>Etiam egestas nibh lacus, eu condimentum quam pretium sed. Nulla ullamcorper odio est, in porta orci condimentum vel. Curabitur sed justo sed nunc vestibulum vehicula eu vel ex.</small></p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Transformation Classes
                </header>
                <div class="widget-body">
                    <p class="text-lowercase">Lowercased text.</p>
                    <p class="text-uppercase">Uppercased text.</p>
                    <p class="text-capitalize">Capitalized text.</p>
                </div>
            </div>
            <h3>Abbreviations</h3>
            <div class="widget widget-default">
                <header class="widget-header">
                    Basic Abbreviation
                </header>
                <div class="widget-body">
                    <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Initialism
                </header>
                <div class="widget-body">
                    <p>Add <code>.initialism</code> to an abbreviation for a slightly smaller font-size.</p>
                    <p><abbr title="HyperText Markup Language" class="initialism">HTML</abbr> is the best thing since sliced bread.</p>
                </div>
            </div>
            <h3>Blockquotes</h3>
            <div class="widget widget-default">
                <header class="widget-header">
                    Blockquotes
                </header>
                <div class="widget-body">
                    <blockquote>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </blockquote>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Blockquote Options
                </header>
                <div class="widget-body">
                    <blockquote>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                      <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                    <blockquote class="blockquote-reverse">
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                      <footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>
            </div>
            <h3>Code</h3>
            <div class="widget widget-default">
                <header class="widget-header">
                    Inline
                </header>
                <div class="widget-body">
                    For example, <code>&lt;section&gt;</code> should be wrapped as inline.
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    User Input
                </header>
                <div class="widget-body">
                    To switch directories, type <kbd>cd</kbd> followed by the name of the directory.<br> To edit settings, press <kbd><kbd>ctrl</kbd> + <kbd>,</kbd></kbd>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Basic Block
                </header>
                <div class="widget-body">
                    <pre>&lt;p&gt;Sample text here...&lt;/p&gt;</pre>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Variables
                </header>
                <div class="widget-body">
                    <var>y</var> = <var>m</var><var>x</var> + <var>b</var>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Sample Output
                </header>
                <div class="widget-body">
                    <samp>This text is meant to be treated as sample output from a computer program.</samp>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Headings With Secondary Text
                </header>
                <div class="widget-body">
                    <p>To add some lighter, secondary text to a heading, use the <code>&lt;small&gt;</code> tag or the <code>.small</code> class within the heading</p>
                    <h1>Heading 1 <small>Some subtle extra content</small></h1>
                    <h2>Heading 2 <small>Some subtle extra content</small></h2>
                    <h3>Heading 3 <small>Some subtle extra content</small></h3>
                    <h4>Heading 4 <small>Some subtle extra content</small></h4>
                    <h5>Heading 5 <small>Some subtle extra content</small></h5>
                    <h6>Heading 6 <small>Some subtle extra content</small></h6>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                   Lead Copy
                </header>
                <div class="widget-body">
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris non dolor eu orci faucibus commodo. Duis tellus sem, feugiat non turpis quis, pellentesque fermentum libero.</p><p>Nulla sit amet justo ac dolor consectetur vehicula eu in tortor. Nullam sit amet porttitor lorem. Suspendisse potenti. Aliquam laoreet arcu ut lectus iaculis, vel dapibus sapien dignissim. Praesent hendrerit elit a leo pharetra, vel convallis metus elementum. Nunc ut neque metus.</p>
                    <p>Nam eget facilisis nisi, at gravida lectus. Etiam egestas nibh lacus, eu condimentum quam pretium sed. Nulla ullamcorper odio est, in porta orci condimentum vel. Curabitur sed justo sed nunc vestibulum vehicula eu vel ex.</p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Alignment Classes
                </header>
                <div class="widget-body">
                    <p class="text-left">Left aligned text.</p>
                    <p class="text-center">Center aligned text.</p>
                    <p class="text-right">Right aligned text.</p>
                    <p class="text-justify">Justified text.</p>
                    <p class="text-nowrap">No wrap text.</p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Addresses
                </header>
                <div class="widget-body">
                    <address>
                      <strong>Twitter, Inc.</strong><br>
                      1355 Market Street, Suite 900<br>
                      San Francisco, CA 94103<br>
                      <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>

                    <address>
                      <strong>Full Name</strong><br>
                      <a href="mailto:#">first.last@example.com</a>
                    </address>
                </div>
            </div>
            <h3>Lists</h3>
            <div class="widget widget-default">
                <header class="widget-header">
                    Unordered List
                </header>
                <div class="widget-body">
                    <ul> <li>Lorem ipsum dolor sit amet</li> <li>Consectetur adipiscing elit</li> <li>Integer molestie lorem at massa</li> <li>Facilisis in pretium nisl aliquet</li> <li>Nulla volutpat aliquam velit <ul> <li>Phasellus iaculis neque</li> <li>Purus sodales ultricies</li> <li>Vestibulum laoreet porttitor sem</li> <li>Ac tristique libero volutpat at</li> </ul> </li> <li>Faucibus porta lacus fringilla vel</li> <li>Aenean sit amet erat nunc</li> <li>Eget porttitor lorem</li> </ul>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Ordered List
                </header>
                <div class="widget-body">
                    <ol> <li>Lorem ipsum dolor sit amet</li> <li>Consectetur adipiscing elit</li> <li>Integer molestie lorem at massa</li> <li>Facilisis in pretium nisl aliquet</li> <li>Nulla volutpat aliquam velit</li> <li>Faucibus porta lacus fringilla vel</li> <li>Aenean sit amet erat nunc</li> <li>Eget porttitor lorem</li> </ol>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Unstyled List
                </header>
                <div class="widget-body">
                    <ul class="list-unstyled"> <li>Lorem ipsum dolor sit amet</li> <li>Consectetur adipiscing elit</li> <li>Integer molestie lorem at massa</li> <li>Facilisis in pretium nisl aliquet</li> <li>Nulla volutpat aliquam velit <ul> <li>Phasellus iaculis neque</li> <li>Purus sodales ultricies</li> <li>Vestibulum laoreet porttitor sem</li> <li>Ac tristique libero volutpat at</li> </ul> </li> <li>Faucibus porta lacus fringilla vel</li> <li>Aenean sit amet erat nunc</li> <li>Eget porttitor lorem</li> </ul>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Description List
                </header>
                <div class="widget-body">
                    <dl> <dt>Description lists</dt> <dd>A description list is perfect for defining terms.</dd> <dt>Euismod</dt> <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd> <dd>Donec id elit non mi porta gravida at eget metus.</dd> <dt>Malesuada porta</dt> <dd>Etiam porta sem malesuada magna mollis euismod.</dd> </dl>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Horizontal Description List
                </header>
                <div class="widget-body">
                    <dl class="dl-horizontal"> <dt>Description lists</dt> <dd>A description list is perfect for defining terms.</dd> <dt>Euismod</dt> <dd>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd> <dd>Donec id elit non mi porta gravida at eget metus.</dd> <dt>Malesuada porta</dt> <dd>Etiam porta sem malesuada magna mollis euismod.</dd> <dt>Felis euismod semper eget lacinia</dt> <dd>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</dd> </dl>
                </div>
            </div>
        </div>
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection