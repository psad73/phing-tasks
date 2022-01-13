<?php

$file = filter_input(INPUT_POST, "file");
$dest = filter_input(INPUT_POST, "dest");
$loc = filter_input(INPUT_POST, "loc");

$archiveFullname = preg_replace('/([^:])(\/{2,})/', '$1/', $loc . $file);
echo $archiveFullname;
$zip = new ZipArchive();
$res = $zip->open($archiveFullname);
if ($res === TRUE) {
    $zip->extractTo($dest);
    $zip->close();
    if (is_file($archiveFullname)) {
        unlink($archiveFullname);
    }
    echo "UnzipSuccess";
} else {
    echo "UnzipFailed";
}
if (is_file("unzip.php")) {
    unlink("unzip.php");
}

