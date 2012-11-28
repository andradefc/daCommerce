<?php

namespace daCommerce;

use Doctrine\Common\ClassLoader,
    Doctrine\ORM\Configuration,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\Cache\ApcCache,
    Entities\User, Entities\Address;

error_reporting(E_ALL & ~E_NOTICE);

/**
 * Define paths to project
 */
define(ABSPATH,     dirname(__FILE__));
define(ADMINPATH,   dirname(__FILE__).'/dc-admin');
define(CONTENTPATH, dirname(__FILE__).'/dc-content');
define(LIBPATH,     dirname(__FILE__).'/dc-lib');

/**
 * Call main Doctrine file
 */
require_once LIBPATH.'/Doctrine/Common/ClassLoader.php';

/**
 * Load classes
 */
$classLoader = new ClassLoader('Doctrine\ORM', LIBPATH);
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\DBAL', LIBPATH);
$classLoader->register();
$classLoader = new ClassLoader('Doctrine\Common', LIBPATH);
$classLoader->register();

/**
 * Load Entities and Proxies
 */
$classLoader = new ClassLoader('Entities', LIBPATH);
$classLoader->register();
$classLoader = new ClassLoader('Proxies', LIBPATH);
$classLoader->register();

/**
 * Set Configuration
 */
$config = new Configuration;
// $cache = new ApcCache;
// $config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(array(LIBPATH."Entities"));
$config->setMetadataDriverImpl($driverImpl);
// $config->setQueryCacheImpl($cache);

/**
 * Proxy
 */
$config->setProxyDir(LIBPATH.'Proxies');
$config->setProxyNamespace('Proxies');
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);

/**
 * DB Connection
 */
$connectionOptions = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'localhost',
    'dbname'   => 'dacommerce',
    'user'     => 'root',
    'password' => ''
);

/**
 * Create EntityManager
 */
$em = EntityManager::create($connectionOptions, $config);

/**
 * Default timezone
 */
date_default_timezone_set('America/Sao_Paulo');
