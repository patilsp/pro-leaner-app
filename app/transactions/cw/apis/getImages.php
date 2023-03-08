<?php
// Includes
require "system/config.php";

// Start session
session_start();

try{
    // Load needed environment variables
    $base_directory = realpath(__DIR__ . DIRECTORY_SEPARATOR . config("directory")) . "/";
    $base_link = trim(config("link"), "/ ");
    $internal_directory = empty($_GET["d"]) ? "" : trim(urldecode($_GET["d"]), "./\\ ");
    $current_directory = $base_directory . $internal_directory . DIRECTORY_SEPARATOR;
    $back_directory = substr($internal_directory, 0, strrpos($internal_directory, "/"));

    // Load directory content
    $list = array();
    if (file_exists($current_directory)) $list = scandir($current_directory);
    $folders = array();
    $files = array();
    foreach ($list as $item) {
        if (is_dir($current_directory . $item) && $item != "." && $item != "..") {
            $folders[] = array(
                "name" => $item,
                "path" => $current_directory . $item,
                "url" => ltrim($internal_directory . "/", "/") . $item,
            );
        } else if (is_file($current_directory . $item)) {
            $mime = mime_content_type($current_directory . $item);
            if ($mime == "application/pdf") {
                $icon = "pdf.ico";
            } else if (preg_match("@^image/@i", $mime)) {
                $icon = "image.ico";
            } else if (preg_match("@^audio/@i", $mime)) {
                $icon = "audio.ico";
            } else if (preg_match("@^video/@i", $mime)) {
                $icon = "video.ico";
            } else {
                $icon = "unknown.ico";
            }
            $files[] = array(
                "name" => $item,
                "path" => $current_directory . $item,
                "link" => $base_link . $internal_directory . "/" . $item,
                "type" => $mime,
                "size" => round(filesize($current_directory . $item) / 1024) . " KB",
                "icon" => $icon,
            );
        }
    }
    $data = "";
    if (count($files) || count($folders)) {
        $data .='
        <table class="table table-responsive table-bordered table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>File Size</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>';
            foreach ($folders as $item) {
                $data .='
                <tr data-name='.$item["name"].'>
                    <td>
                        <img src="apis/img/folder.ico" class="hidden-xs">
                        <a href="?d='.$item["url"].'">'.$item["name"].'</a>
                    </td>
                    <td><span>folder</span></td>
                    <td><span>-</span></td>
                    <td>
                        <button class="btn btn-default rename">Rename</button>
                        <button class="btn btn-danger del">Delete</button>
                    </td>
                </tr>';
            }
            foreach ($files as $item) {
                $data.='
                <tr data-name="'.$item["name"].'">
                    <td>
                        <img src="apis/img/'.$item["icon"].'" class="hidden-xs">
                        <a href="'.$item["link"].'">'.$item["name"].'</a>
                    </td>
                    <td><span>'.$item["type"].'</span></td>
                    <td><span>'.$item["size"].'</span></td>
                    <td>
                        <label class="checked_btn btn btn-danger d-block mx-auto">
                          <input type="radio" class="imgpath" name="imgpath" value="'.$$item["link"].'"autocomplete="off"> '.$item["name"].'
                        </label>
                    </td>
                </tr>';
            }
            $data.='
            </tbody>
        </table>
        ';
    } else {
        $data .='
        <div class="well well-lg text-center"><strong>This folder is empty!</strong></div>
        ';
    }

    echo $data;
}catch(Exception $exp){
    print_r($exp);
    return "false";
}
?>