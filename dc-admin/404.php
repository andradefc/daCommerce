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

<title>daCommerce | Página não encontrada</title>

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

    <div id="da-wrapper" class="fluid">
        <div id="da-content">
            <div class="da-container clearfix">

                <div id="da-error-wrapper">

                    <div id="da-error-pin"></div>
                    <div id="da-error-code">
                        Não encontrado <span>:(</span>
                    </div>

                    <h1 class="da-error-heading">Não encontramos a página procurada</h1>
                    <p>Volte para o painel de adminitração e procure pelo que desejar. <br/><br/> <a href="dc-dashboard">Clique aqui</a></p>
                </div>

            </div>

        </div>

        <!-- Footer -->
        <div id="da-footer">
            <div class="da-container clearfix">
                <p>Copyright <?=date('Y')?>. daCommerce. Todos direitos reservados.</p>
            </div>
        </div>

    </div>

</body>
</html>

