    <div style="height: 100vh;"></div>
	</div>
	
	<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
	<script src='js/bootstrap.min.js'></script>
	<script src='js/menu.js'></script>
	<script src='js/locomotive-scroll.min.js'></script>
	<?php
	foreach($pagedata['js_bottom'] as $href){
	    echo "<script src='".$href."'></script>";
	};
	?>
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