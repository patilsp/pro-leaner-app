<?php

// Includes
require "config.php";

// Command
$command = "_" . (empty($_POST["command"]) ? "Empty" : trim($_POST["command"]));
if (function_exists($command)) {
    $command();
} else {
    die("Error: Invalid AJAX request");
}

function _delete()
{
    $base = trim(config("directory"), "\\/ ");
    $dir = trim($_POST["directory"], "\\/. ");
    $name = trim($_POST["name"], "\\/. ");
    $file = __DIR__ . "/../" . $base . "/" . $dir . "/" . $name;
    if (file_exists($file)) {
        if (is_writable($file)) {
            if (is_dir($file)) {

                function delete_dir($dir)
                {
                    foreach (glob($dir . '/*') as $file) {
                        if (is_dir($file)) delete_dir($file); else unlink($file);
                    }
                    rmdir($dir);
                }

                delete_dir($file);
            } else {
                unlink($file) or die("Error: Cannot delete the file");
            }
            die("done");
        } else {
            die("Error: Cannot delete file, it's not writable.");
        }
    } else {
        die("Error This file no longer exists.");
    }
}

function _rename()
{
    $base = trim(config("directory"), "\\/ ");
    $dir = trim($_POST["directory"], "\\/. ");
    $old = trim($_POST["name"], "\\/. ");
    $new = trim($_POST["rename"], "\\/. ");
    $old = __DIR__ . "/../" . $base . "/" . $dir . "/" . $old;
    $new = __DIR__ . "/../" . $base . "/" . $dir . "/" . $new;
    if (file_exists($new)) die("Error: This file or folder already exists.");
    if (file_exists($old)) {
        rename($old, $new) or die("Error: Cannot rename the file.");
        die("done");
    } else {
        die("Error This file no longer exists.");
    }
}

function _folder()
{
    $base = trim(config("directory"), "\\/ ");
    $dir = trim($_POST["directory"], "\\/. ");
    $name = trim($_POST["name"], "\\/. ");
    $folder = __DIR__ . "/../" . $base . "/" . $dir . "/" . $name;
    if (file_exists($folder)) die("Error: This folder already exists.");
    mkdir($folder) or die("Error: Cannot create new folder here.");
    die("done");
}