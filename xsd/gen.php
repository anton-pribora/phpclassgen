#!/usr/bin/php
<?php

spl_autoload_register(function($class) {
    $file = __DIR__ .'/../classes/'. strtr($class, '\\', '/') .'.php';
    
    if ( is_readable($file) )
        include $file;
});

function toXsdClassName($file)
{
    $basename = basename($file);
    $purename = preg_replace('/\..*/', '', $basename);
    
    $className = 'Xsd'. ucfirst($purename);
    
    return $className;
}

foreach (glob(__DIR__ .'/schemas/*.php') as $file)
{
    $class = toXsdClassName($file);
    
    ob_start();
    include $file;
    $summary = ob_get_clean();
    
    $generator = new CbXsd($summary, $class);
    
    echo "$file => $class ... ";
    file_put_contents(__DIR__ .'/../classes/'. $class .'.php', "<?php\n". $generator->createClass()->__toString());
    echo "ok\n";
}
