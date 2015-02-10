<?php
$myfile = fopen("newfile2.txt", "w") or die("Unable to open file!");
$txt = "kkk\n";
fwrite($myfile, $txt);
$txt = "kkk\n";
fwrite($myfile, $txt);
fclose($myfile);
?>