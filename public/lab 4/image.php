<?php
$max_age = 86400; 
header('Content-Type: image/svg+xml'); 
header('Cache-Control: public, max-age=' . $max_age);
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $max_age) . ' GMT');
?>
<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100">
  <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
</svg>