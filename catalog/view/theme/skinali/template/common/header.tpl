<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta property="og:title" content="<?php echo $title; if (isset($_GET['page'])) { echo " - ". ((int) $_GET['page'])." ".$text_page;} ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url; ?>" />
<?php if ($og_image) { ?>
<meta property="og:image" content="<?php echo $og_image; ?>" />
<?php } else { ?>
<meta property="og:image" content="<?php echo $logo; ?>" />
<?php } ?>
<meta property="og:site_name" content="<?php echo $name; ?>" />

<!-- Bootstrap -->
<link href="catalog/view/theme/skinali/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="catalog/view/theme/skinali/css/reset.css">
<link rel="stylesheet" href="catalog/view/theme/skinali/css/fonts.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link rel="stylesheet" href="catalog/view/theme/skinali/css/styles.css">
<link rel="stylesheet" href="catalog/view/theme/skinali/css/media.css">

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="catalog/view/theme/skinali/js/jquery-1.9.1.min.js"></script>-->
<script src="catalog/view/javascript/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="catalog/view/theme/skinali/js/bootstrap.min.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- OWL-CAROUSEL -->
<script src="catalog/view/theme/skinali/js/owl.carousel.min.js"></script>
<link rel="stylesheet" href="catalog/view/theme/skinali/css/owl.carousel.min.css">
<link rel="stylesheet" href="catalog/view/theme/skinali/css/owl.theme.default.css">

<!-- FANCYBOX -->
<link rel="stylesheet" href="catalog/view/theme/skinali/js/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="catalog/view/theme/skinali/js/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script src="catalog/view/theme/skinali/js/jquery.mousewheel-3.0.6.pack.js"></script>
<link rel="stylesheet" href="catalog/view/theme/skinali/js/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="catalog/view/theme/skinali/js/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="catalog/view/theme/skinali/js/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="catalog/view/theme/skinali/js/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="catalog/view/theme/skinali/js/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<!-- HTML5 for IE -->
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- SWEETALERT -->
<script src="catalog/view/theme/skinali/js/sweetalert/sweetalert.min.js"></script>
<link rel="stylesheet" href="catalog/view/theme/skinali/js/sweetalert/sweetalert.css">

<script src="catalog/view/theme/skinali/js/common.js"></script>

<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>

<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
<?php foreach ($analytics as $analytic) { ?>
<?php echo $analytic; ?>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">

    <!-- start header -->
    <header class="header">
        <div class="container-fluid top-line-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav>
                            <ul>
                                <?php foreach($menu as $menus){ ?>
                                <?php if($menus['curent'] == $curent){ ?>
                                    <li><a class="active" href="<?php echo $menus['href']; ?>"><?php echo $menus['name']; ?></a></li>
                                <?php }else{ ?>
                                    <li><a href="<?php echo $menus['href']; ?>"><?php echo $menus['name']; ?></a></li>
                                <?php } ?>
                                <?php } ?>
                                <li><a href="#">Заявка</a></li>
                            </ul>
                        </nav>

                        <div class="search-call-block">
                            <div class="search-block" id="search">
                                <input type="search" name="search" placeholder="Найти изображение по №">
                                <input class="but-search" type="submit" value="">
                            </div>
                            <a class="button" href="#">Заказать звонок</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container bottom-line-header">
            <div class="row">
                <div class="col-md-12">
                    <?php if ($logo) { ?>
                        <a class="logo" href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
                    <?php } else { ?>
                        <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                    <?php } ?>
                    
                    <?php echo $comments; ?>
                    
                    <p class="time-work">
                       <?php echo $langdata; ?>
                    </p>
                    <address>
                        <?php echo $header_inf; ?>
                    </address>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->