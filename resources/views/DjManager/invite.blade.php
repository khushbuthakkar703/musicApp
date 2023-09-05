@extends('layouts.djmanager')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-9">
            <div class="panel">
                <div class="panel-body">
                    <div class="container">
                        <form class="form-horizontal" method="POST" action="{{ route('bulkinvite') }}">
                            {{ csrf_field() }}
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <textarea name="emails" rows="30" class="form-control" id="email" placeholder="Copy / Paste Emails On Seperate Lines" type="email" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-transparent btn-transparent-primary" style="font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;" value="&#xf064 Send invites">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="title"><span class="fa fa-lightbulb-o"></span> Need Help?</h4>
                </div>
                <div class="panel-body">
                    <p>When composing a message, you can use all the provided <strong>formatting tools</strong> above the text area to change the styling of your message</p>
                    <p>You can send a message to multiple people, but be aware that, unless you put them in the <strong>bcc section</strong>, their profile will be shown to other users in the application.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">
            <input id="myInput" class="form-control" type="text" value="https://spinstatz.net/dj-signups?manager={{Auth::id()}}">
        </div>
        <div class="form-group margin-top-15">
            <div class="col-sm-10 col-xs-12">
                <button onclick="myFunction()" class="btn btn-transparent">Copy text</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementsByClassName("invite")[0].classList.add('active');
    document.getElementsByClassName("messaging")[0].classList.add('active'); 


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
@endsection