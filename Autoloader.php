<?php
/**
 * Created by PhpStorm.
 * User: Stefano
 * Date: 31/07/2017
 * Time: 20:59
 */

define('DIR', __DIR__);
define('DS', DIRECTORY_SEPARATOR);
define('CONTROLEUR', DIR . DS . 'Controleur');
define('MODELE', DIR . DS . 'Modele');
define('VUE', DIR . DS . 'Vue');

define('AUTOLOAD_CLASSES', serialize(array(CONTROLEUR, MODELE, VUE)));

 function loader($class)
    {
        $class_file = DIR . DS . $class . '.php';
        if(file_exists($class_file)) {
            require_once ($class_file);
        }else{
            foreach ( unserialize(AUTOLOAD_CLASSES) as $parh){
                $class_file = $parh . DS . $class . '.php';
                if (file_exists($class_file)) require_once ($class_file);
            }
        }
    }

spl_autoload_register('loader');

