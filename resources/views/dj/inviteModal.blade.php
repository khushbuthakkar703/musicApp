<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en-US" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en-US" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en-US" prefix="og: http://ogp.me/ns#"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en-US" prefix="og: http://ogp.me/ns#"> <!--<![endif]-->
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="UTF-8">

	<!-- Mobile Specific Metas
  ================================================== -->

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

<title>DJ Signups | Spinstatz</title>

<!-- This site is optimized with the Yoast SEO plugin v7.4.2 - https://yoast.com/wordpress/plugins/seo/ -->
<link rel="canonical" href="https://spinstatz.com/dj-signups" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="article" />
<meta property="og:title" content="DJ Signups | Spinstatz" />
<meta property="og:url" content="https://spinstatz.com/dj-signups" />
<meta property="og:site_name" content="Spinstatz" />

<meta property="og:description" content="SpinStatz was created to help DJs do what they love on a fulltime basis. With our platform verified club DJs, internet radio DJs, and live event DJs are now capable of earning up to $2,000 per night simply playing music" />
<meta property="article:publisher" content="http://facebook.com/spinstatz" />
<meta property="fb:app_id" content="1476167555843900" />
<meta property="og:image" content="https://spinstatz.net/earn.jpg" />
<meta property="og:image:secure_url" content="https://spinstatz.net/earn.jpg" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="DJ Signups | Spinstatz" />
<meta name="twitter:image" content="https://spinstatz.net/share.jpg" />

{{----}}
<link rel='stylesheet' id='font-awesome-css'  href='https://spinstatz.com/wp-content/themes/ninezeroseven/assets/css/font-icons/font-awesome/css/font-awesome.min.css?ver=4.9.5' type='text/css' media='all' />
<link rel='stylesheet' id='wbc907-animated-css'  href='https://spinstatz.com/wp-content/themes/ninezeroseven/assets/css/animate.min.css?ver=4.9.5' type='text/css' media='all' />
<link rel='stylesheet' id='theme-styles-css'  href='https://spinstatz.com/wp-content/themes/ninezeroseven/assets/css/theme-styles.css?ver=4.9.5' type='text/css' media='all' />
<link rel='stylesheet' id='theme-features-css'  href='https://spinstatz.com/wp-content/themes/ninezeroseven/assets/css/theme-features.css?ver=4.9.5' type='text/css' media='all' />
{{--<link rel='stylesheet' id='style-css'  href='https://spinstatz.com/wp-content/themes/ninezeroseven/style.css?ver=4.9.5' type='text/css' media='all' />--}}

</head>

<body class="" style="height: min-content">



				<center style="margin-top: 10px">
					<span style="color: white;font-size: large">Request Your DJ Invitation Email</span>

					<div class="col-md-4" style="width: 95%">
					<div class="">
						<div class="" data-css="tve-u-160f32ae4de">
							<input type="email" id="email" data-field="email" data-required="1" data-validation="email" name="email" placeholder="email*" data-placeholder="email*" class="" style="">
						</div>
						<input type="hidden" name="manager" id="manager" value="{{$manager}}">
					</div>
				</div>
				<div class="col-md-2" data-css="" style="">
					<div class="">
						<div class="" data-css="tve-u-15ddfec8667">
							<input type="button" class="tve-froala" value="Submit" onclick="signup()" />
						</div>
						<style type="text/css">
							.tve-froala{  background-color: #000000;
								border: none;
								color: white;
								padding: 15px 32px;
								text-align: center;
								text-decoration: none;
								display: inline-block;
								font-size: 16px;
								margin: 4px 2px;
								cursor: pointer;
							}
						</style>

						<script type="text/javascript">
							function signup() {
								console.log("called")
								manager = document.getElementById('manager').value
								var xmlhttp = new XMLHttpRequest();
								var email = document.getElementById("email").value
								console.log(email)
								var url = "/selfinvitemail?email="+email+"&manager="+manager


								xmlhttp.onreadystatechange = function() {
								    if (this.readyState == 4 && this.status == 200) {
								        var myArr = JSON.parse(this.responseText);
								        if(myArr.status == 'ok'){
								        	alert("success")
								        }
								    }
								};
								xmlhttp.open("GET", url, true);
								xmlhttp.send();
							}

							</script>
					</div>
				</div>
				</center>
</body>
</html>
