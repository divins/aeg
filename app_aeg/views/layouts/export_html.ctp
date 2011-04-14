<?php
//$path = '/home/someuser/products/data.tar.gz'; // the file made available for download via this PHP file
$mm_type="application/octet-stream"; // modify accordingly to the file type of $path, but in most cases no need to do so

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: " . $mm_type);
header("Content-Length: " .(string)(filesize($file.".gz")) );
header('Content-Disposition: attachment; filename="'.basename($file.".gz").'"');
header("Content-Transfer-Encoding: binary\n");
readfile($file.".gz"); // outputs the content of the file

exit();
?>