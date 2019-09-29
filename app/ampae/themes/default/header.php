<!DOCTYPE HTML>
<html dir="<?php echo $model->appinfo['text_direction']; ?>" lang="<?php echo $model->appinfo['language']; // xtheme->renderLangAttr()?>">

<head>
<meta charset="<?php echo $model->appinfo['charset']; ?>" />
<!--
<meta http-equiv="Content-Type" content="" />
-->
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php
$view->renderMeta();
?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $model->appinfo['url'].DIR_ASSETS; ?>/img/favicon.ico" />

<link rel="stylesheet" type="text/css" href="<?php echo $model->appinfo['url'].PATH_LIBS; ?>/fa-5/css/fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $model->appinfo['url'].$model->appinfo['theme_webpath']; ?>/css/styles.css" />

<?php
$view->renderStyles();
?>
<script type='text/javascript' src="<?php echo $model->appinfo['url'].PATH_LIBS; ?>/jquery/jquery.min.js"></script>

<script type='text/javascript' src="<?php echo $model->appinfo['url'].PATH_LIBS; ?>/jquery/jquery.form.min.js"></script>


<?php
$view->renderScripts('HEAD');
?>
<script type='text/javascript' src="<?php echo $model->appinfo['url'].$model->appinfo['theme_webpath']; ?>/js/app.js"></script>

<script>
/*
var tmpChinaTownRegEx1 = new RegExp(/^.*\//);
var tmpChinaTownWebPath = tmpChinaTownRegEx1.exec(window.location.href);
*/
<?php
echo 'var tmpChinaTownWebPath="'.$model->appinfo['url'].'"';
?>
</script>

<title><?php echo $view->getTitle(); ?></title>


</head>

<body>

  	<header role="banner" aria-label="header banner">
<?php
global $auth;
if ($auth->is()) {
    ?>
      <div class="headerMobMenu">
      <label for="chkMenu" id="fufu" class="mobmenu-toggle">&#9776;</label>
      <input type="checkbox" id="chkMenu" onclick="ShowHideAsideLeft(this)"/>
      </div>
<?php
}
?>
      <div class="headerLogo">
        <a href="<?php echo $model->appinfo['url']; ?>">
        <img src="<?php echo $model->appinfo['url'].DIR_ASSETS; ?>/img/logo-32-w.png" class="img-responsive" alt="" />
        </a>
      </div>

<?php
if ($auth->is()) {
    ?>

      <div class="headerSearch">
        <section role="search" aria-label="header search">
         <input id="srch-term" type="text" placeholder="<?php echo $local->translate('search'); ?>..">
         <button type="submit"><i class="fa fa-search"></i></button>
        </section>
      </div>

<!--
<div class="dropdown">
 <button onclick="toggle_visibility('myDropdown')" class="dropbtn icon-wrapper-white">
   <i class="fa fa-bell"></i>
   <span class="badge"> </span>
 </button>
 <div id="myDropdown" class="dropdown-content" style="display:none;">
   <a href="#"> </a>
 </div>
</div>
-->

<!--
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="header navigation">
</nav>
-->

<?php
}
?>


<div class="dropdown tunav">
 <button onclick="toggle_visibility('myDropdown2')" class="dropbtn icon-wrapper-white">
   <i class="fa fa-globe"></i>
 </button>
 <div id="myDropdown2" class="dropdown-content" style="display:none;">

<?php
if ($auth->is()) {
    ?>
<a href="<?php echo $model->appinfo['url'].''; ?>settings"><?php echo $local->translate('settings'); ?></a>
<a href="<?php echo $model->appinfo['url'].''; ?>signout"><?php echo $local->translate('signout'); ?></a>
<?php
} else {
        ?>
<a href="<?php echo $model->appinfo['url'].''; ?>signin"><?php echo $local->translate('signin'); ?></a>
<?php
    }
?>

 </div>
</div>



<?php

?>
  	</header>

    <main role="main">
