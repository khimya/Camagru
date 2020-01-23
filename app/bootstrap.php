<?php
// Load Config
require_once 'config/config.php';
// loead helpers
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

// Autolload Core lovraries

spl_autoload_register(function ($className) {
  require_once 'libraries/' . $className . '.php';
});
