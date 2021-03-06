<?php
include "./config/config.php";
include "./config/connect.php";
include "./config/query.php";
?>
<!DOCTYPE HTML>

<html>
	<head>
		<title>Home Page</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/ajax.js"></script>
		
  
  
  <script>

  </script>
		<noscript>
			
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
	</head>
	<body id="top">

		<!-- Header -->
			<header id="header" class="skel-layers-fixed">
				<h1><a href="index.php">SanoManchester</a></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="map.php">Healthy Manchester Map</a></li>
						<li><a href="faq.php">FAQ</a></li>
						<li><a href="contact.php">Contact</a></li>
						
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h2>SANOMANCHESTER</h2>
					<p>Health is the real wealth </p>
					<ul class="actions">
					<?php 
					if ( isset($_SESSION["sn_idx"]) ) {?>
						<li><span href="#" class="button big special" id="toggle-login" onclick="javascript:location.href='./myprofile.php';">Go to Myprofile</span></li>
					<?php
					} else {?>
						<li><span href="#" class="button big special" id="toggle-login">Log in</span> <div id="login">
							<div id="triangle"></div>
							<h1>Log in</h1>
							<form name='frm_login' method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" onSubmit="javascript:login();return false;" >
							<input type="hidden" name="mode" value="login">
								<input type="email" name="email" placeholder="Email" />
								<input type="password" name="pass" placeholder="Password" />
								<input type="submit" value="Log in"/>
							</form>
							</div>
							<script src="js/index.js"></script>
						</li>
						<li><span href="#" class="button big special" id="toggle-signup">sign up</span>
						<div id="signup">
							<div id="triangle"></div>
								<h1>Sign up</h1>
								<form name='frm_regist' method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" onSubmit="javascript:regist();return false;">
								<input type="hidden" name="mode" value="regist">
									<ul>
										<li> <input type="text" placeholder="Name" name="rname" /> </li>
										<li> <input type="text" placeholder="Surname" name="surname" /> </li>
									</ul>
									<ul>
										<li> <input type="email" placeholder="Email" name="email" /> </li>
										<li> <select name="gender">
												<option value="">- GENDER -</option>
												<option value="0">Male</option>
												<option value="1">Female</option>
											     </select> </li> 
									</ul>
									<ul >
										<li> <input type="text" placeholder="Weight(Kg)" name="weight" /> </li>
										<li> <input type="text" placeholder="Height(cm)" name="height" /> </li>
									</ul>
									<ul>
										<li> <input type="password" placeholder="Password" name="pass1" /> </li>
										<li> <input type="password" placeholder="Confirm Password" name="pass2" /> </li>
									</ul>
									<br>
									<br>
									<input type="submit" value="Sign up" />										
								</form>
						</div>
						<script src="js/index2.js"></script>
						</li>
					<?php
					}?>
					</ul>
				</div>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<header class="major">
					<h2>Why SANOMANCHESTER?</h2>
				</header>
				<div id = "main">
					<div id="box">
						
						<img src="images/diet.jpg" width ="100%">
						<h3>PLAN YOUR DIET</h3>
						<p>Manage your diet in one convenient space with our calendar function. You can add food and exercises to your timetable and design your own weight loss strategy.</p>
					</div>
					<div id="box">
						<img src="images/work.jpg" width ="100%">
						<h3>LIVE HEALTHY</h3>
						<p>Find places to exercise a healthy lifestyle on our Healthy Manchester Map and suggestions. We aim to make it easy for you to take the initiative and change your habits.</p>
						</div>
					<div id="box">
						<img src="images/salad.jpg" width ="100%">
						<h3>MONITOR YOUR PROGRESS</h3>
						<p>Enter and update your weight to see your progress towards the target you set for yourself. Manage your calorie intake with our handy calorie calculator to know exactly how much you are eating.</p>
					</div>
		
				</div>
			</section>
			<?php include "./inc_footer.php"; ?>
			<script type="text/javascript">
				function login(){
					var email = document.frm_login.email.value;
					var pass = document.frm_login.pass.value;
					var mode = document.frm_login.mode.value;
					sendRequest(
						login_result, '&email='+ email + '&pass=' + pass + '&mode=' + mode,
						'POST',
						'./member.php', true, true
					);
				}

				function login_result(oj){
					var res = decodeURIComponent(oj.responseText);
					if ( res == "login_ok" ) {
						location.href="./myprofile.php";
					}else {
						alert(res);
						return false;
					}
				}

				function regist(){
					var email = document.frm_regist.email.value;
					var rname = document.frm_regist.rname.value;
					var surname = document.frm_regist.surname.value;
					var gender = document.frm_regist.gender.value;
					var weight = document.frm_regist.weight.value;
					var height = document.frm_regist.height.value;
					var pass1 = document.frm_regist.pass1.value;
					var pass2 = document.frm_regist.pass2.value;
					var mode = document.frm_regist.mode.value;
					sendRequest(
						regist_result, '&email='+ email + '&pass1=' + pass1 + '&pass2=' + pass2 + '&mode=' + mode + '&rname=' + rname + '&surname=' + surname + '&gender=' + gender + '&weight=' + weight + '&height=' + height + '&mode=' + mode,
						'POST',
						'./member.php', true, true
					);
				}

				function regist_result(oj){
					var res = decodeURIComponent(oj.responseText);

					if ( res == "regist_ok" ) {
						alert("Join successfully completed");
						location.href="./myprofile.php";
					}else {
						alert(res);
						return false;
					}
				}	
			</script>
	</body>
</html>
