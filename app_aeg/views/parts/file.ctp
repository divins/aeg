<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 11 Jan 2010 00:00:00 GMT"); // Don't change.
/*
if (stristr($filename,".swf"))
{
	header("Content-type: application/x-shockwave-flash");
}
else if (stristr($filename,".gif"))
{
    header("Content-type: image/gif");
}*/

//$tFilenameArray = explode( '.', $original_filename );

header("Content-type: x-application/x-gzip");
//header("Content-type: application/binary");
header("Content-Disposition: attachment; filename=\"".$filename.".gz\"" );
//header('Content-Transfer-Encoding: binary');
//header('Content-Encoding: x-gzip');

//$path=Configure::read("documents.path");   
$path="/var/www/clients/client3/web11/web/aeg_v2/files/exported_motors";  
readfile($path."/".$filename.".gz");
?>