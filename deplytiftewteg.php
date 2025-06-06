<?php
// Set your repo directory
$repoDir = '/home/isegfwv5mjki/public_html/';

// Change to that directory
chdir($repoDir);

// Pull the latest code
$output = shell_exec('git pull 2>&1');

echo "<pre>$output</pre>";
?>
