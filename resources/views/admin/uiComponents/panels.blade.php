@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-tabs-outline page-header-heading-icon"></span> Panels &amp; Widget Boxes</h1>
                <p class="page-header-description">When you want to place a group of elements into a box, try using panels &amp; widget boxes.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <!-- START CONTAINER -->
    <div class="row">
        <!-- START CONTENT ROW -->
        <div class="col-xs-12 col-md-6">
            <h2>Panels <small>Bootstrap + More Context</small></h2>
            <h3>Basic Example</h3>
            <div class="panel panel-default">
              <div class="panel-body">
                Basic panel example
              </div>
            </div>

            <h3>Panel With Heading</h3>
            <p>Easily add a heading container to your panel with <code>.panel-heading</code>. You may also include any <code>&lt;h1&gt;</code>-<code>&lt;h6&gt;</code> with a <code>.panel-title</code> class to add a pre-styled heading. However, the font sizes of <code>&lt;h1&gt;</code>-<code>&lt;h6&gt;</code> are overridden by <code>.panel-heading</code>.</p>
            <p>For proper link coloring, be sure to place links in headings within <code>.panel-title</code>.</p>
            <div class="panel panel-default">
              <div class="panel-heading">Panel heading without title</div>
              <div class="panel-body">
                Panel content
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title">Panel title</h3>
              </div>
              <div class="panel-body">
                Panel content
              </div>
            </div>
<h3>Panel With Footer</h3>
<p>Wrap buttons or secondary text in <code>.panel-footer</code>. Note that panel footers <strong>do not</strong> inherit colors and borders when using contextual variations as they are not meant to be in the foreground.</p>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<h3>Contextual Alternatives</h3>
<p>Like other components, easily make a panel more meaningful to a particular context by adding any of the contextual state classes.</p>
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-purple">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-pink">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

<div class="panel panel-faded-blue">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
  <div class="panel-footer">Panel footer</div>
</div>

        <h3>With Tables</h3>
        <div class="panel panel-default">  <div class="panel-heading">Panel heading</div> <div class="panel-body"> <p>Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> </div>  <table class="table"> <thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table> </div>

        <p>If there is no panel body, the component moves from panel header to table without interruption</p>

        <div class="panel panel-default">  <div class="panel-heading">Panel heading</div>  <table class="table"> <thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table> </div>

        <h3>With List Groups</h3>

        <div class="panel panel-default">  <div class="panel-heading">Panel heading</div> <div class="panel-body"> <p>Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.</p> </div>  <ul class="list-group"> <li class="list-group-item">Cras justo odio</li> <li class="list-group-item">Dapibus ac facilisis in</li> <li class="list-group-item">Morbi leo risus</li> <li class="list-group-item">Porta ac consectetur ac</li> <li class="list-group-item">Vestibulum at eros</li> </ul> </div>

        </div>
        <div class="col-xs-12 col-md-6">
            <h2>Widget Boxes <small>Varello Exclusive</small></h2>
            <p>Widget Boxes are similar to panels, but have different padding and housing which is better suited to widget-style content. It also has a larger shaded-top border.</p>
            <h3>Basic Example</h3>
            <div class="widget widget-default">
                <div class="widget-body">
                    Basic Widget Box Example
                </div>
            </div>
            <h3>Widget With Header</h3>
            <p>Easily add a header container to your widget with <code>.widget-header</code>. Unlike panels, Widget Headers (not headings) are consistent so that the user begins to easily associate the sizing with a widget-style element.</p>
            <div class="widget widget-default">
                <header class="widget-header">
                    Title
                </header>
                <div class="widget-body">
                    Content
                </div>
            </div>
            <h3>Widget With Actions</h3>
            <p>You can include a set of actions within any widget using <code>.widget-header-actions</code>. This allows you to add close, configuration or any other times of buttons.</p>
            <h3>Contextual Alternatives</h3>
            <p>Widget boxes have just as many contextual alternatives as panels. Unlike a panel, however, the entire widget box changes colour to suit the context. This is so that all information is presented in the specified context, not just the header.</p>

            @foreach(['default', 'primary', 'success', 'info', 'warning', 'danger', 'purple', 'pink', 'faded-blue', 'white'] as $context)
            <div class="widget widget-{{ $context }}">
                <header class="widget-header">
                    Title
                    <div class="widget-header-actions">
                        <span class="widget-header-action fa fa-cog"></span>
                        <span data-close-widget="" class="widget-header-action fa fa-close"></span>
                    </div>
                </header>
                <div class="widget-body">
                    Content
                </div>
            </div>
            @endforeach
            <h3>With Tables</h3>
            <div class="widget widget-default">
                <header class="widget-header">
                    Title
                </header>
                <div class="widget-body">
                    Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.
                </div>
                <table class="table"> <thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table>
            </div>
            <p>If there is no widget body, the table still seats nicely in the widget box.</p>
            <div class="widget widget-default">
                <header class="widget-header">
                    Title
                </header>
                <table class="table"> <thead> <tr> <th>#</th> <th>First Name</th> <th>Last Name</th> <th>Username</th> </tr> </thead> <tbody> <tr> <th scope="row">1</th> <td>Mark</td> <td>Otto</td> <td>@mdo</td> </tr> <tr> <th scope="row">2</th> <td>Jacob</td> <td>Thornton</td> <td>@fat</td> </tr> <tr> <th scope="row">3</th> <td>Larry</td> <td>the Bird</td> <td>@twitter</td> </tr> </tbody> </table>
            </div>
            <h3>With List Groups</h3>
            <div class="widget widget-default">
                <header class="widget-header">
                    Title
                </header>
                <div class="widget-body">
                    Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.
                </div>
                <ul class="list-group"> <li class="list-group-item">Cras justo odio</li> <li class="list-group-item">Dapibus ac facilisis in</li> <li class="list-group-item">Morbi leo risus</li> <li class="list-group-item">Porta ac consectetur ac</li> <li class="list-group-item">Vestibulum at eros</li> </ul>
            </div>
        </div>
        <!-- END CONTENT ROW -->
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection