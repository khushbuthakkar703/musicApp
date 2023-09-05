@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-arrow-right-outline page-header-heading-icon"></span> Pagination</h1>
                <p class="page-header-description">This theme comes with restyled versions of the pager to fit with the colour scheme.</p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <!-- START CONTAINER -->
    <div class="row">
        <!-- START CONTENT ROW -->
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Default Pagination
                </header>
                <div class="widget-body">
                    <p>Simple pagination inspired by Rdio, great for apps and search results. The large block is hard to miss, easily scalable, and provides large click areas.</p>
                    <nav>
                      <ul class="pagination">
                        <li>
                          <a href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                          </a>
                        </li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                          <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Sizing
                </header>
                <div class="widget-body">
                    <p>Fancy larger or smaller pagination? Add <code>.pagination-lg</code> or <code>.pagination-sm</code> for additional sizes.</p>
                    <div class="bs-example" data-example-id="pagination-sizing"> <nav> <ul class="pagination pagination-lg"> <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li> <li><a href="#">1</a></li> <li><a href="#">2</a></li> <li><a href="#">3</a></li> <li><a href="#">4</a></li> <li><a href="#">5</a></li> <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li> </ul> </nav> <nav> <ul class="pagination"> <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li> <li><a href="#">1</a></li> <li><a href="#">2</a></li> <li><a href="#">3</a></li> <li><a href="#">4</a></li> <li><a href="#">5</a></li> <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li> </ul> </nav> <nav> <ul class="pagination pagination-sm"> <li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li> <li><a href="#">1</a></li> <li><a href="#">2</a></li> <li><a href="#">3</a></li> <li><a href="#">4</a></li> <li><a href="#">5</a></li> <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li> </ul> </nav> </div>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Default Pages
                </header>
                <div class="widget-body">
                <p>Quick previous and next links for simple pagination implementations with light markup and styles. It's great for simple sites like blogs or magazines.</p>
                <p>By default, the pager centers links.</p>
                <nav>
                  <ul class="pager">
                    <li><a href="#">Previous</a></li>
                    <li><a href="#">Next</a></li>
                  </ul>
                </nav>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Disabled And Active States
                </header>
                <div class="widget-body">
                    <p>Links are customizable for different circumstances. Use <code>.disabled</code> for unclickable links and <code>.active</code> to indicate the current page.</p>
                    <nav> <ul class="pagination"> <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li> <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li> <li><a href="#">2</a></li> <li><a href="#">3</a></li> <li><a href="#">4</a></li> <li><a href="#">5</a></li> <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li> </ul> </nav>
                    <p>You can optionally swap out active or disabled anchors for <code>&lt;span&gt;</code>, or omit the anchor in the case of the previous/next arrows, to remove click functionality while retaining intended styles.</p>
<pre>
&lt;nav&gt;
  &lt;ul class="pagination"&gt;
    &lt;li class="disabled"&gt;
      &lt;span&gt;
        &lt;span aria-hidden="true"&gt;&laquo;&lt;/span&gt;
      &lt;/span&gt;
    &lt;/li&gt;
    &lt;li class="active"&gt;
      &lt;span&gt;1 &lt;span class="sr-only"&gt;(current)&lt;/span&gt;&lt;/span&gt;
    &lt;/li&gt;
    ...
  &lt;/ul&gt;
&lt;/nav&gt;
</pre>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Optional Disabled State For Pagers
                </header>
                <div class="widget-body">
                    <p>Pager links also use the general <code>.disabled</code> utility class from the pagination.</p>
                    <nav>
                      <ul class="pager">
                        <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
                        <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
                      </ul>
                    </nav>
                </div>
            </div>
            
            <div class="widget widget-default">
                <header class="widget-header">
                    Aligned Links
                </header>
                <div class="widget-body">
                    <p>Alternatively, you can align each link to the sides:</p>
                    <nav>
                      <ul class="pager">
                        <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
                        <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
                      </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- END CONTENT ROW -->
    </div>
    @include('admin.partials.footer')
    <!-- END CONTAINER -->
</div>
@endsection