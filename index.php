<!DOCTYPE html>
<html lang='ja'>
	<head>
		<meta charset='UTF-8'>
		<title>tCt-Home </title>
		<link rel='stylesheet' href='css/bootstrap-reboot.min.css'>
		<link rel='stylesheet' href='css/bootstrap.min.css'>
		<link rel='stylesheet' href='css/menu.css'>
		<link rel='stylesheet' href='css/locomotive-scroll.min.css'>
		<style>
			[data-scroll-class='fade-in'] {
				opacity: 0;
				visibility: hidden;
				transform: translateY(100px);
				transition: opacity 2s, transform 2s;
			}

			[data-scroll-class='fade-in'].fade-in {
				opacity: 1;
				visibility: visible;
				transform: translateY(0px);
			}

			[data-scroll-class='fade-inr'] {
				opacity: 0;
				visibility: hidden;
				transform: translateX(100vw);
				transition: opacity 2s, transform 2s;
			}

			[data-scroll-class='fade-inr'].fade-inr {
				opacity: 1;
				visibility: visible;
				transform: translateX(0px);
			}
			[data-scroll-class='fade-inl'] {
				opacity: 0;
				visibility: hidden;
				right: 200vw;
				transition: opacity 2s, right 2s;
			}

			[data-scroll-class='fade-inl'].fade-inl {
				opacity: 1;
				visibility: visible;
				right: 0;
			}

			.each-span-ib {
				margin-top: 50px;
			}

			.each-span-ib span {
				display: inline-block;
			}
			.space{
			    height:20vh;
			}
			#element2{
			    height: 100vh;
			}
			#element2::before{
		        content: '';
                position: absolute;
                top: 20vh;
                width:100vw;
                height:100vh;
                background-color: #F18A48;
                transform: skewY(-7deg);
                z-index: -1;
			}
			#back-deg{
			    width: 100vw;
			    height: 100vh;
			    position: absolute;
                background-color: #357F94;
                transform: translateY(20vh) skewY(7deg);
                z-index: -2;
			}
			#swtich{
			    width:4vw;
			}
			.c-scrollbar{
			    z-index:100000;
			}
		</style>
		<style>
		    body.dark #back-deg{
		        background-color: #F18A48;
		    }
		    body.dark #element2::before{
		        background-color: #357F94;
		    }
		</style>
	</head>
	<body>
		<div class='navigation-wrap bg-light start-header start-style'>
			<div class='container'>
				<div class='row'>
					<div class='col-12'>
						<nav class='navbar navbar-expand-md navbar-light'>
							<a class='navbar-brand' href='/'>
								<!--<img src='https://assets.codepen.io/1462889/fcy.png' alt=''>-->
								<h1 class="m-0">tCt</h1>
							</a>
							<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
								<span class='navbar-toggler-icon'></span>
							</button>
							<div class='collapse navbar-collapse' id='navbarSupportedContent'>
								<ul class='navbar-nav ml-auto py-4 py-md-0'>
									<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4 active'>
										<a class='nav-link' href='#top' data-scroll-to>Home</a>
									</li>
									<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4'>
										<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Calender </a>
										<div class='dropdown-menu'>
											<a class='dropdown-item' href='#'>Today</a>
											<a class='dropdown-item' href='#'>Week</a>
											<a class='dropdown-item' href='#'>Month</a>
										</div>
									</li>
									    
<?php if(isset($_COOKIE["name"])){echo "
										<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4'>
											<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Account</a>
											<div class='dropdown-menu'>
												<p class='dropdown-item'>
													<img src='".$_COOKIE["img"]."' style='height: 20px;'>".$_COOKIE["name"]."</p>
													<a class='dropdown-item' href='/'>settings</a>
													<a class='dropdown-item' href='/subscribe'>Notifaction</a>
													<a class='dropdown-item' href='/calender'>Todo</a>
												</div>
											</li>
";}
else{include('settings/login_config.php');echo "
											<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4'>
												<a class='nav-link' href='".$google_client->createAuthUrl()."' data-scroll-to>Login</a>
											</li>
";}?>                               <li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4'>
                                        <button onclick='changemode()' class='btn btn-sm btn-outline-dark' id='swtich'>DARK</button>
                                    </li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div data-scroll-container>
			<div id='top' class='mx-auto text-center' style='height: 100vh;'>
				<div id='direction' style='height:35vh;'></div>
				<h1 class='display-4 my-5' data-scroll data-scroll data-scroll-delay='0.1' data-scroll-speed='2'>tclb Classroom todo </h1>
				<div id='targrt'>
					<div class='my-5 position-sticky' data-scroll data-scroll-direction='horizontal' data-scroll-speed='-10' data-scroll data-scroll-delay='0.05' data-scroll-position='top'>
						<p class='lead m-auto'>リード文がここに書かれるってま？ <br>二行目を試しに書いてみたあと <br>三行目を書くのがいいのだ！ </p>
					</div>
				</div>
				<a href='#element2' class='btn btn-lg btn-secondary my-5 shadow' data-scroll data-scroll data-scroll-delay='0.2' data-scroll-position='top' data-scroll-to>More </a>
			</div>
			<div class="space" ></div>
			<div>
    		    <div id='back-deg' data-scroll data-scroll-repeat data-scroll-offset='0,-50%' data-scroll-class='fade-inl'></div>
    			<div class="" id='element2' data-scroll data-scroll-repeat data-scroll-offset='0,-50%' data-scroll-class='fade-inr'>
    			    <div class="space" ></div>
    				<div class='display-4 ml-5 each-span-ib' style='margin-top:20vh;' data-scroll data-scroll-repeat data-scroll-class='fade-in'>What the tCt? </span></div>
    			</div>
			</div>
			<div style='height:200vh;'></div>
		</div>
		<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script>
		<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
		<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js' integrity='sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI' crossorigin='anonymous'></script>
		<script src='js/menu.js'></script>
		<script src='js/locomotive-scroll.min.js'></script>
		<script>
			$(".each-span-ib").each(function(index, element) {
				let text = $(element).text();
				let texted = "";
				for (var i = 0; i < text.length; i++) {
					if (text[i] == ' ') {
						texted += " ";
					} else {
						texted += "<span data-scroll data-scroll-repeat data-scroll-speed='6' data-scroll-delay='"+(text.length-i)/10+"'>"+text[i]+"</span>";
					}
				}
				$(element).html(texted);
			});
			const scroll = new LocomotiveScroll({
				el: document.querySelector('[data-scroll-container]'),
				smooth: true
			});
			const arrayOfColors = ['#0a9396', '#005f73', '#ae2012', '#3d405b', '#003049', '#bc6c25', '#ff006e', '#ef476f', '#1982c4', '#ee964b', '#0ead69', '#390099', '#f6aa1c', '#54101d', '#2b2c28', '#85c7f2', '#e15a97', '#2b70e3', '#b36a5e'];

			function getRandomColor() {
				const arrayLength = arrayOfColors.length;
				const randomValue = Math.random() * arrayLength;
				const roundedNumber = Math.floor(randomValue);
				const color = arrayOfColors[roundedNumber];
				return color;
			}
			scroll.on('call', (value, way, obj) => {
				if (value === 'randomcolor') {
					if (way === 'enter') {
						obj.el.style.color = getRandomColor();
					}
				}
			});
			let header = $(".start-style");
			scroll.on('scroll', ({
				limit,
				scroll
			}) => {
				const progress = scroll.y;
				if (scroll.y >= 400) {
					header.removeClass('start-style').addClass("scroll-on");
				} else {
					header.removeClass("scroll-on").addClass('start-style');
				}
			});
		</script>
		<script>
			function changemode() {
				if ($('body').hasClass('dark')) {
					$('body').removeClass('dark');
					$('#swtich').text('DARK').removeClass('btn-outline-light').addClass('btn-outline-dark')
				} else {
					$('body').addClass('dark');
					$('#swtich').text('LIGHT').removeClass('btn-outline-dark').addClass('btn-outline-light')
				}
			}
		</script>
	</body>