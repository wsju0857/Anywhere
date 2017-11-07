<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

	include "DB.php";
	session_start();
	
	$Search1 = $_GET['SearchText'];
?>
<!DOCTYPE html>
<html class="no-js" lang="ko-KR">
<head>

<!-- META DATA -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


<!-- Title -->
<?php 
	if($Search1 != NULL){
?>
<title>AnyWhere - '<?= $Search1; ?>' 검색결과</title>
<?php 
	}else if($Search1 == NULL){
?>
<title>AnyWhere - 검색어를 입력해주세요</title>
<?php 		
	}
?>

<!-- CSS Global Compulsory -->
<link rel="stylesheet" href="../css/bootstrap.min.css" >
<link rel="stylesheet" href="../css/style.css" >
<link rel="stylesheet" href="../css/Add.css" >


<!-- CSS Implementing Plugins -->
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../css/ionicons.min.css" />
<link rel="stylesheet" type="text/css" href="../css/animate.min.css" />
<link rel="stylesheet" type="text/css" href="../css/flexslider.css" />
<link rel="stylesheet" type="text/css" href="../css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="../css/owl.theme.css" />
<link rel="stylesheet" type="text/css" href="../css/vegas.min.css" />
<link rel="stylesheet" type="text/css" href="../css/menu.css" />
<link rel="stylesheet" type="text/css" href="../css/sidebar.css" />

<!-- Fonts -->	
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,700italic,400,300,700&amp;subset=latin,latin-ext'
 rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700,900' rel='stylesheet' type='text/css'>


<!-- JS -->
<script type="text/javascript" src="../js/modernizr.js"></script>
<script type="text/javascript" src="../js/snap.svg-min.js"></script>
</head>
<body class="image-background1" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">

<!-- Preloader -->
<!-- <div id="preloader"> -->
<!-- <div id="loading-animation">&nbsp;</div>-->
<!-- </div>-->
<!-- /Preloader -->

<!-- Overlay -->
<div id="section-home" class="home-section-wrap center">
<div class="section-overlay"></div>
</div>
<!-- /Overlay -->

<!-- container -->
<div class="containers">
<!-- menu -->
<nav id="menu" class="menu">
<button class="menu__handle"><span>Menu</span></button>
<div class="menu__inner">
<ul>
<li><a href="index.html"><i class="fa fa-fw fa-home"></i><span>Home</span></a></li>
<li><a href="about.html"><i class="fa fa-fw fa-info"></i><span>About</span></a></li>
<li><a href="team.html"><i class="fa fa-fw fa-users"></i><span>Team</span></a></li>
<li><a href="services.html"><i class="fa fa-fw fa-gear"></i><span>Services</span></a></li>
<li><a href="portfolio.html"><i class="fa fa-fw fa-camera"></i><span>Portfolio</span></a></li>
<li><a href="contact.html"><i class="fa fa-fw fa-envelope"></i><span>Contact</span></a></li>
</ul>
</div>
<div class="morph-shape" data-morph-open="M300-10c0,0,295,164,295,410c0,232-295,410-295,410" 
data-morph-close="M300-10C300-10,5,154,5,400c0,232,295,410,295,410">
<svg width="100%" height="100%" viewBox="0 0 600 800" preserveAspectRatio="none">
<path fill="none" d="M300-10c0,0,0,164,0,410c0,232,0,410,0,410"/>
</svg>
</div>
</nav><!-- /menu -->

<!-- main -->
<div class="main">
<!-- header -->
<header class="header-site">
<div class="logo-site animated bounceInDown" data-animation-delay="700" style="width:350px;">
<h1 style="margin-top:-70px;"><a href="index.html"><br>AnyWhere<br></a></h1>
</div>
</header>
<!-- /header -->

<!-- Login -->
<?php 
	if(!isset($_SESSION['login_user'])){
?>
<div style="position:absolute; left:81%; top:5%;">
	<form action="../Login.html" method="post">
		<button type="submit" class="border-button no-bottom-margin" style="padding:9px 40px;">로그인</button>
	</form>
</div>	
<?php 
	}else{
?>
<div style="position:absolute; left:81%; top:5%;">
	<form action="Logout.php">
		<button type="submit" class="border-button no-bottom-margin" style="text-align:center; padding:9px 20px;">
		<?php echo $_SESSION['login_user']; ?></button>
	</form>
</div>
<?php 
	}
?>
<!-- /Login -->

<!-- section -->                 
<section class="section fullscreen site-main">
<div class="container-section">
<div class="container-table">
<div class="content-table">
<!-- bt-carousel -->
<div class="bt-carousel">

<!-- home section -->
<div class="item-slide show">
<!-- container -->
<div class="container">
<div class="row">
<div class="col-md-10 col-md-offset-1">

<!-- content slide -->
<div class="content-slide">
<!-- Subscribe Form -->
<div class="form animated bounceInUp" data-animation-delay="700">
<!-- container form -->
<div class="container-form">

<!-- section page -->
<div class="section-page" id="signup">
	<form action="<?php $PHP_SELF; ?>" class="subscription-form mailchimp" method="GET">
		<input type="text" id="SearchText" class="border-radius-22 bottom-margin" name="SearchText"
		value="<?= $Search1; ?>"/>
		<button type="submit" id="subscribebtn" class="border-button no-bottom-margin">검색</button>
	</form>
</div><!-- /section page -->

</div><!-- /container form -->
</div><!-- /Subscribe Form -->

<div class="color-white top-margin animated bounceInDown" data-animation-delay="700" 
style="padding-top:10px; padding-bottom:30px; border:1px solid white;">
	
<?php
	$data = mysql_query("SELECT * FROM data where name like '%$Search1%'");
	
	if (mysql_num_rows($data) >= 1){
		echo mysql_num_rows($data)."<br>";
		echo $Search1."<br>";
		$data = mysql_query("SELECT * FROM data where name like '%$Search1%' ORDER BY viewcount DESC");
		$num = mysql_num_rows($data);
		
		$page = $_GET['page'] ? $_GET['page'] : 1;
		$list = 2;
		$block = 2;
		
		$pageNum = ceil($num/$list); // 총 페이지
		$blockNum = ceil($pageNum/$block); // 총 블록
		$nowBlock = ceil($page/$block);
		
		$s_page = ($nowBlock * $block) - 2;
		if ($s_page <= 1) {
		    $s_page = 1;
		}
		$e_page = $nowBlock*$block;
		if ($pageNum <= $e_page) {
		    $e_page = $pageNum;
		}
		
		for ($p=$s_page; $p<=$e_page; $p++) {
?>
		    <a href="<?php $PHP_SELF; ?>?SearchText=<?= $Search1; ?>&page=<?= $p; ?>"><?= $p; ?></a>
<?php
		}
?>
		<div>
		    <a href="<?php $PHP_SELF; ?>?SearchText=<?= $Search1; ?>&page=<?= $s_page-1; ?>">이전</a>
		    <a href="<?php $PHP_SELF; ?>?SearchText=<?= $Search1; ?>&page=<?= $e_page+1; ?>">다음</a>
		</div>
<?php
		$s_point = ($page-1) * $list;
		
		$real_data = mysql_query("SELECT * FROM data where name like '%$Search1%' ORDER BY viewcount DESC LIMIT $s_point,$list");
		$total = mysql_num_rows($real_data);
		for ($i=1; $i<=$num; $i++) {
		    $fetch = mysql_fetch_array($real_data);
?>
		    <div>
		        <?= $fetch[0]; ?>
		    </div>
<?php
		    if ($fetch == false) {
		        exit;
		    }
		}
	}else if(mysql_num_rows($data) == 0){
		echo mysql_num_rows($data)."<br>";
		echo $Search1."<br>";
		echo "검색 결과가 없습니다.";
	}
?>
</div>

<!-- socials icons -->
<nav class="socials-icons animated bounceInUp" data-animation-delay="700" style="border:1px solid green;">
<ul>
<li><a href="#"><i class="ion-social-facebook"></i></a></li>
<li><a href="#"><i class="ion-social-twitter"></i></a></li>
<li><a href="#"><i class="ion-social-googleplus"></i></a></li>
<li><a href="#"><i class="ion-social-linkedin"></i></a></li>
<li><a href="#"><i class="ion-social-pinterest"></i></a></li>
<li><a href="#"><i class="ion-social-dribbble-outline"></i></a></li>
</ul> 
</nav><!-- /socials icons -->

<!-- copyright -->
<footer class="copy-right animated bounceInUp" data-animation-delay="700">
<div class="copyright">
© 2017 Hallym Team KT - All Rights Reserved
</div>
</footer><!-- /copyright -->

</div><!-- /content slide -->
</div>
</div><!-- /row -->
</div><!-- /container -->
</div>
<!-- /home section -->

</div><!-- /bt-carousel -->
</div>
</div>
</div>
</section><!-- /section -->  
</div><!-- /main -->
</div><!-- /container -->        

<!-- JS -->
<script type="text/javascript" src="../js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/retina.min.js"></script>
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="../js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="../js/jquery.parallaxify.min.js"></script>
<script type="text/javascript" src="../js/jquery.particleground.min.js"></script>
<script type="text/javascript" src="../js/vegas.min.js"></script>
<script type="text/javascript" src="../js/trianglify.min.js"></script>
<script type="text/javascript" src="../js/jquery.mb.YTPlayer.js"></script>
<script type="text/javascript" src="../js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="../js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="../js/owl.carousel.min.js"></script>
<script type="text/javascript" src="../js/jquery.appear.js"></script>
<script type="text/javascript" src="../js/classie.js"></script>
<script type="text/javascript" src="../js/sidebar.js"></script>
<script type="text/javascript" src="../js/main.js"></script>
<!-- /JS -->
</body>
</html>
<?php 
	mysql_close($connect);
?>