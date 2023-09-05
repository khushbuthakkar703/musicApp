@extends('layouts.djapp')
@section('content')
    <title>SpinStatz | Edit</title>
    <div class="container-fluid">
	  <div> <a href="https://play.google.com/store/apps/details?id=com.mtecsoft.spinstatz&hl=en_US"><img src="/img/android.png" width="220" height="64" alt=""/></a>   &nbsp; &nbsp; &nbsp; <a href="https://apps.apple.com/us/app/spinstatz/id1458997474"><img src="/img/apple.png" width="220" height="64" alt=""/></a></div><br>
       <div class="row">
   	  <div class="widget widget-default widget-fluctuation col">
	    		<header class="widget-header">
	    			DOWNLOAD FOR WINDOWS
	    		</header>
	    		<div class="widget-body">
	    			<a href="/dj/download/app?type=windows" class="btn btn-default">Download</a>
	    		</div>
   	</div>
	    	<div class="widget widget-default widget-fluctuation col">
	    		<header class="widget-header">
	    			DOWNLOAD FOR MACS
	    		</header>
	    		<div class="widget-body">
	    			<div>
	    				<a  href="/dj/download/app?type=macs" class="btn btn-default">Download</a>
	    			</div>
	    		
		    		IMPORTANT!! Follow these steps to allow the software to install on Mac computers.
		    		<ol>
		    			<li >Go to system preferences</li>
		    			<li >Select &quot;Security and Privacy&quot;</li>
		    			<li >Click on the lock icon</li>
		    			<li >Under Allow apps downloaded from: select <strong>Anywhere</strong></li>
		    			<li >Select the lock button to store your changes</li>
		    		</ol>
	    		</div>
                
	    	</div>
      </div>
	    <div class="row">
	    	<div class="widget widget-default widget-fluctuation">
	    		<header class="widget-header">
	    			APP DEMO
	    		</header>
	    		<div class="widget-body">
	    			<iframe width="100%" height="500" src="https://www.youtube.com/embed/pDD36tS9m7Q" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
	    				
	    			</iframe>
	    		</div>
	    	</div>
	    </div>	    

</div>
	<script type="text/javascript">
		document.getElementsByClassName("download")[0].classList.add('active');
	</script>
@endsection    
