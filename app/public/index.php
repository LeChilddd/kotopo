<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

if($_SERVER['APP_MAINTENANCE'] ?? $_ENV['APP_MAINTENANCE'] ?? false) {
    echo "<html><body><h1>Upgrade in progress. Please retry in a few seconds.</h1></body></html>";
    die;
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
