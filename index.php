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
			    z-index:1000;
			}
			#progress-bar {
              position: absolute;
              top: 0;
              left: 0;
              width: 0;
              height:0.4vh;
              background: #F18A48;
            }
            .modal-content{
                opacity: 0;
                transition: opacity 0.5s;
            }
            .modal.show .modal-content{
                opacity: 1;
            }
	</style>
	<style>
		body.dark #back-deg{
		        background-color: #F18A48;
		    }
		    body.dark #element2::before{
		        background-color: #357F94;
		    }
		    body.dark #progress-bar{
		        background: #357F94;
		    }
		    body.dark .modal-content{
		        background-color: #000;
		    }
		    body.dark .close{
		        color: #fff;
		    }
	</style>
	<style>
	    .loading {
	        position:fixed;
	        top:0;
	        bottom:0;
	        right:0;
	        left:0;
	        background:#fff;
	        z-index:10000;
	        opacity:1;
	    }
	    body.dark .loading{
	        background: #000;
	    }
	    .loadcon{
	        margin-top: 40vh;
	        width: 100vw;
	        height: 3vh;
	        z-index:10001;
	    }
	    .loadbar,.loadbar2{
	        position: absolute;
	        top: 50%;
	        bottom:49.5%;
	        width: 100vw;
	        background: #F18A48;
	        z-index:10005;
            opacity: 1;
	    }
	    .loadbar2 {
	        background: #357F94;
	    }
	    .loadbar.loaded {
	        animation: bar 1s ease forwards;
            top: 0;
            bottom: 99.5%;
            width: 0vw;
            opacity: 0;
	    }
	    
	    .loadbar2.loaded {
	        animation: bar2 1s ease forwards;
            top: 0;
            bottom: 99.5%;
            width: 0vw;
            opacity: 0;
	    }
	    @keyframes bar {
            0% {
                top: 50vh;
                bottom:49.5ch;
                width: 100vw;
                opacity:1;
            }
            5% {
                top: 50vh;
                bottom:49.5ch;
                width: 100vw;
                opacity:1;
            }
            30%{
                top: 0vh;
                bottom: 0vh;
                width: 100vw;
            }
            75%{
                top: 0vh;
                bottom: 99.5vh;
                width: 100vw;
            }
            80%{
                top: 0vh;
                bottom: 99.5vh;
                width: 100vw;
            }
            99% {
                top: 0vh;
                bottom: 99.5vh;
                width: 0vw;
                opacity:1;
            }
            100%{
                top: 0vh;
                bottom: 99.5vh;
                width: 0vw;
                opacity:0;
            }
        }
	    @keyframes bar2 {
            0% {
                top: 50vh;
                bottom:49.5ch;
                width: 100vw;
                opacity:1;
            }
            25%{
                top: 0vh;
                bottom: 0vh;
                width: 100vw;
            }
            80%{
                top: 0vh;
                bottom: 99.5vh;
                width: 100vw;
            }
            99% {
                top: 0vh;
                bottom: 99.5vh;
                width: 0vw;
                opacity:1;
            }
            100%{
                top: 0vh;
                bottom: 99.5vh;
                width: 0vw;
                opacity:0;
            }
        }
        .loading.anpage {
	        animation: anpage 0.5s ease forwards;
	    }
        .loadbar2.anpage {
	        animation: anpage2 0.5s ease forwards;
	    }
        @keyframes anpage {
            0% {
                left: 100vw;
            }
            100% {
                left: 0vw;
            }
        }
        @keyframes anpage2 {
            0% {
                right: 100vw;
            }
            100% {
                right: 0vw;
            }
        }
	    .loadtext{
	        position: absolute;
	        left:49%;
	        top:60%;
	    }
	    body.dark .loadbar{
	        background:#357F94;
	    }
	    
	    body.dark .loadbar2{
	        background: #F18A48;
	    }
	</style>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js'></script>
	<script>
        $(function(){
          setTimeout('stopload()', 10000);
        })
        
        function stopload(){
          $('#loading').delay(900).fadeOut(800);
        }
	</script>
</head>
<body>
    <script>
		if($.cookie('darkmode')=='true'){
		    $('body').addClass('dark');}</script>
    <!--loading-->
    <div class="loading">
        
        <div class='text-center'>
            <div class='loadtext'>0%</div>
        </div>
    </div>
    <div class='loadbar2'></div>
    <div class='loadbar'></div>
	<!--fin loading-->
	
    <!--header-->
	<div class='navigation-wrap bg-light start-header start-style'>
		<div id='progress-bar'></div>
		<div class='container'>
			<div class='row'>
				<div class='col-12'>
					<nav class='navbar navbar-expand-md navbar-light'>
						<a class='navbar-brand' href='/'>
							<img src='/tCt.png' alt=''>
							<!--<h1 class="m-0">tCt</h1>-->
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
									<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='/' role='button' aria-haspopup='true' aria-expanded='false'>Calender </a>
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
													<img src='".$_COOKIE["img"]."' style='height: 20px;'> ".$_COOKIE["name"]."</p>
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
";}?>
								<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4 active'>
									<button id="modalBtn" type="button" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#exampleModalCentered">
									        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
    									        <use xlink:href="bootstrap-icons.svg#gear"/>
    									    </svg> サイトの設定</button>
								</li>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--fin header-->
	<!--modal-->
	<div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenteredLabel">サイトの設定</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
				</div>
				<div class="modal-body">
					<button onclick='changemode()' class='btn btn-sm btn-outline-dark' id='swtich'>DARK</button>
					<button onclick='scrollsupporterchange()' class='btn btn-sm btn-outline-dark' id='scrollsupporter'>スクロール補助:on</button>
				</div>
			</div>
		</div>
	</div>
	<!--modalfin-->
	
	<div data-scroll-container>
		<div id='top' class='mx-auto text-center' style='height: 100vh;'>
			<div id='direction' style='height:35vh;'></div>
			<h1 class='display-4 my-5' data-scroll data-scroll data-scroll-delay='0.1' data-scroll-speed='2'>tclb Classroom todo </h1>
			<div id='targrt'>
				<div class='my-5 position-sticky' data-scroll data-scroll-direction='horizontal' data-scroll-speed='-10' data-scroll data-scroll-delay='0.05' data-scroll-position='top'>
					<p class='lead m-auto'>リード文がここに書かれるってま？ <br>二行目を試しに書いてみたあと <br>三行目を書くのがいいのだ！ </p>
				</div>
			</div>
			<button  onclick="scrollto('#element2',1000)" class='btn btn-lg btn-secondary my-5 shadow'>More</button>
		</div>
		<div class="space"></div>
		<div>
			<div id='back-deg' data-scroll data-scroll-repeat data-scroll-offset='0,-50%' data-scroll-class='fade-inl'></div>
			<div class="" id='element2' data-scroll data-scroll-repeat data-scroll-offset='0,-50%' data-scroll-class='fade-inr'>
				<div class="space"></div>
				<div class='display-4 ml-5 each-span-ib' style='margin-top:20vh;' data-scroll data-scroll-repeat data-scroll-class='fade-in'>What is tCt? </span>
				</div>
			</div>
		</div>
		<div style='height:30vh;'></div>
		<div id='element3' style='height:600vh;'>
            <img src='https://i.ytimg.com/vi/Yavpx_woHJ4/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/3RYIWKYwxcg/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/6OPKi3o5e3c/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/6vAYjqHeOeI/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/4J8OygmYoIk/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/9y4z1qogtMo/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/q7jmWz1kU3E/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/SVPrR6E-fuc/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/fA6rMFaIEFM/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/V5qG6_IeZP4/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/PjZsXTYu80s/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/tAoTIFxWl4I/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/0cfYdNUMXt0/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/sI9W0WN-IY8/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/p9zIzrpSR1Y/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/dBG2EC-aDjI/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/lXg_PSB2Exc/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/sAwo8fmMNhs/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/3LRkdW4I0X0/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/aVNtiG3BVGs/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/7EPLqfUB3_o/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/-cWtczcrVrg/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/xxGW0v4H90A/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/d8j9suHdmGw/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/4QO-yRnRDRY/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/0Re7n76HSb8/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/WaknRrYshF4/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/NSxL5xaYbHQ/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/fWmcsb0UKvc/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/tIu-SPbAzus/maxresdefault.jpg '>
            <img src='https://i.ytimg.com/vi/Em3FoV4dLYE/maxresdefault.jpg '>

		</div>
	</div>
	
	<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
	<script src='js/bootstrap.min.js'></script>
	<script src='js/menu.js'></script>
	<script src='js/locomotive-scroll.min.js'></script>
	<script>
		if($.cookie('darkmode')=='true'){
			$('#swtich').text('LIGHT')
			$('.btn-outline-dark').addClass('btn-outline-light').removeClass('btn-outline-dark');
		}
		$('#scrollsupporter').text(`スクロール補助:${$.cookie('scrollsupport')=='true' ? 'on':'off'}`);
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
			let progbefore = 0;
			let scrolling = false;
			function scrollto(target,time){
		        scrolling=true;
		        scroll.stop()
			    scroll.scrollTo(target,{duration: time});
		        setTimeout(function(){
		            scrolling=false;
		        }, 1100);
			}
			let scrollsupporteron = $.cookie('scrollsupport')!='false';
			scroll.on('scroll', ({limit,scroll}) => {
    		    let maxheight = window.innerHeight;
				const progress = scroll.y;
				$('#progress-bar').css({'width' : `${progress / limit.y * 100}vw`});
				if (scroll.y >= (maxheight*0.4)) {
				    if(header.hasClass('start-style')){
    					header.removeClass('start-style').addClass("scroll-on");
				    }
				} else {
				    if(header.hasClass('scroll-on')){
    					header.removeClass("scroll-on").addClass('start-style');
				    }
				}
				if(scrollsupporteron){
    				if (progbefore-progress > 10 && !scrolling) {
    				    if (scroll.y <= maxheight*1.2) {
    				        scrollto("#top",1000)
    				    }
    				    if (scroll.y <= maxheight*2.4 && scroll.y >= maxheight*1.4) {
    				        scrollto("#element2",1000)
    				    }
    				}
    				if (progbefore-progress < -10 && !scrolling) {
    				    if (scroll.y <= maxheight*0.8) {
    				        scrollto("#element2",1000)
    				    }
    				    if (scroll.y >=  maxheight*1.3 && scroll.y <= maxheight*1.5) {
    				        scrollto("#element3",1000)
    				    }
    				}
    				progbefore = scroll.y;
				}
			});
			function scrollsupporterchange(){
			    if(scrollsupporteron){
			        scrollsupporteron=false;
			        $.cookie('scrollsupport','false');
			        $('#scrollsupporter').text('スクロール補助:off')
			    }else{
			        scrollsupporteron=true;
			        $.cookie('scrollsupport','true');
			        $('#scrollsupporter').text('スクロール補助:on')
			    }
			}
	</script>
	<script>
		function changemode() {
				if ($('body').hasClass('dark')) {
					$('body').removeClass('dark');
					$('#swtich').text('DARK')
					$('.btn-outline-light').addClass('btn-outline-dark').removeClass('btn-outline-light')
					$.cookie('darkmode','false');
				} else {
					$('body').addClass('dark');
					$('#swtich').text('LIGHT')
					$('.btn-outline-dark').addClass('btn-outline-light').removeClass('btn-outline-dark');
					$.cookie('darkmode','true');
				}
			}
	</script>
	<script>
	    const imgLoad = imagesLoaded('body');
	    const imgTotal = imgLoad.images.length;
	    let imgLoaded = 0;
        let progressSpeed = 3;
        let progressCount = 0;
        let progressResult = 0;
        let progressInit = setInterval(function () {
            updateProgress();
        }, 25);
        imgLoad.on('progress', function (instance, image) {
            imgLoaded++
        });
        function updateProgress() {
          progressCount += (imgLoaded / imgTotal) * progressSpeed;
          if(progressCount >= 100 && imgTotal > imgLoaded) {
            progressResult = 99;
          } else if(progressCount > 99.9) {
            progressResult = 100;
          } else {
            progressResult = progressCount;
          }
          $('.loadbar').css('width', `${progressResult}vw`);
          $('.loadtext').text(`${Math.floor(progressResult)}%`)
          if (progressResult >= 100 && imgTotal == imgLoaded) {
            clearInterval(progressInit);
            $('.loadbar').addClass('loaded')
            $('.loadbar2').addClass('loaded')
            setTimeout(function () {
                $('.loading').fadeOut(0);
                scroll.start();
            }, 300);
          }
        }
	</script>
	<script>
const linkEls = [
  ...document.querySelectorAll('a:not([href*="#"]):not([target])'),
];

const currentHostName = window.location.hostname;

function addFadeout(url) {
  $('.loadtext').fadeOut(0);
  $('.loading').fadeIn(0).addClass('anpage');
  $('.loadbar2').removeClass('loaded').addClass('anpage');
  setTimeout(() => {
    window.location = url;
  }, 500);
}

linkEls.forEach((linkEl) => {
  linkEl.addEventListener("click", (e) => {
    if ((e.ctrlKey && !e.metaKey) || (!e.ctrlKey && e.metaKey)) return;
    e.preventDefault();
    e.stopPropagation();
    let url = linkEl.getAttribute("href");
    if (url !== "" && url.indexOf(currentHostName)) {
      addFadeout(url);
    }
  }, false);
});

window.addEventListener('pageshow', function (event) {
  if (event.persisted) {
    window.location.reload();
  }
});
	</script>
</body>
</html>