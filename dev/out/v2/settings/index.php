<?php
if (!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}
?>
<h1>Settings</h1>
<?php
print_r($controller->argv);
?>
<p>settings</p>
