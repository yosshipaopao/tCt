<!doctypehtml>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>tCt-
      <? echo $pagedata['title']; ?>
    </title>
    <link href="css/bootstrap-reboot.min.css"rel="stylesheet">
    <link href="css/bootstrap.min.css"rel="stylesheet">
    <link href="css/menu.css"rel="stylesheet">
    <link href="css/locomotive-scroll.min.css"rel="stylesheet">
    <?php foreach($pagedata['css']as $href){echo "<link rel='stylesheet' href='".$href."'>";}; ?>
    <style>[data-scroll-class=fade-in]{
      opacity:0;
      visibility:hidden;
      transform:translateY(100px);
      transition:opacity 2s,transform 2s}
      [data-scroll-class=fade-in].fade-in{
        opacity:1;
        visibility:visible;
        transform:translateY(0)}
      [data-scroll-class=fade-inr]{
        opacity:0;
        visibility:hidden;
        transform:translateX(100vw);
        transition:opacity 2s,transform 2s}
      [data-scroll-class=fade-inr].fade-inr{
        opacity:1;
        visibility:visible;
        transform:translateX(0)}
      [data-scroll-class=fade-inl]{
        opacity:0;
        visibility:hidden;
        right:200vw;
        transition:opacity 2s,right 2s}
      [data-scroll-class=fade-inl].fade-inl{
        opacity:1;
        visibility:visible;
        right:0}
      .each-span-ib{
        margin-top:50px}
      .each-span-ib span{
        display:inline-block}
      .space{
        height:20vh}
      #element2{
        height:100vh}
      #element2::before{
        content:'';
        position:absolute;
        top:20vh;
        width:100vw;
        height:100vh;
        background-color:#f18a48;
        transform:skewY(-7deg);
        z-index:-1}
      #back-deg{
        width:100vw;
        height:100vh;
        position:absolute;
        background-color:#357f94;
        transform:translateY(20vh) skewY(7deg);
        z-index:-2}
      #swtich{
        width:4vw}
      .c-scrollbar{
        z-index:1000}
      #progress-bar{
        position:absolute;
        top:0;
        left:0;
        width:0;
        height:.4vh;
        background:#f18a48}
      .modal-content{
        opacity:0;
        transition:opacity .5s}
      .modal.show .modal-content{
        opacity:1}
    </style>
    <style>body.dark #back-deg{
      background-color:#f18a48}
      body.dark #element2::before{
        background-color:#357f94}
      body.dark #progress-bar{
        background:#357f94}
      body.dark .modal-content{
        background-color:#000}
      body.dark .close{
        color:#fff}
    </style>
    <style>.loading{
      position:fixed;
      top:0;
      bottom:0;
      right:0;
      left:0;
      background:#fff;
      z-index:10000;
      opacity:1}
      body.dark .loading{
        background:#000}
      .loadcon{
        margin-top:40vh;
        width:100vw;
        height:3vh;
        z-index:10001}
      .loadbar,.loadbar2{
        position:absolute;
        top:50%;
        bottom:49.5%;
        width:100vw;
        background:#f18a48;
        z-index:10005;
        opacity:1}
      .loadbar2{
        background:#357f94}
      .loadbar.loaded{
        animation:bar 1s ease forwards;
        top:0;
        bottom:99.5%;
        width:0;
        opacity:0}
      .loadbar2.loaded{
        animation:bar2 1s ease forwards;
        top:0;
        bottom:99.5%;
        width:0;
        opacity:0}
      @keyframes bar{
        0%{
          top:50vh;
          bottom:49.5ch;
          width:100vw;
          opacity:1}
        5%{
          top:50vh;
          bottom:49.5ch;
          width:100vw;
          opacity:1}
        30%{
          top:0;
          bottom:0;
          width:100vw}
        75%{
          top:0;
          bottom:99.5vh;
          width:100vw}
        80%{
          top:0;
          bottom:99.5vh;
          width:100vw}
        99%{
          top:0;
          bottom:99.5vh;
          width:0;
          opacity:1}
        100%{
          top:0;
          bottom:99.5vh;
          width:0;
          opacity:0}
      }
      @keyframes bar2{
        0%{
          top:50vh;
          bottom:49.5ch;
          width:100vw;
          opacity:1}
        25%{
          top:0;
          bottom:0;
          width:100vw}
        80%{
          top:0;
          bottom:99.5vh;
          width:100vw}
        99%{
          top:0;
          bottom:99.5vh;
          width:0;
          opacity:1}
        100%{
          top:0;
          bottom:99.5vh;
          width:0;
          opacity:0}
      }
      .loading.anpage{
        animation:anpage .5s ease forwards}
      .loadbar2.anpage{
        animation:anpage2 .5s ease forwards}
      @keyframes anpage{
        0%{
          left:100vw}
        100%{
          left:0}
      }
      @keyframes anpage2{
        0%{
          right:100vw}
        100%{
          right:0}
      }
      .loadtext{
        position:absolute;
        left:49%;
        top:60%}
      body.dark .loadbar{
        background:#357f94}
      body.dark .loadbar2{
        background:#f18a48}
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/5.0.0/imagesloaded.pkgd.min.js">
    </script>
    <?php foreach($pagedata['js_top']as $href){echo "<script src='".$href."'></script>";}; ?>
    <script>function stopload(){
        $("#loading").delay(900).fadeOut(800)}
      $(function(){
        setTimeout("stopload()",1e4)}
       )</script>
  </head>
  <body>
    <script>"true"==$.cookie("darkmode")&&$("body").addClass("dark")</script>
    <div class="loading">
      <div class="text-center">
        <div class="loadtext">0%
        </div>
      </div>
    </div>
    <div class="loadbar2">
    </div>
    <div class="loadbar">
    </div>
    <div class="bg-light navigation-wrap start-header start-style">
      <div id="progress-bar">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav class="navbar navbar-expand-md navbar-light">
              <a class="navbar-brand"href="/">
                <img alt=""src="/tCt.png"> 
              </a>
              <button class="navbar-toggler"type="button"aria-label="Toggle navigation"aria-controls="navbarSupportedContent"aria-expanded="false"data-target="#navbarSupportedContent"data-toggle="collapse">
                <span class="navbar-toggler-icon">
                </span>
              </button>
              <div class="collapse navbar-collapse"id="navbarSupportedContent">
                <ul class="ml-auto navbar-nav py-4 py-md-0">
                  <li class="ml-0 ml-md-4 nav-item pl-4 pl-md-0 active">
                    <a class="nav-link"href="#top"data-scroll-to>Home
                    </a>
                  </li>
                  <li class="ml-0 ml-md-4 nav-item pl-4 pl-md-0">
                    <a class="nav-link dropdown-toggle"href="/"aria-expanded="false"aria-haspopup="true"data-toggle="dropdown"role="button">Calender
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item"href="#">Today
                      </a> 
                      <a class="dropdown-item"href="#">Week
                      </a> 
                      <a class="dropdown-item"href="#">Month
                      </a>
                    </div>
                  </li>
                  <?php if(isset($_COOKIE["name"])){echo "<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4'><a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Account</a><div class='dropdown-menu'><p class='dropdown-item'>t<img src='".$_COOKIE["img"]."' style='height: 20px;'> ".$_COOKIE["name"]."</p><a class='dropdown-item' href='/'>settings</a><a class='dropdown-item' href='/subscribe'>Notifaction</a><a class='dropdown-item' href='/calender'>Todo</a></div></li>";}else{include('settings/login_config.php');echo "\n\t\t\t\t\t\t\t\t\t\t\t<li class='nav-item pl-4 pl-md-0 ml-0 ml-md-4'>\n\t\t\t\t\t\t\t\t\t\t\t\t<a class='nav-link' href='".$google_client->createAuthUrl()."' data-scroll-to>Login</a>\n\t\t\t\t\t\t\t\t\t\t\t</li>\n";} ?>
                  <li class="ml-0 ml-md-4 nav-item pl-4 pl-md-0 active">
                    <button class="btn btn-outline-dark btn-sm"id="modalBtn"data-target="#exampleModalCentered"data-toggle="modal"type="button">
                      <svg class="bi bi-gear"fill="currentColor"height="16"viewBox="0 0 16 16"width="16"xmlns="http://www.w3.org/2000/svg">
                        <use xlink:href="bootstrap-icons.svg#gear"/>
                      </svg> サイトの設定
                    </button>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="modal"id="exampleModalCentered"aria-hidden="true"aria-labelledby="exampleModalCenteredLabel"role="dialog"tabindex="-1">
      <div class="modal-dialog modal-dialog-centered"role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"id="exampleModalCenteredLabel">サイトの設定
            </h5>
            <button class="close"type="button"aria-label="Close"data-dismiss="modal">
              <span aria-hidden="true">×
              </span>
            </button>
          </div>
          <div class="modal-body">
            <button class="btn btn-outline-dark btn-sm"id="swtich"onclick="changemode()">DARK
            </button>
          </div>
        </div>
      </div>
    </div>
    <div data-scroll-container>
      <div style="height:20vh;">
      </div>
