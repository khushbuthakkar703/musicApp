@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-th-small-outline page-header-heading-icon"></span> Grid System</h1>
                <p class="page-header-description">Bootstrap's powerful grid system coupled with the Varello Admin design make for an incredibly smooth, responsive experience for the end user. You will find instructions below on how to best use it.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <!-- START CONTAINER -->
    <div class="row">
        <!-- START CONTENT ROW -->
        <div class="col-xs-12">
            <div class="widget widget-default">
                <header class="widget-header">
                    Grid Options
                </header>
                <div class="widget-body">
                    <p>See how aspects of the Bootstrap grid system work across multiple devices with a handy table.</p>
                    <table class="table table-bordered table-striped"> <thead> <tr> <th></th> <th> Extra small devices <small>Phones (&lt;768px)</small> </th> <th> Small devices <small>Tablets (≥768px)</small> </th> <th> Medium devices <small>Desktops (≥992px)</small> </th> <th> Large devices <small>Desktops (≥1200px)</small> </th> </tr> </thead> <tbody> <tr> <th class="text-nowrap" scope="row">Grid behavior</th> <td>Horizontal at all times</td> <td colspan="3">Collapsed to start, horizontal above breakpoints</td> </tr> <tr> <th class="text-nowrap" scope="row">Container width</th> <td>None (auto)</td> <td>750px</td> <td>970px</td> <td>1170px</td> </tr> <tr> <th class="text-nowrap" scope="row">Class prefix</th> <td><code>.col-xs-</code></td> <td><code>.col-sm-</code></td> <td><code>.col-md-</code></td> <td><code>.col-lg-</code></td> </tr> <tr> <th class="text-nowrap" scope="row"># of columns</th> <td colspan="4">12</td> </tr> <tr> <th class="text-nowrap" scope="row">Column width</th> <td class="text-muted">Auto</td> <td>~62px</td> <td>~81px</td> <td>~97px</td> </tr> <tr> <th class="text-nowrap" scope="row">Gutter width</th> <td colspan="4">30px (15px on each side of a column)</td> </tr> <tr> <th class="text-nowrap" scope="row">Nestable</th> <td colspan="4">Yes</td> </tr> <tr> <th class="text-nowrap" scope="row">Offsets</th> <td colspan="4">Yes</td> </tr> <tr> <th class="text-nowrap" scope="row">Column ordering</th> <td colspan="4">Yes</td> </tr> </tbody> </table>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Stacked-To-Horizontal
                </header>
                <div class="widget-body">
                    <p>Using a single set of <code>.col-md-*</code> grid classes, you can create a basic grid system that starts out stacked on mobile devices and tablet devices (the extra small to small range) before becoming horizontal on desktop (medium) devices. Place grid columns in any <code>.row</code>.</p>
                    <div class="row show-grid">
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                      <div class="col-md-1">.col-md-1</div>
                  </div>
                  <div class="row show-grid">
                      <div class="col-md-8">.col-md-8</div>
                      <div class="col-md-4">.col-md-4</div>
                  </div>
                  <div class="row show-grid">
                      <div class="col-md-4">.col-md-4</div>
                      <div class="col-md-4">.col-md-4</div>
                      <div class="col-md-4">.col-md-4</div>
                  </div>
                  <div class="row show-grid">
                      <div class="col-md-6">.col-md-6</div>
                      <div class="col-md-6">.col-md-6</div>
                  </div>
              </div>
          </div>
          <div class="widget widget-default">
            <header class="widget-header">
                Fluid Container
            </header>
            <div class="widget-body">
                <p>Turn any fixed-width grid layout into a full-width layout by changing your outermost <code>.container</code> to <code>.container-fluid</code>.</p>
<pre>&lt;div class="container-fluid"&gt;
    &lt;div class="row"&gt;
    ...
    &lt;/div&gt;
&lt;/div&gt;</pre>
              </div>
          </div>
          <div class="widget widget-default">
            <header class="widget-header">
                Mobile And Desktop
            </header>
            <div class="widget-body">
                <p>Don't want your columns to simply stack in smaller devices? Use the extra small and medium device grid classes by adding <code>.col-xs-*</code> <code>.col-md-*</code> to your columns. See the example below for a better idea of how it all works.</p>
                <!-- Stack the columns on mobile by making one full-width and the other half-width -->
                <div class="row show-grid">
                  <div class="col-xs-12 col-md-8">.col-xs-12 .col-md-8</div>
                  <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
              </div>

              <!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
              <div class="row show-grid">
                  <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
                  <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
                  <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
              </div>

              <!-- Columns are always 50% wide, on mobile and desktop -->
              <div class="row show-grid">
                  <div class="col-xs-6">.col-xs-6</div>
                  <div class="col-xs-6">.col-xs-6</div>
              </div>
          </div>
      </div>
      <div class="widget widget-default">
        <header class="widget-header">
            Mobile, Tablet, Desktop
        </header>
        <div class="widget-body">
            <p>Build on the previous example by creating even more dynamic and powerful layouts with tablet <code>.col-sm-*</code> classes.</p>
            <div class="row show-grid">
              <div class="col-xs-12 col-sm-6 col-md-8">.col-xs-12 .col-sm-6 .col-md-8</div>
              <div class="col-xs-6 col-md-4">.col-xs-6 .col-md-4</div>
          </div>
          <div class="row show-grid">
              <div class="col-xs-6 col-sm-4">.col-xs-6 .col-sm-4</div>
              <div class="col-xs-6 col-sm-4">.col-xs-6 .col-sm-4</div>
              <!-- Optional: clear the XS cols if their content doesn't match in height -->
              <div class="clearfix visible-xs-block"></div>
              <div class="col-xs-6 col-sm-4">.col-xs-6 .col-sm-4</div>
          </div>
      </div>
  </div>
  <div class="widget widget-default">
    <header class="widget-header">
        Column Wrapping
    </header>
    <div class="widget-body">
        <p>If more than 12 columns are placed within a single row, each group of extra columns will, as one unit, wrap onto a new line.</p>
        <div class="row show-grid">
          <div class="col-xs-9">.col-xs-9</div>
          <div class="col-xs-4">.col-xs-4<br>Since 9 + 4 = 13 &gt; 12, this 4-column-wide div gets wrapped onto a new line as one contiguous unit.</div>
          <div class="col-xs-6">.col-xs-6<br>Subsequent columns continue along the new line.</div>
      </div>
  </div>
</div>
<div class="widget widget-default">
    <header class="widget-header">
        Responsive Column Resets
    </header>
    <div class="widget-body">
        <p>With the four tiers of grids available you're bound to run into issues where, at certain breakpoints, your columns don't clear quite right as one is taller than the other. To fix that, use a combination of a <code>.clearfix</code> and our responsive utility classes.</p>
        <div class="row show-grid">
          <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div>
          <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div>

          <!-- Add the extra clearfix for only the required viewport -->
          <div class="clearfix visible-xs-block"></div>

          <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div>
          <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div>
      </div>
      <div class="row show-grid"> <div class="col-xs-6 col-sm-3"> .col-xs-6 .col-sm-3 <br> Resize your viewport or check it out on your phone for an example. </div> <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div>  <div class="clearfix visible-xs-block"></div> <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div> <div class="col-xs-6 col-sm-3">.col-xs-6 .col-sm-3</div> </div>
      <p>In addition to column clearing at responsive breakpoints, you may need to <strong>reset offsets, pushes, or pulls</strong>.</p>
<pre>&lt;div class="row"&gt;
  &lt;div class="col-sm-5 col-md-6"&gt;.col-sm-5 .col-md-6&lt;/div&gt;
  &lt;div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0"&gt;.col-sm-5 .col-sm-offset-2 .col-md-6 .col-md-offset-0&lt;/div&gt;
&lt;/div&gt;

&lt;div class="row"&gt;
  &lt;div class="col-sm-6 col-md-5 col-lg-6"&gt;.col-sm-6 .col-md-5 .col-lg-6&lt;/div&gt;
  &lt;div class="col-sm-6 col-md-5 col-md-offset-2 col-lg-6 col-lg-offset-0"&gt;.col-sm-6 .col-md-5 .col-md-offset-2 .col-lg-6 .col-lg-offset-0&lt;/div&gt;
&lt;/div&gt;</pre>
</div>
  </div>
  <div class="widget widget-default">
    <header class="widget-header">
        Offsetting Columns
    </header>
    <div class="widget-body">
        <p>Move columns to the right using <code>.col-md-offset-*</code> classes. These classes increase the left margin of a column by <code>*</code> columns. For example, <code>.col-md-offset-4</code> moves <code>.col-md-4</code> over four columns.</p>
        <div class="row show-grid">
          <div class="col-md-4">.col-md-4</div>
          <div class="col-md-4 col-md-offset-4">.col-md-4 .col-md-offset-4</div>
      </div>
      <div class="row show-grid">
          <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
          <div class="col-md-3 col-md-offset-3">.col-md-3 .col-md-offset-3</div>
      </div>
      <div class="row show-grid">
          <div class="col-md-6 col-md-offset-3">.col-md-6 .col-md-offset-3</div>
      </div>
  </div>
</div>
<div class="widget widget-default">
    <header class="widget-header">
        Nesting Columns
    </header>
    <div class="widget-body">
        <p>To nest your content with the default grid, add a new <code>.row</code> and set of <code>.col-sm-*</code> columns within an existing <code>.col-sm-*</code> column. Nested rows should include a set of columns that add up to 12 or fewer (it is not required that you use all 12 available columns).</p>
        <div class="row show-grid">
          <div class="col-sm-9">
            Level 1: .col-sm-9
            <div class="row show-grid">
              <div class="col-xs-8 col-sm-6">
                Level 2: .col-xs-8 .col-sm-6
            </div>
            <div class="col-xs-4 col-sm-6">
                Level 2: .col-xs-4 .col-sm-6
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="widget widget-default">
    <header class="widget-header">
        Column Ordering
    </header>
    <div class="widget-body">
        <p>Easily change the order of our built-in grid columns with <code>.col-md-push-*</code> and <code>.col-md-pull-*</code> modifier classes.</p>
        <div class="row show-grid">
          <div class="col-md-9 col-md-push-3">.col-md-9 .col-md-push-3</div>
          <div class="col-md-3 col-md-pull-9">.col-md-3 .col-md-pull-9</div>
      </div>
  </div>
</div>
</div>
<!-- END CONTENT ROW -->
</div>
<footer class="content-wrapper-footer">
    &copy; Copyright 2016 VarelloAdmin. Crafted with <span class="fa fa-heart"></span> by <a href="http://www.varellothemes.com" target="_blank">Varello Themes</a>.
</footer>
<!-- END CONTAINER -->
</div>
@endsection