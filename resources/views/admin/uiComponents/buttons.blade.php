@extends('layout.admin')

@section('content')
<header class="page-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header-heading"><span class="typcn typcn-th-large page-header-heading-icon"></span> Buttons</h1>
                <p class="page-header-description">As well as standard bootstrap buttons, we provide custom variants to allow you to give more context to them.
                </p>
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="widget widget-default">
                <header class="widget-header">
                    Button Colours
                </header>
                <div class="widget-body">
                    <p>The standard bootstrap buttons, plus extra variants that come with Varello</p>
                    <a href="#" class="btn btn-default">Default</a>
                    <a href="#" class="btn btn-white">White</a>
                    <a href="#" class="btn btn-primary">Primary</a>
                    <a href="#" class="btn btn-success">Success</a>
                    <a href="#" class="btn btn-info">Info</a>
                    <a href="#" class="btn btn-warning">Warning</a>
                    <a href="#" class="btn btn-danger">Danger</a>
                    <a href="#" class="btn btn-purple">Purple</a>
                    <a href="#" class="btn btn-pink">Pink</a>
                    <a href="#" class="btn btn-faded-blue">Faded Blue</a>
                    <a href="#" class="btn btn-link">Link</a>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Transparent Buttons
                </header>
                <div class="widget-body">
                    <p>These buttons fill with their chosen colour when you hover over them</p>
                    <p>
                        <a href="#" class="btn btn-transparent btn-transparent-default">Default</a>
                        <a href="#" class="btn btn-transparent btn-transparent-white">White</a>
                        <a href="#" class="btn btn-transparent btn-transparent-primary">Primary</a>
                        <a href="#" class="btn btn-transparent btn-transparent-success">Success</a>
                        <a href="#" class="btn btn-transparent btn-transparent-info">Info</a>
                        <a href="#" class="btn btn-transparent btn-transparent-warning">Warning</a>
                        <a href="#" class="btn btn-transparent btn-transparent-danger">Danger</a>
                        <a href="#" class="btn btn-transparent btn-transparent-purple">Purple</a>
                        <a href="#" class="btn btn-transparent btn-transparent-pink">Pink</a>
                        <a href="#" class="btn btn-transparent btn-transparent-faded-blue">Faded Blue</a>
                    </p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Pill Buttons
                </header>
                <div class="widget-body">
                    <p>The <code>.btn-pill</code> class gives all buttons a rounded look</p>
                    <p>
                        <a href="#" class="btn btn-pill btn-default">Default</a>
                        <a href="#" class="btn btn-pill btn-white">White</a>
                        <a href="#" class="btn btn-pill btn-primary">Primary</a>
                        <a href="#" class="btn btn-pill btn-success">Success</a>
                        <a href="#" class="btn btn-pill btn-info">Info</a>
                        <a href="#" class="btn btn-pill btn-warning">Warning</a>
                        <a href="#" class="btn btn-pill btn-danger">Danger</a>
                        <a href="#" class="btn btn-pill btn-purple">Purple</a>
                        <a href="#" class="btn btn-pill btn-pink">Pink</a>
                        <a href="#" class="btn btn-pill btn-faded-blue">Faded Blue</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-default">Default</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-white">White</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-primary">Primary</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-success">Success</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-info">Info</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-warning">Warning</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-danger">Danger</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-purple">Purple</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-pink">Pink</a>
                        <a href="#" class="btn btn-pill btn-transparent btn-transparent-faded-blue">Faded Blue</a>
                    </p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Button Sizes
                </header>
                <div class="widget-body">
                    <p>Varello provides you with a fifth, XL button along with the default four that come with bootstrap</p>
                    <p>
                        <a href="#" class="btn btn-xl btn-default">Extra Large Button</a>
                        <a href="#" class="btn btn-xl btn-white">Extra Large Button</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-lg btn-primary">Large Button</a>
                        <a href="#" class="btn btn-lg btn-white">Large Button</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-success">Standard Button</a>
                        <a href="#" class="btn btn-white">Standard Button</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-sm btn-warning">Small Button</a>
                        <a href="#" class="btn btn-sm btn-white">Small Button</a>
                    </p>
                    <p>
                        <a href="#" class="btn btn-xs btn-danger">Extra Small Button</a>
                        <a href="#" class="btn btn-xs btn-white">Extra Small Button</a>
                    </p>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Button Toolbar
                </header>
                <div class="widget-body">
                    <p>Group collections of buttons together to make a toolbar-esque element flow</p>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group btn-group-lg" role="group" aria-label="First group">
                            <button type="button" class="btn btn-default">1</button>
                            <button type="button" class="btn btn-default">2</button>
                            <button type="button" class="btn btn-default">3</button>
                            <button type="button" class="btn btn-default">4</button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="Second group">
                            <button type="button" class="btn btn-primary">5</button>
                            <button type="button" class="btn btn-primary">6</button>
                            <button type="button" class="btn btn-primary">7</button>
                        </div>
                        <div class="btn-group btn-group-lg" role="group" aria-label="Third group">
                            <button type="button" class="btn btn-success"><span class="fa fa-copy"></span></button>
                            <button type="button" class="btn btn-success"><span class="fa fa-paste"></span></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget widget-default">
                <header class="widget-header">
                    Button Dropdowns
                </header>
                <div class="widget-body">
                    <p>When you need to place a dropdown within the flow of the content, use a button dropdown</p>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>


                <div class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                </ul>
            </div>


            <div class="btn-group">
              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="widget widget-default">
    <header class="widget-header">
        Split-Button Dropdowns
    </header>
    <div class="widget-body">
        <p>When you want to use a button dropdown, but want the main text to cause a different action than the caret (<span class="fa fa-caret"></span>), then use a split-button dropdown.</p>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </div>
    <div class="btn-group">
      <button type="button" class="btn btn-primary">Action</button>
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="caret"></span>
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-success">Action</button>
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
</button>
<ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
</ul>
</div>
</div>
</div>
<div class="widget widget-default">
    <header class="widget-header">
        Button Dropdown Sizes
    </header>
    <div class="widget-body">
        <p>Like normal buttons, there are 5 variants that come with Varello</p>
        <div class="btn-group">
          <button class="btn btn-default btn-xl dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Extra Large button <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
        </ul>
    </div>

    <div class="btn-group">
      <button class="btn btn-primary btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Large button <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="#">Action</a></li>
        <li><a href="#">Another action</a></li>
        <li><a href="#">Something else here</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">Separated link</a></li>
    </ul>
</div>

<div class="btn-group">
  <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Default button <span class="caret"></span>
</button>
<ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
</ul>
</div>

<div class="btn-group">
  <button class="btn btn-warning btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Small button <span class="caret"></span>
</button>
<ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
</ul>
</div>

<div class="btn-group">
  <button class="btn btn-danger btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Extra small button <span class="caret"></span>
</button>
<ul class="dropdown-menu">
    <li><a href="#">Action</a></li>
    <li><a href="#">Another action</a></li>
    <li><a href="#">Something else here</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#">Separated link</a></li>
</ul>
</div>
</div>
</div>
<div class="widget widget-default">
    <header class="widget-header">
        Button Dropups
    </header>
    <div class="widget-body">
        <p>To make a dropdown open from the top, use the <code>.dropup</code> class on the button group</p>
        <div class="btn-toolbar" role="toolbar"> <div class="btn-group dropup"> <button type="button" class="btn btn-default">Dropup</button> <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> <ul class="dropdown-menu"> <li><a href="#">Action</a></li> <li><a href="#">Another action</a></li> <li><a href="#">Something else here</a></li> <li role="separator" class="divider"></li> <li><a href="#">Separated link</a></li> </ul> </div> <div class="btn-group dropup"> <button type="button" class="btn btn-primary">Right dropup</button> <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> <ul class="dropdown-menu dropdown-menu-right"> <li><a href="#">Action</a></li> <li><a href="#">Another action</a></li> <li><a href="#">Something else here</a></li> <li role="separator" class="divider"></li> <li><a href="#">Separated link</a></li> </ul> </div> </div>
    </div>
</div>


</div>
<div class="col-xs-12 col-md-6">
    <div class="widget widget-default">
        <header class="widget-header">
            Block Level Buttons
        </header>
        <div class="widget-body">
            <p>Make buttons span the entire width of their containing element</p>
            <p>
                <a href="#" class="btn btn-block btn-default">Block Level Button</a>
                <a href="#" class="btn btn-block btn-primary">Block Level Button</a>
                <a href="#" class="btn btn-block btn-success">Block Level Button</a>
                <a href="#" class="btn btn-block btn-info">Block Level Button</a>
            </p>
            <p>These also work as pills, and with all the size variants</p>
            <p>
                <a href="#" class="btn btn-xl btn-pill btn-block btn-warning">Extra Large Button</a>
                <a href="#" class="btn btn-lg btn-pill btn-block btn-danger">Large Button</a>
                <a href="#" class="btn btn-pill btn-block btn-purple">Default Button</a>
                <a href="#" class="btn btn-sm btn-pill btn-block btn-pink">Small Button</a>
                <a href="#" class="btn btn-xs btn-pill btn-block btn-faded-blue">Extra Small Button</a>
            </p>
        </div>
    </div>
    <div class="widget widget-default">
        <header class="widget-header">
            Disabled State
        </header>
        <div class="widget-body">
            <p>The disabled state can be applied through a <code>.disabled</code> class or the disabled property on buttons</p>
            <a href="#" class="btn disabled btn-default">Default</a>
            <a href="#" class="btn disabled btn-white">White</a>
            <a href="#" class="btn disabled btn-primary">Primary</a>
            <a href="#" class="btn disabled btn-success">Success</a>
            <a href="#" class="btn disabled btn-info">Info</a>
            <a href="#" class="btn disabled btn-warning">Warning</a>
            <a href="#" class="btn disabled btn-danger">Danger</a>
            <a href="#" class="btn disabled btn-purple">Purple</a>
            <a href="#" class="btn disabled btn-pink">Pink</a>
            <a href="#" class="btn disabled btn-faded-blue">Faded Blue</a>
            <a href="#" class="btn disabled btn-link">Link</a>
        </div>
    </div>
    <div class="widget widget-default">
        <header class="widget-header">
            Active State
        </header>
        <div class="widget-body">
            <p>Like the disabled state, the active state can be applied like so</p>
            <a href="#" class="btn active btn-default">Default</a>
            <a href="#" class="btn active btn-white">White</a>
            <a href="#" class="btn active btn-primary">Primary</a>
            <a href="#" class="btn active btn-success">Success</a>
            <a href="#" class="btn active btn-info">Info</a>
            <a href="#" class="btn active btn-warning">Warning</a>
            <a href="#" class="btn active btn-danger">Danger</a>
            <a href="#" class="btn active btn-purple">Purple</a>
            <a href="#" class="btn active btn-pink">Pink</a>
            <a href="#" class="btn active btn-faded-blue">Faded Blue</a>
            <a href="#" class="btn active btn-link">Link</a>
        </div>
    </div>
    <div class="widget widget-default">
        <header class="widget-header">
            Button Groups
        </header>
        <div class="widget-body">
            <p class="help-text">If buttons have related functionality, they can be placed in a button group like so, with 4 different size variations</p>
            <span class="h5">Large</span>
            <div class="btn-group btn-group-lg">
                <a href="#" class="btn btn-default"><span class="fa fa-copy"></span> Copy</a>
                <a href="#" class="btn btn-default"><span class="fa fa-paste"></span> Paste</a>
                <a href="#" class="btn btn-default"><span class="fa fa-align-left"></span> Left</a>
                <a href="#" class="btn btn-default"><span class="fa fa-align-center"></span> Center</a>
                <a href="#" class="btn btn-default">Right <span class="fa fa-align-right"></span></a>
            </div>
            <span class="h5">Default</span>
            <div class="btn-group">
                <a href="#" class="btn btn-primary"><span class="fa fa-copy"></span> Copy</a>
                <a href="#" class="btn btn-primary"><span class="fa fa-paste"></span> Paste</a>
                <a href="#" class="btn btn-primary"><span class="fa fa-align-left"></span> Left</a>
                <a href="#" class="btn btn-primary"><span class="fa fa-align-center"></span> Center</a>
                <a href="#" class="btn btn-primary">Right <span class="fa fa-align-right"></span></a>
            </div>
            <span class="h5">Small</span>
            <div class="btn-group btn-group-sm">
                <a href="#" class="btn btn-success"><span class="fa fa-copy"></span> Copy</a>
                <a href="#" class="btn btn-success"><span class="fa fa-paste"></span> Paste</a>
                <a href="#" class="btn btn-success"><span class="fa fa-align-left"></span> Left</a>
                <a href="#" class="btn btn-success"><span class="fa fa-align-center"></span> Center</a>
                <a href="#" class="btn btn-success">Right <span class="fa fa-align-right"></span></a>
            </div>
            <span class="h5">Extra Small</span>
            <div class="btn-group btn-group-xs">
                <a href="#" class="btn btn-info"><span class="fa fa-copy"></span> Copy</a>
                <a href="#" class="btn btn-info"><span class="fa fa-paste"></span> Paste</a>
                <a href="#" class="btn btn-info"><span class="fa fa-align-left"></span> Left</a>
                <a href="#" class="btn btn-info"><span class="fa fa-align-center"></span> Center</a>
                <a href="#" class="btn btn-info">Right <span class="fa fa-align-right"></span></a>
            </div>
        </div>
    </div>
    <div class="widget widget-default">
        <header class="widget-header">
            Button Group Nesting &amp; Mixing Colours
        </header>
        <div class="widget-body">
            <p>Place a button group inside another one when you want a dropdown menu nested within them.</p>
            <div class="btn-group btn-group-lg" role="group" aria-label="...">
              <button type="button" class="btn btn-default">1</button>
              <button type="button" class="btn btn-default">2</button>

              <div class="btn-group btn-group-lg" role="group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                  <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                  <li><a href="#">Dropdown link</a></li>
                  <li><a href="#">Dropdown link</a></li>
              </ul>
          </div>
      </div>
  </div>
</div>

<div class="widget widget-default">
    <header class="widget-header">
        Vertical Button Groups
    </header>
    <div class="widget-body">
        <p>The vertical button group variant comes with Bootstrap</p>
        <div class="btn-group-vertical" role="group" aria-label="Vertical button group"> <button type="button" class="btn btn-default">Button</button> <button type="button" class="btn btn-default">Button</button> <div class="btn-group" role="group"> <button id="btnGroupVerticalDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown <span class="caret"></span> </button> <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1"> <li><a href="#">Dropdown link</a></li> <li><a href="#">Dropdown link</a></li> </ul> </div> <div class="btn-group" role="group"> <button id="btnGroupVerticalDrop2" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown <span class="caret"></span> </button> <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop2"> <li><a href="#">Dropdown link</a></li> <li><a href="#">Dropdown link</a></li> </ul> </div> <div class="btn-group" role="group"> <button id="btnGroupVerticalDrop3" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown <span class="caret"></span> </button> <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop3"> <li><a href="#">Dropdown link</a></li> <li><a href="#">Dropdown link</a></li> </ul> </div> <div class="btn-group" role="group"> <button id="btnGroupVerticalDrop4" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Dropdown <span class="caret"></span> </button> <ul class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop4"> <li><a href="#">Dropdown link</a></li> <li><a href="#">Dropdown link</a></li> </ul> </div> </div>
    </div>
</div>

<div class="widget widget-default">
    <header class="widget-header">
        Justified Button Groups
    </header>
    <div class="widget-body">
        <p>Make a button group span the entire width of it's containing element</p>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Left</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Middle</button>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-default">Right</button>
        </div>
    </div>
</div>
</div>


</div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="widget widget-default">
            <header class="widget-header">
                Faded Buttons
            </header>
            <div class="widget-body">
                <p>The <code>.btn-faded</code> class allows you to keep a button active but have it faded-out until the user hovers over it.</p>
                <p>
                    <a href="#" class="btn btn-faded btn-default">Default</a>
                    <a href="#" class="btn btn-faded btn-white">White</a>
                    <a href="#" class="btn btn-faded btn-primary">Primary</a>
                    <a href="#" class="btn btn-faded btn-success">Success</a>
                    <a href="#" class="btn btn-faded btn-info">Info</a>
                    <a href="#" class="btn btn-faded btn-warning">Warning</a>
                    <a href="#" class="btn btn-faded btn-danger">Danger</a>
                    <a href="#" class="btn btn-faded btn-purple">Purple</a>
                    <a href="#" class="btn btn-faded btn-pink">Pink</a>
                    <a href="#" class="btn btn-faded btn-faded-blue">Faded Blue</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-default">Default</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-white">White</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-primary">Primary</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-success">Success</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-info">Info</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-warning">Warning</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-danger">Danger</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-purple">Purple</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-pink">Pink</a>
                    <a href="#" class="btn btn-faded btn-transparent btn-transparent-faded-blue">Faded Blue</a>
                </p>
                <p>
                    <a href="#" class="btn btn-pill btn-faded btn-default">Default</a>
                    <a href="#" class="btn btn-pill btn-faded btn-white">White</a>
                    <a href="#" class="btn btn-pill btn-faded btn-primary">Primary</a>
                    <a href="#" class="btn btn-pill btn-faded btn-success">Success</a>
                    <a href="#" class="btn btn-pill btn-faded btn-info">Info</a>
                    <a href="#" class="btn btn-pill btn-faded btn-warning">Warning</a>
                    <a href="#" class="btn btn-pill btn-faded btn-danger">Danger</a>
                    <a href="#" class="btn btn-pill btn-faded btn-purple">Purple</a>
                    <a href="#" class="btn btn-pill btn-faded btn-pink">Pink</a>
                    <a href="#" class="btn btn-pill btn-faded btn-faded-blue">Faded Blue</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-default">Default</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-white">White</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-primary">Primary</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-success">Success</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-info">Info</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-warning">Warning</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-danger">Danger</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-purple">Purple</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-pink">Pink</a>
                    <a href="#" class="btn btn-pill btn-faded btn-transparent btn-transparent-faded-blue">Faded Blue</a>
                </p>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.footer')
<!-- END CONTAINER -->
</div>
@endsection