<?php
session_start();
include('config.php');

if (!empty($_SESSION['uid'])) {
	$uid = $_SESSION['uid'];
	$udept = $_SESSION['udept'];
	header("Location: main.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<title><?= $app_name; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="./assets/css/vendor.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/flat-admin.css">

	<!-- Theme -->
	<link rel="stylesheet" type="text/css" href="./assets/css/theme/blue-sky.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/theme/blue.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/theme/red.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/theme/yellow.css">

</head>

<body>
	<div class="app app-default">

		<div class="app-container app-login">

			<div class="flex-center">
				<div class="app-header"></div>
				<div class="app-body">

					<div class="app-block">
						<div class="app-form">
							<div class="form-header">
								<div class="app-brand">
									<span class="highlight">Simple</span>
									POS
									<p id='local_ip' style='text-align: center;font-size: medium;'></p>
								</div>

							</div>
							<form action="/" method="POST">
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon1">
										<i class="fa fa-user" aria-hidden="true"></i></span>
									<input type="text" id='uname' class="form-control" placeholder="Username" aria-describedby="basic-addon1">
								</div>
								<div class="input-group">
									<span class="input-group-addon" id="basic-addon2">
										<i class="fa fa-key" aria-hidden="true"></i></span>
									<input type="password" id='upass' class="form-control" placeholder="Password" aria-describedby="basic-addon2">
								</div>
								<div id='login_button' class="text-center">
									<input type="btn" id='logmein' class="btn btn-success btn-submit" value="Login">
								</div>

								<div class="progress" id='login_progress' style='display: none'>
									<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
										Authenticating...Please wait!
									</div>
								</div>
								<div class="alert alert-danger fade in" id='login_error' style='display: none'>
									<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									<strong>Error : </strong> <span id='login_error_val'>Login Failed!.</span>
								</div>
							</form>

							<hr />

							<div style="text-align: center">
								Don't have an account? | Forgot Password? <br />
								<a href="https://knowledgebase.nosystems.online/index.php?a=add" onClick=""> Contact Support</a>
							</div>



						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

	<script type="text/javascript" src="./assets/js/vendor.js"></script>
	<script type="text/javascript" src="./assets/js/app.js"></script>

	<script>
		$(".app").removeClass("app-blue-sky").removeClass("app-yellow").removeClass("app-red").removeClass("app-green").removeClass("app-default").addClass("app-yellow");
		$("#login_progress, #login_error").hide();
		/*$("#login_error").fadeTo(10000,0.01,function(){
			$(this).hide();
		});*/
		$(document).ready(function() {

			$("#uname").focus();

			$("#uname,#upass").keypress(function(e) {
				if (e.which === 13) {
					$("#logmein").trigger('click');
				}
			});
			$("#logmein").click(function() {

				var u = $("#uname").val();
				var p = $("#upass").val();
				var local_ip = $("#local_ip").text();

				if (u && p) {
					$(this).hide();
					$("#uname, #upass").attr('disabled', 'disabled');
					$("#login_progress").show();
					$.post("auth.php", {
						uname: u,
						upass: p,
						local_ip: local_ip
					}, function(data) {
						if (data.indexOf("error:|") > -1) {
							$("#uname, #upass").val("");
							$("#uname, #upass").removeAttr('disabled');
							$("#login_progress").hide();
							$("#logmein").show();
							$("#uname").focus().select();
							$("#login_error_val").text("Login Failed!, Try Again.");
							$("#login_error").stop(true, true).show().delay(5000).fadeOut("slow");
						} else {
							var udept = data.split(":|:")[0];
							var uaccess = data.split(":|:")[1];

							window.location = "main.php";

						}
					});
				} else {
					$("#uname").focus().select();
					$("#login_error").stop(true, true).show().delay(5000).fadeOut("slow");
				}
			});

			// NOTE: window.RTCPeerConnection is "not a constructor" in FF22/23
			var RTCPeerConnection = /*window.RTCPeerConnection ||*/ window.webkitRTCPeerConnection || window.mozRTCPeerConnection;

			if (RTCPeerConnection)(function() {
				var rtc = new RTCPeerConnection({
					iceServers: []
				});
				if (1 || window.mozRTCPeerConnection) { // FF [and now Chrome!] needs a channel/stream to proceed
					rtc.createDataChannel('', {
						reliable: false
					});
				};

				rtc.onicecandidate = function(evt) {
					// convert the candidate to SDP so we can run it through our general parser
					// see https://twitter.com/lancestout/status/525796175425720320 for details
					if (evt.candidate) grepSDP("a=" + evt.candidate.candidate);
				};
				rtc.createOffer(function(offerDesc) {
					grepSDP(offerDesc.sdp);
					rtc.setLocalDescription(offerDesc);
				}, function(e) {
					console.warn("offer failed", e);
				});


				var addrs = Object.create(null);
				addrs["0.0.0.0"] = false;

				function updateDisplay(newAddr) {
					if (newAddr in addrs) return;
					else addrs[newAddr] = true;
					var displayAddrs = Object.keys(addrs).filter(function(k) {
						return addrs[k];
					});
					//document.getElementById('local_ip').val(displayAddrs.join(" or perhaps ") || "n/a");
					document.getElementById('local_ip').textContent = displayAddrs.join(" or perhaps ") || "n/a";
				}

				function grepSDP(sdp) {
					var hosts = [];
					sdp.split('\r\n').forEach(function(line) { // c.f. http://tools.ietf.org/html/rfc4566#page-39
						if (~line.indexOf("a=candidate")) { // http://tools.ietf.org/html/rfc4566#section-5.13
							var parts = line.split(' '), // http://tools.ietf.org/html/rfc5245#section-15.1
								addr = parts[4],
								type = parts[7];
							if (type === 'host') updateDisplay(addr);
						} else if (~line.indexOf("c=")) { // http://tools.ietf.org/html/rfc4566#section-5.7
							var parts = line.split(' '),
								addr = parts[2];
							updateDisplay(addr);
						}
					});
				}
			})();
			else {
				//document.getElementById('local_ip').innerHTML = "<code>ifconfig | grep inet | grep -v inet6 | cut -d\" \" -f2 | tail -n1</code>";
				//document.getElementById('local_ip').nextSibling.textContent = "In Chrome and Firefox your IP should display automatically, by the power of WebRTCskull.";
			}
		});
	</script>

</body>

</html>