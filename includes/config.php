<?php 

/**
 * Configuración del soporte de UTF-8, localización (idioma y país) y zona horaria
 */
ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');

/*PARAMETROS DE CONEXION A LA BD*/
define('BD_HOST', 'localhost');
define('BD_NAME', 'social-museum');
define('BD_USER', 'social-museum');
define('BD_PASS', 'social-museum');


// Varios defines para los parámetros de configuración de acceso a la BD y la URL desde la que se sirve la aplicación
//define('BD_HOST', 'localhost');
//define('BD_NAME', 'social-museum');
//define('BD_USER', 'user');
//define('BD_PASS', 'userpass');
define('RUTA_APP', '/htdocs/Practica3');
define('RUTA_IMGS', RUTA_APP.'/img');
define('RUTA_CSS', RUTA_APP.'/css');
define('RUTA_JS', RUTA_APP.'/js');
define('INSTALADA', true );

/*AUTOCARGA DE CLASES*/
spl_autoload_register(function ($class) {
    
    // project-specific namespace prefix
    $prefix = 'es\\ucm\\fdi\\aw\\';
    
    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';
    
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    // get the relative class name
    $relative_class = substr($class, $len);
    
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

/*INICIALIZACION DE LA APLICACION*/
$app = es\ucm\fdi\aw\Aplicacion::getInstance();
$app->init(array('host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS));

/*CIERRE DE LA APLICACION*/
register_shutdown_function(array($app, 'shutdown'));