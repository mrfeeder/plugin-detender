<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<title>
    <?php
        if ( is_front_page() ) :
            wp_title('Test Portal');
        else :
            wp_title();
        endif;
    ?>
</title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="https://twentyci.asia/wp-content/uploads/2018/01/1-Favicon.png" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?= plugins_url('/../../../css/bootstrap.min.css', __FILE__ ) ?>" />
<link rel="stylesheet" type="text/css" href="<?= plugins_url('/../../../css/app.css', __FILE__ ) ?>" />
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js" ></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script type="text/javascript" src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js" ></script>
<script type="text/javascript" src="<?= plugins_url('/../../../js/bootstrap.min.js', __FILE__ ) ?>"></script>
<script type="text/javascript" src="<?= plugins_url('/../../../js/sortElemenets.js', __FILE__ ) ?>"></script>
<script type="text/javascript" src="<?= plugins_url('/../../../js/main-script.js', __FILE__ ) ?>"></script>
</head>
<body <?php body_class(); ?>>
