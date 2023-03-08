<?php

function config($name)
{
	// Load configuration file into $config
    $config_file = realpath(__DIR__ . "/../config.ini");
    if (!file_exists($config_file)) exit("Error: Cannot find config.ini file");
   	$config = parse_ini_file($config_file) or die("Error: Config file is broken");
    // Find requested element in the configurations
    $element = $config[$name] or die("Error: $name is not declared in config.ini");
    return $element;
}