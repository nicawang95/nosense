<!DOCTYPE html>
<html>
<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> JR Viray Dental and Aesthetic Medicine </title>
		<link rel="stylesheet" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<section class="header">
		<nav>
			<a href="index.html"><img src=""></a>
			<div class="nav-links" id="navLinks">
				<i class="fa fa-times" onclick="hideMenu()"></i>
					<ul>
						<li><a href=""> HOME </a></li>
						<li><a href=""> ABOUT </a></li>
						<li><a href=""> SERVICES </a></li>
					</ul>
				
			</div>
			<i class="fa fa-bars" onclick="showMenu()"></i>
		
		</nav>
				
			
			<div class="text-box">
			<h1>JR Viray Dental Clinic and Aesthetic Medicine</h1>
			<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <br>deserunt mollit anim id est laborum."</p>
			<a href="" class="hero-btn">Book Appointment now </a>
			</div>
			
	</section>
			
			<!-----course------>
			
	<section class="course">

		<h1> Treatment We Offer</h1>
		<p> BLSLLSLSSLLSLSLSLLSLSLSLSLSLS</p><br>
			
		<div class="row">
			<div class="course-col">
			<h3> Braces</h3>
			<p>baabababababbabbababbababababba</p>
			</div>

			<div class="course-col">
			<h3> cleaning</h3>
			<p>baabababababbabbababbababababba</p>
			</div>

			<div class="course-col">
			<h3> pasta</h3>
			<p>baabababababbabbababbababababba</p>
			</div>

		</div>

	</section>

			
		<!------ Branch ------>
	<section class="Branch">
			
		
		<h1> Our Branches </h1>
		<p> bababababbababbabababa</p>
			
			<?php include("calendar.php");?>
		
	</section>
			
			<!------ Services ------->
			<section class="services">
			<h1> Our Services</h1>
			<p>lblblblblblblblblb</p>
			
			<div class="row">
			<div class="services-col">
			<img src="images/dentalimplant.png">
			<h3> Dental Implant</h3>
			<p> blblblblblblblb</p>
			</div>

			<div class="services-col">
				<img src="images/1.jpg">
				<h3> TMJ Treatment</h3>
				<p> blblblblblblblb</p>
				</div>

				<div class="services-col">
					<img src="images/veneers.jpg">
					<h3> veneers</h3>
					<p> blblblblblblblb</p>
					</div>
			</div>
			</section>
			
			<!------- Call To Action -------->
			
			<section class="cta">
			<h1> Have a Healty and Clean Teeth Now</h1>
			<a href="" class="hero-btn">CONTACT US</a>
			</section>
			
			<!------- Footer --------->
			
			<section class="footer">
			<h4> About Us</h4>
			<p> lblblblblblblblblbl</p>
			<div class="icon">
			<i class="fa fa-facebook"></i>
			<i class="fa fa-whatsapp"></i>
			<i class="fa fa-twitter"></i>
			</div>
			</section>
			
		
			
			
			
			
			
			
			
		<!------JavaScript for Toggle Menu-------->
			<script>
			
			var navLinks = document.getElementById("navLinks");
		
			function showMenu(){
						navLinks.style.right = "0";
			}
			function hideMenu(){
						navLinks.style.right = "-200px";
			}
			</script>
			
			
			
		
		</body>
		</html>