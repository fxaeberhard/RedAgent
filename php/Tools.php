<?php

function file_extension($filename) {
    return strtolower(end(explode(".", $filename)));
}

function getMimeType($filename) {
    $ext = file_extension($filename);
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
        case 'jpe': return'image/jpg';
        case 'png': return'image/png';
        case 'gif': return 'image/gif';
        case 'js': return 'application/x-javascript';
        case 'css': return 'text/css';
        case "mp3": return "audio/mpeg";
        case "mpg": return "video/mpeg";
        case "avi": return "video/x-msvideo";
        case "wmv": return "video/x-ms-wmv";
        case "wma": return "audio/x-ms-wma";
        case 'flv': return "video/flv";
        default: return "application/force-download";
    }
}

function listdir($dir = '.') {
    if (!is_dir($dir)) {
        return false;
    }

    $files = array();
    listdiraux($dir, $files);

    return $files;
}

function listdiraux($dir, &$files) {
    $handle = opendir($dir);
    while (($file = readdir($handle)) !== false) {
        if ($file == '.' || $file == '..') {
            continue;
        }
        $filepath = $dir == '.' ? $file : $dir . '/' . $file;
        if (is_link($filepath))
            continue;
        if (is_file($filepath))
            $files[] = $filepath;
        // else if (is_dir($filepath))
        //   listdiraux($filepath, $files);
    }
    closedir($handle);
}

function getFileContent($fileName) {
    if ($this->fileExists($fileName)) {
        $file = $this->open($fileName, "r");
        while (!feof($file)) {
            $retour .= fgets($file, 4096);
        }
        fclose($file);
        return $retour;
    }
    else
        return null;
}
$cookie_name = 'Program_O_JSON_GUI';
function get_convo_id() {
    global $cookie_name;
    session_name($cookie_name);
    session_start();
    $convo_id = session_id();
    session_destroy();
    setcookie($cookie_name, $convo_id);
    return $convo_id;
}

?>