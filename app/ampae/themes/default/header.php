<!DOCTYPE HTML>
<?php
$render->html($model->appinfo['text_direction'], $model->appinfo['language']);

echo $html->tagOpen('head');

$render->meta();
$render->link();
//$render->renderStyles();
?>
<script type='text/javascript' src="<?php echo $model->appinfo['url'].DIR_LIBS; ?>/jquery/jquery.min.js"></script>

<script type='text/javascript' src="<?php echo $model->appinfo['url'].DIR_LIBS; ?>/jquery/jquery.form.min.js"></script>


<?php
$render->script('HEAD');
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

<title><?php echo $html->getTitle(); ?></title>


</head>

<body>

<header role="banner" aria-label="header banner">
<?php
global $auth;
if ($auth->get()) {
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
if ($auth->get()) {
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
if ($auth->get()) {
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
<?php
