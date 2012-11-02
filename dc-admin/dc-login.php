<?php

/**
 * Configuration from Page
 */
$page_title = "Login";

if ($_SESSION['logged'] === true)
    header('Location: dc-dashboard');
?>

<?php $dc_admin->get_header(); ?>

<?php if ($_GET['login'] == 'fail'): ?>
    <div class="error">Usuário/Senha não conferem!</div>
<?php endif ?>

<div id="da-login">
    <div id="da-login-box-wrapper">
        <div id="da-login-top-shadow">
        </div><!-- #da-login-top-shadow -->
        <div id="da-login-box">
            <div id="da-login-box-header">

                <img src="images/logo.png" width="200" alt="daCommerce" title="daCommerce" />

            </div><!-- #da-login-box-header -->
            <div id="da-login-box-content">
                <?php
                /**
                 * Call to Login Form
                 */

                $dc->login_form();
                ?>
            </div><!-- #da-login-box-content -->
            <div id="da-login-box-footer">
                <a href="#" title="Esqueceu sua senha?">Esqueceu sua senha?</a>
                <div id="da-login-tape">
                </div><!-- #da-login-tape -->
            </div><!-- #da-login-box-footer -->
        </div><!-- #da-login-box -->
        <div id="da-login-bottom-shadow">
        </div><!-- #da-login-bottom-shadow -->
    </div><!-- #da-login-box-wrapper -->
</div><!-- #da-login -->

<?php $dc_admin->get_footer(); ?>