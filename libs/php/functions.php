<?php

function createConfig($configFile, $configData)
{
    $content = "<?php\n//autoconfig\n/*\n";
    foreach ($configData as $section=>$values) {
        $content .= "\n[".$section."]\n";
        foreach ($values as $key=>$value) {
            $content .= $key."=".$value."\n";
        }
    }
    $content .= "*/\n";

    if (!$handle = fopen($configFile, 'w')) {
        return false;
    }

    $success = fwrite($handle, $content);
    fclose($handle);
}

function readConfig($configFile,$setup=0)
{
    $tmp = array();
    if (file_exists($configFile)) {
      $tmp = parse_ini_file($configFile, true);
    } else if(DEBUG_MODE) {
      setupConfig($configFile);
    }

//!!! TODO: add function

    if (isset($tmp['define'])) {
      foreach ($tmp['define'] as $key=>$value) {
        define($key,$value);
      }
      unset($tmp['define']);
    }

    if (isset($tmp['php_ini_set'])) {
      foreach ($tmp['php_ini_set'] as $key=>$value) {
        ini_set($key,$value);
      }
      unset($tmp['php_ini_set']);
    }

    return $tmp;
}

function setupConfig($configFile) {
  $configData = array(
  'define' => array(
    'DEBUG_MODE'=>true,
    'APP_ENCODING'=>'UTF-8',
    'DEF_VENDOR'=>'ampae',
    'DEF_THEME'=>'default',

    'APP_COOKIE_PREFIX'=>'ct',

    'DIR_APP'=>'app',
    'DIR_ASSETS'=>'assets',
    'DIR_LOG'=>'log',
    'DIR_UPLOADS'=>'uploads',

    'DIR_PACKS'=>'packages',
    'DIR_THEMES'=>'themes',

    'DIR_LIB'=>'lib',
  ),
  'php_ini_set' => array(
    'magic_quotes_runtime'=>'off',
    'register_globals'=>'off',
    'memory_limit'=>'64M',
    'max_execution_time'=>300,
    'display_errors'=>0,
  ),
  );
  createConfig($configFile, $configData);
}
