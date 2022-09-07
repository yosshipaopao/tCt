<?php 
if(!isset($_COOKIE["email"])){header('Location: ./login');exit();}
$email=$_COOKIE["email"];$name=$_COOKIE["name"];$uid=$_COOKIE["uid"];
if(!isset($_SESSION["email"])){$_SESSION["img"]=$_COOKIE["img"];$_SESSION["email"]=$_COOKIE["email"];$_SESSION["name"]=$_COOKIE["name"];$_SESSION["uid"]=$_COOKIE["uid"];}
?>

<link rel="stylesheet" href="css/selmodal.css" media="screen" rel='stylesheet' type='text/css'>
<style>
    h3 {
    color: #f00;
}
#inputname {
    height: 5vh;
    width: 20vw;
    font-size: 4vh;
}
div.selModalList > ul > li:nth-child(1) {
    display: none;
}
.Lists0 ul li {
    font-size: 50;
    width: 25%;
    height: 10vh;
    max-height: 300px;
    display: inline-block;
}
.Lists1 ul li {
    font-size: 5vh;
    width: 10%;
    height: 10vh;
    max-height: 300px;
    padding-top: 35px;
    display: inline-block;
}
.radio-button {
    width: 90%;
    text-align: left;
}
.radio-button input[type='radio'] {
    position: absolute;
    z-index: -1;
    opacity: 0;
}
.radio-button label {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
    margin-right: 30px;
    padding: 10px 10px 10px 60px;
    cursor: pointer;
}
.radio-button label::before {
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    display: block;
    width: 45px;
    height: 45px;
    content: ' ';
    border: 2px solid #da3c41;
    border-radius: 100px;
}
.radio-button input[type='radio'] + label::before {
    border-radius: 30px;
}
.radio-button input[type='radio']:checked + label {
    padding-left: 20px;
    color: #ffffff;
}
.radio-button input[type='radio']:checked + label::before {
    top: 0;
    width: 100%;
    height: 100%;
    background: #da3c41;
}
.radio-button label,
.radio-button label::before {
    -webkit-transition: 0.25s all ease;
    transition: 0.25s all ease;
}
@import url( 'https://fonts.googleapis.com/css?family=Roboto+Condensed:700&subset=cyrillic');
.block input {
    display: none;
}
.block {
    width: auto;
    position: relative;
    clear: both;
    margin: 0 0 25px;
    float: left;
}
.block span {
    text-transform: uppercase;
    font-family: 'Roboto Condensed', sans-serif;
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 30px;
    float: right;
    width: auto;
    margin: 2px 10px 0;
}
.wrap {
    width: 200px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    padding: 30px 30px 5px;
}
.block label {
    width: 100px;
    height: 50px;
    box-sizing: border-box;
    border: 3px solid;
    float: left;
    border-radius: 100px;
    position: relative;
    cursor: pointer;
    transition: 0.3s ease;
}
input[type=checkbox]:checked + label {
    background: #55e868;
}
input[type=checkbox]:checked + label:before {
    left: 50px;
}
.block label:before {
    transition: 0.3s ease;
    content: '';
    width: 40px;
    height: 40px;
    position: absolute;
    background: white;
    left: 2px;
    top: 2px;
    box-sizing: border-box;
    border: 3px solid;
    color: black;
    border-radius: 100px;
}


#nickname{
    font-size: 30px;
    width: 100%;
    border: none;
    outline: none;
    padding-bottom: 8px;
    box-sizing: border-box; /*横幅の解釈をpadding, borderまでとする*/
}
#l_name{
    font-size: 20px;
    color: #222;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
}
#l_name::after{
    color: #3be5ae;
}

.text_underline{
    position: relative; /*.text_underline::beforeの親要素*/
    border-top: 3px solid #c2c2c2; /*text3の下線*/
}

/*共通のstyle*/
.text_underline::before,
.text_underline::after{
    position: absolute; 
    bottom: 0px; /*中央配置*/
    width: 0px; /*アニメーションで0pxから50%に*/
    height: 3px; /*高さ*/
    content: '';
    background-color: #3be5ae; /*アニメーションの色*/
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
}

/*中央から右へのアニメーション*/
.text_underline::before{
    left: 50%; /*中央配置*/
}

/*中央から左へのアニメーション*/
.text_underline::after{ 
    right: 50%; /*中央配置*/
}

#nickname:focus + .text_underline::before,
#nickname:focus + .text_underline::after{
    width: 50%;
}
</style>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.js"></script>
<script src="js/Jquery.selmodal.js"></script>
<script type="text/javascript">
    $(function(){
      	$('select').selModal();
      });
      $('#nickname').focus(function(){
    $('#l_text').animate({'color': '#3be5ae'}, 500);
}).blur(function(){
    $('#l_text').animate({'color': 'black'}, 500);
});
</script>
<script>
    
    function delay(n){return new Promise(function(resolve){setTimeout(resolve,n*1000)})}async function retypeplaceholder(){const nameplaceholder=document.getElementById("nickname").placeholder.split('');while(true){let namepl='';for(let i=0;i<nameplaceholder.length;i+=1){namepl+=nameplaceholder[i];document.getElementById("nickname").placeholder=namepl;await delay(0.2)}}}retypeplaceholder();
</script>
<h1>ログイン後のページです</h1>
<?php
echo '<img src="'.$_SESSION["img"].'" class="img-responsive img-circle img-thumbnail" />';
echo '<h3><b>Name :</b> '.$_SESSION['name'].'</h3>';
echo '<h3><b>Email :</b> '.$_SESSION['email'].'</h3>';
?>
<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-bottom-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
function check() {
    $("#classisset").text("");
    $("#numberisset").text("");
    $("#genderisset").text("");
    document.forms.form.uid.value = "<? echo $uid ?>";
    document.forms.form.email.value = "<? echo $email ?>";
    document.forms.form.name.value = "<? echo $name ?>";
    if (form.class.value != "" && form.number.value != "" && form.gender.value != "") {
        return true
    } else {
        if (form.class.value == "") {
            $("#classisset").text("入力されていません");
            toastr["warning"]("classを入力してください", "必須項目が入力されていません");
        }
        if (form.number.value == "") {
            $("#numberisset").text("入力されていません");
            toastr["warning"]("numberを入力してください", "必須項目が入力されていません");
        }
        if (form.gender.value == "") {
            $("#genderisset").text("入力されていません");
            toastr["warning"]("genderを入力してください", "必須項目が入力されていません");
        }
    }
    alert("入力されていません");
    return false;
}
</script>
<form name="form" action="setuped" method="post" onSubmit="return check()">
    <input type="hidden" name="uid" value="">
    <input type="hidden" name="email" value="">
    <input type="hidden" name="name" value="">
    
   <label for="nickname" id="l_text">名前入力</label>
   <input type="text" name="nickname" id="nickname" placeholder="ここに入力...">
   <div class="text_underline"></div>
    <h2>クラスを入力</h2>
    <div id="selectclass">
        <h3 id="classisset"></h3>
        <select name="class">
            <option value='' selected disabled>選択してください</option>
            <option value="1A">1-A</option>
            <option value="1B">1-B</option>
            <option value="1C">1-C</option>
            <option value="1D">1-D</option>
            <option value="2A">2-A</option>
            <option value="2B">2-B</option>
            <option value="2C">2-C</option>
            <option value="2D">2-D</option>
            <option value="3A">3-A</option>
            <option value="3B">3-B</option>
            <option value="3C">3-C</option>
            <option value="3D">3-D</option>
        </select>
    </div>
    <h2>出席番号</h2>
    <div id="container">
        <h3 id="numberisset"></h3>
        <select name="number">
            <option value='' selected disabled>選択してください</option>
            <?php for ($i = 1;$i < 41;++$i) {echo "<option value='".$i."'>".$i.'</option>';} ?>
        </select>
        <h2>性別</h2>
        <div class="radio-button">
            <h3 id="genderisset"></h3>
            <input type="radio" name="gender" id="select" value="" checked disabled>
            <label class="radio01" for="select">選択してください</label>
            <input type="radio" name="gender" id="male" value="male">
            <label class="radio01" for="male">男</label>
            <input type="radio" name="gender" id="female" value="female">
            <label class="radio01" for="female">女</label>
        </div>
    </div>
    <input type="submit">
</form>