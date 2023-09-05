@extends($layout)
@section('content')
<title>SpinStatz | Invite Campaign</title>
<div class="container-fluid">
	<b>
		<li>Money will be added to DJ Wallet for every artist who signs up using your link</li>
	</b>
	<br>

	<div class="row">
		<div class="col-xs-12 col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					Refferal Link
				</div>
				<div class="panel-body">
					<input type="text" class="form-control" value="https://spinstatz.net/campaign/create?refer={{Auth::id()}}" id="myInput">

					<!-- The button used to copy the text -->
					<div class="form-group margin-top-15">
						<div class="col-sm-10 col-xs-12">
							<button onclick="myFunction()" class="btn btn-transparent">Copy text</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					Invite Campaign
				</div>
				<div class="panel-body">
					<form method="post" action="{{route('invitecampaign')}}">
						<div class="form-group margin-top-15">
							<label class="col-sm-2 col-xs-12 control-label">Email</label>
							<div class="col-sm-10 col-xs-12">
								<input type="email" class="form-control" placeholder="user@email.com" name="email" required>
	                        </div>
	                    </div>

	                    

	                    <div class="form-group margin-top-15">
							<div class="col-sm-10 col-xs-12">
								<input type="submit" class="btn btn-transparent btn-transparent-primary" value="Invite">
	                        </div>
	                    </div>
	                </form>    

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function myFunction() {
	  /* Get the text field */
	  var copyText = document.getElementById("myInput");

	  /* Select the text field */
	  copyText.select();

	  /* Copy the text inside the text field */
	  document.execCommand("copy");

	  /* Alert the copied text */
	  alert("Copied the text: " + copyText.value);
	} 
</script>
<style type="text/css">
	.tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
@endsection
