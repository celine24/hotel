<?php
function autoload($class)
{
    $file = str_replace("\\", "/", $class) . ".php";
    if (file_exists($file)) {
        require_once $file;
    } else {
        $flash = new \Vendor\Flash();
        $flash->add('La classe' . $file . 'n\'a pas été trouvée');
    }
}
spl_autoload_register("autoload");