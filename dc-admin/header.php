<?php
/**
 * Set globals
 */

global $em, $dc, $dc_admin, $dc_content, $page_title, $url;

  if ($_SESSION['logged'] === true)
    $user = $em->find('\Entities\User', $_SESSION['user']);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>daCommerce | <?=$page_title?></title>

<link rel="shortcut icon" href="<?= DC_ADMIN ?>favicon.ico" type="image/x-icon" />

<!-- JS -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery-validate.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery-mask.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>js/da-login.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>js/da-core.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>js/da-customizer.js"></script>

<!-- jQuery-UI JavaScript Files -->
<script type="text/javascript" src="<?= DC_ADMIN ?>jui/js/jquery-ui-1.8.20.min.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>jui/js/jquery.ui.timepicker.min.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>jui/js/jquery.ui.touch-punch.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>jui/css/jquery.ui.all.css" media="screen" />

<!-- CSS -->
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/normalize.css">
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/basic.css">
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/styles.css">
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/login.css">
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/core/button.css">

<!--  Fluid Grid System -->
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/fluid.css" media="screen" />
<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/dandelion.theme.css" media="screen" />
<!--  Main Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?= DC_ADMIN ?>css/dandelion.css" media="screen" />

<!-- Plugin Files -->

<!-- PLUpload Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/plupload/plupload.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/plupload/i18n/pt-br.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/plupload/plupload.flash.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/plupload/plupload.html4.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/plupload/plupload.html5.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<link rel="stylesheet" href="<?= DC_ADMIN ?>plugins/plupload/jquery.plupload.queue.css" />

<!-- FileInput Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery.fileinput.js"></script>
<!-- Mousewheel Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery.mousewheel.min.js"></script>
<!-- Scrollbar Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery.tinyscrollbar.min.js"></script>
<!-- Tooltips Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/tipsy/jquery.tipsy-min.js"></script>
<link rel="stylesheet" href="<?= DC_ADMIN ?>plugins/tipsy/tipsy.css" />

<!-- Statistic Plugin JavaScript Files (requires metadata and excanvas for IE) -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery.metadata.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?= DC_ADMIN ?>js/excanvas.js"></script>
<![endif]-->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/core/plugins/dandelion.circularstat.min.js"></script>

<!-- Wizard Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/core/plugins/dandelion.wizard.min.js"></script>

<!-- Fullcalendar Plugin -->
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?= DC_ADMIN ?>plugins/fullcalendar/gcal.js"></script>
<link rel="stylesheet" href="<?= DC_ADMIN ?>plugins/fullcalendar/fullcalendar.css" media="screen" />
<link rel="stylesheet" href="<?= DC_ADMIN ?>plugins/fullcalendar/fullcalendar.print.css" media="print" />

<!-- Load Google Chart Plugin -->
<!-- <script type="text/javascript" src="https://www.google.com/jsapi"></script> -->
<script type="text/javascript">
    // Load the Visualization API and the piechart package.
    // google.load('visualization', '1.0', {'packages':['corechart']});
</script>
<!-- Debounced resize script for preventing to many window.resize events
      Recommended for Google Charts to perform optimally when resizing -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/jquery.debouncedresize.js"></script>

<!-- Demo JavaScript Files -->
<script type="text/javascript" src="<?= DC_ADMIN ?>js/demo/demo.dashboard.js"></script>

<script type="text/javascript" src="<?= DC_ADMIN ?>js/dacommerce.js"></script>
<!-- BASE -->
<base href="<?= DC_ADMIN ?>">
</head>
<body>

<?php if ($_SESSION['logged'] === true): ?>
<div id="da-wrapper" class="fluid">
     <!-- Header -->
    <div id="da-header">

        <div id="da-header-top">

            <!-- Container -->
            <div class="da-container clearfix">

                <!-- Logo Container. All images put here will be vertically centere -->
                <div id="da-logo-wrap">
                    <div id="da-logo">
                        <div id="da-logo-img">
                            <a href="dc-dashboard">
                                <img src="images/logowhite.png" alt="Dandelion Admin" />
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Header Toolbar Menu -->
                <div id="da-header-toolbar" class="clearfix">
                    <div id="da-user-profile">
                        <div id="da-user-info">
                            <?= $user->getUserName() ?>
                            <span class="da-user-title">
                                <?= $user->getUserAccessRole() ?>
                            </span>
                        </div>
                        <ul class="da-header-dropdown">
                            <li class="da-dropdown-caret">
                                <span class="caret-outer"></span>
                                <span class="caret-inner"></span>
                            </li>
                            <li class="da-dropdown-divider"></li>
                            <li><a href="dc-dashboard">Dashboard</a></li>
                            <li class="da-dropdown-divider"></li>
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#">Configurações</a></li>
                        </ul>
                    </div>
                    <div id="da-header-button-container">
                        <ul>
                            <li class="da-header-button logout">
                                <a href="dc-logout">Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div id="da-header-bottom">
            <!-- Container -->
            <div class="da-container clearfix">

                <!-- Breadcrumbs -->
                <div id="da-breadcrumb">
                    <ul>
                        <?php if ($url[0] == 'dc-dashboard'): ?>
                            <li class="active"><span><img src="images/icons/black/16/home.png" alt="Home" />Dashboard</span></li>
                        <?php else : ?>
                            <li><a href="dc-dashboard"><span><img src="images/icons/black/16/home.png" alt="Home" />Dashboard</span></a></li>
                            <li class="active"><span><?=$page_title?></span></li>
                        <?php endif ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Content -->
<div id="da-content">

    <!-- Container -->
    <div class="da-container clearfix">

        <!-- Sidebar Separator do not remove -->
        <div id="da-sidebar-separator"></div>

        <!-- Sidebar -->
        <div id="da-sidebar">

            <!-- Main Navigation -->
            <div id="da-main-nav" class="da-button-container">
                <ul>
                    <li <?=($url[0] == 'dc-dashboard') ? 'class="active"' : ''?>>
                        <a href="dc-dashboard">
                            <!-- Icon Container -->
                            <span class="da-nav-icon">
                                <img src="images/icons/black/32/home.png" alt="Dashboard" />
                            </span>
                            Dashboard
                        </a>
                    </li>
                    <?php if ($user->getUserAccess() == 0) : ?>
                    <li>
                        <a href="#">
                            <!-- Icon Container -->
                            <span class="da-nav-icon">
                                <img src="images/icons/black/32/graph.png" alt="Estatísticas" />
                            </span>
                            Estatísticas
                        </a>
                        <ul class="closed">
                            <li><a href="statistic.html">Vendas</a></li>
                            <li><a href="charts.html">Usuários</a></li>
                            <li><a href="charts.html">Pedidos</a></li>
                            <li><a href="charts.html">Renda</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <li <?=($url[0] == 'dc-users' || $url[0] == 'dc-images' || $url[0] == 'dc-orders' || $url[0] == 'dc-products') ? 'class="active"' : ''?>>
                        <a href="#">
                            <!-- Icon Container -->
                            <span class="da-nav-icon">
                                <img src="images/icons/black/32/file_cabinet.png" alt="File Handling" />
                            </span>
                            Manutenção
                        </a>
                        <ul <?=($url[0] == 'dc-users' || $url[0] == 'dc-images' || $url[0] == 'dc-orders' || $url[0] == 'dc-products') ? 'class="open"' : 'class="closed"'?>>
                            <?php if ($user->getUserAccess() == 0) : ?>
                                <li <?=($url[0] == 'dc-images') ? 'class="active"' : ''?>><a href="dc-images">Imagens</a></li>
                                <li <?=($url[0] == 'dc-orders') ? 'class="active"' : ''?>><a href="dc-orders">Pedidos</a></li>
                                <li <?=($url[0] == 'dc-users') ? 'class="active"' : ''?>><a href="dc-users">Usuários</a></li>
                            <?php  endif;?>
                            <li <?=($url[0] == 'dc-products') ? 'class="active"' : ''?>><a href="dc-products">Produtos</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Main Content Wrapper -->
        <div id="da-content-wrap" class="clearfix">
<?php endif ?>

