<?php
declare(strict_types=1);
use Benfrom09\CBD\CBDTheme;


//autoloading classes
require_once __DIR__ . '/vendor/autoload.php';

//init theme
$theme = new CBDTheme();
$theme->run();