<?php global $categories, $cities; ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php _e(APP_NAME); ?></title>
    <meta name="author" content="<?php _e(APP_AUTHOR); ?>">
    <meta name="description" content="<?php _e(APP_DESC); ?>">
    <!-- Bootstrap -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <?php include 'favicon.php'; ?>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <?php if (getenv('APP_MODE') == 'production') { ?>
      <link href="/views/assets/{{cache-break:css/app.css}}" rel="stylesheet">
    <?php } else { ?>
      <link href="/views/assets/css/app.css" rel="stylesheet">
    <?php } ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php _e(BASE_URL); ?>"><img src="/views/assets/images/White_ACA_standard_horizontal.png" /></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <?php if (userIsValid()): ?>
               <li><a href="<?php _e(ADMIN_URL); ?>manage"><?php echo $lang->t('link|home'); ?></a></li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang->t('link|categories'); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php foreach($categories as $cat): ?>
                  <li><a href="<?php _e(ADMIN_URL . "categories/{$cat->id}/{$cat->url}"); ?>"><?php _e($cat->name); ?></a></li>
                  <?php endforeach; ?>
                </ul>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang->t('link|cities'); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <?php foreach($cities as $cit): ?>
                  <li><a href="<?php _e(ADMIN_URL . "cities/{$cit->id}/{$cit->url}"); ?>"><?php _e($cit->name); ?></a></li>
                  <?php endforeach; ?>
                </ul>
                </li>
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $lang->t('admin|manage'); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php _e(ADMIN_URL); ?>applications"><?php echo $lang->t('admin|job_applications'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>manage/categories"><?php echo $lang->t('link|categories'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>manage/cities"><?php echo $lang->t('link|cities'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>subscribers"><?php echo $lang->t('admin|subscribers'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>pages"><?php echo $lang->t('admin|site_pages'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>blocks"><?php echo $lang->t('admin|site_blocks'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>jobs/upload"><?php echo $lang->t('admin|bulk_upload'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>ban"><?php echo $lang->t('admin|ban_list'); ?></a></li>
                  <li><a href="<?php _e(ADMIN_URL); ?>jobs/expire"><?php echo $lang->t('admin|expire_jobs'); ?></a></li>
                  </ul>
                </li>
                <li><a href="<?php _e(ADMIN_URL .'jobs/new'); ?>"><?php echo $lang->t('jobs|post_job'); ?></a></li>
                <li><a href="<?php _e(ADMIN_URL .'logout'); ?>"><?php echo $lang->t('link|logout'); ?></a></li>
            <?php else: ?>
                <li><a href="<?php _e(ADMIN_URL .'login'); ?>"><?php echo $lang->t('link|login'); ?></a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container theme-showcase">
