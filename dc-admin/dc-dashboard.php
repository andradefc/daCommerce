<?php

/**
 * Configuration from Page
 */
$page_title = "Dashboard";

if ($_SESSION['logged'] !== true)
    header('Location: dc-login');
?>

<?php $dc_admin->get_header(); ?>

<?php
if ($_SESSION['logged'] === true){
    $user = $em->find('\Entities\User', $_SESSION['user']);
    if (!$user)
        header('Location: dc-logout');
}
?>
<!-- Content Area -->
<div id="da-content-area">
    <div class="grid_3">
        <ul class="da-circular-stat-wrap">
            <li class="da-circular-stat {fillColor: '#a6d037', percent: true, value: 55, maxValue: 100, label: 'Aumento de vendas'}"></li>
            <li class="da-circular-stat {fillColor: '#ea799b', value: 200, maxValue: 540, label: 'Meta de vendas'}"></li>
            <li class="da-circular-stat {fillColor: '#fab241', percent: true, value: 120, maxValue: 253, label: 'Novos usuários'}"></li>
            <li class="da-circular-stat {fillColor: '#61a5e4', value: 1200, maxValue: 6000, label: 'Meta de acessos'}"></li>
        </ul>
    </div>

    <div class="grid_1">
        <div class="da-panel-widget">
            <h1>Compras e cadastros</h1>
            <ul class="da-summary-stat">
                <li>
                    <a href="#">
                        <span class="da-summary-icon" style="background-color:#e15656;">
                            <img src="images/icons/white/32/truck.png" alt="" />
                        </span>
                        <span class="da-summary-text">
                            <span class="value up">211</span>
                            <span class="label">Entregas</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="da-summary-icon" style="background-color:#a6d037;">
                            <img src="images/icons/white/32/sport_shirt.png" alt="" />
                        </span>
                        <span class="da-summary-text">
                            <span class="value down">512</span>
                            <span class="label">Roupas</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="da-summary-icon" style="background-color:#ea799b;">
                            <img src="images/icons/white/32/abacus.png" alt="" />
                        </span>
                        <span class="da-summary-text">
                            <span class="value up">286</span>
                            <span class="label">Transações</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="da-summary-icon" style="background-color:#61a5e4;">
                            <img src="images/icons/white/32/shopping_basket_2.png" alt="" />
                        </span>
                        <span class="da-summary-text">
                            <span class="value">1200</span>
                            <span class="label">Vendas totais</span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="da-summary-icon" style="background-color:#656565;">
                            <img src="images/icons/white/32/users_2.png" alt="" />
                        </span>
                        <span class="da-summary-text">
                            <span class="value">266</span>
                            <span class="label">Usuários</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>
</div>

<?php $dc_admin->get_footer(); ?>