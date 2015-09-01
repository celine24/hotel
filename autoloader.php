<?php
function autoload($class)
{
    $file = '../../class/' . $class . '.php';
    if (file_exists($file)) 
    {
        require_once $file;
    } 
    else 
    {
        echo 'La classe ' . $file . ' n\'a pas été trouvée :(';
    }
}
spl_autoload_register("autoload");