<?php

$path = "../uploads/";
$handle=opendir($path);
echo "<table>";
while (($file = readdir($handle))!==false) {
	if (is_dir($path . $file))
		continue;

	$size = filesize($path . $file);
	if ($size > 1000000000)
		$size = substr($size / 1000000000, 0, 4) . "G";
	else if ($size > 1000000)
		$size = substr($size / 1000000, 0, 4) . "M";
	else if ($size > 1000)
		$size = substr($size / 1000, 0, 4) . "K";
		
		
    echo "<tr><td>$file</td><td>$size</td></tr>\n";
}
echo "</table>";
closedir($handle); 
?>