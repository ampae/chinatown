<?php
/**
 * ChinaTown - LAMP SaaS FrameWork.
 * Complete User Registration and Management. Secure, Fast, Small and Light.
 *
 * THIS CODE ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY KIND,
 * EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A PARTICULAR PURPOSE.
 *
 * PHP version 7.2
 *
 * @version    GIT: <14.2.4>
 * @category   SaaS RAD LAMP FrameWork.
 * @see        https://ampae.com/chinatown/
 * @author     AMPAE <info@ampae.com>
 * @license    https://ampae.com/chinatown/license.txt
 * @copyright  2009 - 2020 AMPAE
**/

namespace Ampae\Lib;

/**
 * PSR-3 Implementation - Logger.
 *
 * @category Class
 *

 */
class Logger
{
    /** @var resource The stream resource being written to */
    private $stream = null;
    private $log_level;

    private $levels = array(
        'DEBUG' => 8,
        'INFO' => 7,
        'NOTICE' => 6,
        'WARNING' => 5,
        'ERROR' => 4,
        'CRITICAL' => 3,
        'ALERT' => 2,
        'EMERGENCY' => 1,
        'NO' => 0,
    );

    /**
     * constructor.
     */
    public function __construct($src = '')
    {
        $this->log_level = $this->levels[LOG_LEVEL];

        $trunk = 'a';

        if ('' == $src) {
            $src = ABSPATH.DIR_LOG.DIRECTORY_SEPARATOR.date('Y-m-d').'.log';
        }
        if ($this->log_level > 0) {
            $this->stream = @fopen($src, $trunk);
        } else {
            // echo 'Log Write Error';
        }
    }

    public function log($level, $message, array $context = [])
    {
        if ($this->log_level > 0 && $this->log_level >= $this->levels[$level]) {
            $log = $this->createLog($level, $message, $context);
            if ($this->stream) {
                fwrite($this->stream, $log);
            }
        }
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     */
    public function emergency($message, array $context = array())
    {
        $this->log('EMERGENCY', $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * @param string $message
     * @param array  $context
     */
    public function alert($message, array $context = array())
    {
        $this->log('ALERT', $message, $context);
    }

    /**
     * Critical conditions.
     *
     * @param string $message
     * @param array  $context
     */
    public function critical($message, array $context = array())
    {
        $this->log('CRITICAL', $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     */
    public function error($message, array $context = array())
    {
        $this->log('ERROR', $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * @param string $message
     * @param array  $context
     */
    public function warning($message, array $context = array())
    {
        $this->log('WARNING', $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     */
    public function notice($message, array $context = array())
    {
        $this->log('NOTICE', $message, $context);
    }

    /**
     * Interesting events.
     *
     * @param string $message
     * @param array  $context
     */
    public function info($message, array $context = array())
    {
        $this->log('INFO', $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     */
    public function debug($message, array $context = array())
    {
        $this->log('DEBUG', $message, $context);
    }

    /**
     * Return created log message.
     *
     * @param string $level
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    private function createLog($level, $message, array $context)
    {
        $log = [];
        $log[] = '['.date('Y-m-d H:i:s').']';
        $log[] = ' - {'.$this->levels[$level].'} = '.$level.':';
        $log[] = strtr($message, $context);

        return implode('', $log).PHP_EOL;
    }

    /**
     * Return microtime now.
     *
     * @return float
     */
    public function getMicrotime()
    {
        list($usec, $sec) = explode(' ', microtime());

        return (float) $usec + (float) $sec;
    }
}
