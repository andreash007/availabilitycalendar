<div id="wrapper" class="clearfix">
<div id="header-top" class="clearfix">
<div id="logo"><!--start logo-->
<?php if ($logo): ?>
<a href="<?php print $front_page; ?>">
<img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
</a>
<?php endif; ?>
<div id="site-slogan"><?php if ($site_slogan): ?><?php print $site_slogan; ?><?php endif; ?></div><!--site slogan-->
</div><!--end logo-->
 <?php if ($page['search_box']): ?><!-- / start search box region -->
    <div class="search-box">
      <?php print render($page['search_box']); ?>
    </div> <!-- / end search box region -->
 <?php endif; ?>
 <?php if (theme_get_setting('social_icons')): ?>
<ul id="header-social">
<li><a href="http://www.twitter.com/<?php echo theme_get_setting('twitter_username'); ?>" target="_blank" rel="me"><img src="<?php global $base_url; echo $base_url.'/'.$directory.'/'; ?>/images/twitter.png" alt="twitter"/></a></li>
<li><a href="http://www.facebook.com/<?php echo theme_get_setting('facebook_username'); ?>" target="_blank" rel="me"><img src="<?php global $base_url; echo $base_url.'/'.$directory.'/'; ?>/images/facebook.png" alt="facebook"/></a></li>
<li><a href="<?php print $front_page; ?>rss.xml"><img src="<?php global $base_url; echo $base_url.'/'.$directory.'/'; ?>/images/rss.png" alt="RSS"/></a></li>
</ul><!--end header-social-->
<?php endif; ?>
</div><!--end header-top-->
<div id="header" class="clearfix"><!--start header--> 
    <?php print render($page['header']); ?>
<?php
global $user;
if (user_is_logged_in()) {
  echo '<div id="main-menu">

    <ul class="menu">
	<li class="first leaf"><a href="/my-calendars">My Calendars</a></li>
<li class="leaf"><a href="/faq">FAQ</a></li>
<li class="leaf"><a href="/reviews">Reviews</a></li>
<li class="leaf"><a href="/user">My Account</a></li>
<li class="last leaf"><a href="/user/logout">Logout</a></li>
</ul>
<div id="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div>
</div>';
}
else {
  	echo '<div id="main-menu">

    <ul class="menu">
<li class="first leaf"><a href="/faq">FAQ</a></li>
<li class="leaf"><a href="/reviews">Reviews</a></li>
<li class="last leaf"><a href="/user/login">Login</a></li>
</ul>
<div id="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></div>
</div>';
}
?>
</div> <!-- /#header -->
<div id="content-body">
  <section id="main" role="main" class="clear">
    <?php print $messages; ?>
    <a id="main-content"></a>
    <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
    <?php print render($title_prefix); ?>
    <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?><?php
$path = $_SERVER['REQUEST_URI'];
$find = '/calendar/';
$pos = strpos($path, $find);
if ($pos !== false): 
?> - Availability Calendar<?php
 endif; 
?></h1><?php endif; ?>
    <?php print render($title_suffix); ?>
    <?php if (!empty($tabs['#primary'])): ?><div class="tabs-wrapper clearfix"><?php print render($tabs); ?></div><?php endif; ?>
    <?php print render($page['help']); ?>
    <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
    <?php print render($page['content']); ?>
  </section> <!-- /#main -->
  
  <?php if ($page['sidebar_first']): ?>
    <aside id="sidebar-first" role="complementary" class="sidebar clearfix">
      <?php print render($page['sidebar_first']); ?>
    </aside> <!-- /#sidebar-first -->
  <?php endif; ?>

  <?php if ($page['sidebar_second']): ?>
    <aside id="sidebar-second" role="complementary" class="sidebar clearfix">
      <?php print render($page['sidebar_second']); ?>
    </aside>  <!-- /#sidebar-second -->
  <?php endif; ?>
</div> <!-- end content-body -->
<div class="clear"></div>
<div id="footer" class="clearfix">
 <?php if ($page['footer_first']): ?><!-- / start first footer block -->
    <div class="first-footer">
      <?php print render($page['footer_first']); ?>
    </div> <!-- / end first footer -->
  <?php endif; ?>
 <?php if ($page['footer_second']): ?><!-- / start second footer block -->
    <div class="second-footer">
      <?php print render($page['footer_second']); ?>
    </div> <!-- / end second footer -->
  <?php endif; ?>
 <?php if ($page['footer_third']): ?><!-- / start third footer block -->
    <div class="second-footer">
      <?php print render($page['footer_third']); ?>
    </div> <!-- / end third footer -->
  <?php endif; ?>
 <?php if ($page['footer_fourth']): ?><!-- / start fourth footer block -->
    <div class="second-footer">
      <?php print render($page['footer_fourth']); ?>
    </div> <!-- / end fourth footer -->
  <?php endif; ?>
<div class="clear"></div>
<?php print render($page['footer']) ?>
<div class="clear"></div>
<?php if (theme_get_setting('footer_copyright')): ?>
<div id="copyright"><a href="/">Copyright &copy; <?php echo date("Y"); ?> Availcalendar.com</a> | <a href="/site-notice">Site Notice</a></div>
<?php endif; ?>
<?php cache_clear_all(); ?>
</div> <!-- /#footer -->
 <?php if ($page['advertising']): ?>
    <div class="col-a">
      <?php print render($page['advertising']); ?>
    </div>
  <?php endif; ?>
</div> <!-- /#wrapper -->