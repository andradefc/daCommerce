<?php

/**
 * Create Session and Start
 */

session_name("dacommerce");
session_start();

/**
 * Call to Doctrine config file
 */
require_once '/../dc-config.php';
require_once ABSPATH.'/dc-functions.php';

$dc       = new \Functions\Dc();
$dc_site  = new \Functions\Dc_Content();
$dc_admin = new \Functions\DC_Admin();

define(DC_BASE, $dc->get_option('base_href'));
define(DC_ADMIN, $dc->get_option('base_href').'dc-admin/');
define(DC_CONTENT, $dc->get_option('base_href').'dc-content/');
define(DC_LIB, $dc->get_option('base_href')).'dc-lib/';

/**
 * Define permalinks structure
 */

$url = $dc->URL($_SERVER['REQUEST_URI'], 4, 'dc-login');

if(!$dc->getActivePage($url, ADMINPATH))
    header('Location: 404');

/**
 * Include website base file
 */
include ADMINPATH.'/'.$url[0].'.php';
