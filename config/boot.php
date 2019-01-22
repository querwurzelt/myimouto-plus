<?php
/**
 * Working environment.
 */
if (!defined('RAILS_ENV')) {
    define('RAILS_ENV', 'production');
}

/**
 * Application's root directory.
 */
define('RAILS_ROOT', dirname(__DIR__));

/**
 * Path to Rails.
 */
$railsPath = dirname(__DIR__, 1) . '/vendor/railsphp/railsphp/lib/Rails';

/**
 * Load and initialize Rails.
 */
require $railsPath . '/Rails.php';
Rails::initialize();

/**
 * Load and initialize application.
 */
require __DIR__ . '/application.php';
MyImouto\Application::initialize();
