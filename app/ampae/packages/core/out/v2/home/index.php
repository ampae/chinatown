<?php
if (!defined('ABSPATH')) {
    header('HTTP/1.0 403 Forbidden');
    exit;
}

//print_r($model->results['local']);
echo $local->translate('hello');
