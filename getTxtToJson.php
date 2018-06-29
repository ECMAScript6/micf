<?php
$myfile = fopen("status.txt", "r+") or die("Unable to open file!");
echo '{"pc_status":"';
echo fgets($myfile);
echo '"}';
fclose($myfile);