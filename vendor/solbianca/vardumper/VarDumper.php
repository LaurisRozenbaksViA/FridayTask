<?php

namespace Solbianca\VarDumper;

class VarDumper
{
    /**
     * Simple variable dump.
     *
     * @param  mixed $arguments
     */
    public static function d(... $arguments)
    {
        if (empty($arguments)) {
            return;
        }

        foreach ($arguments as $argument) {
            echo '<div style="background:#f8f8f8;margin:5px;padding:5px;border: solid grey 1px;">' . PHP_EOL;
            echo self::dtrace();
            echo '<pre style="margin:0px;padding:0px;">' . PHP_EOL;
            var_dump($argument);
            echo '</pre>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
        }
    }

    /**
     * Dump variable and die.
     *
     * @param  mixed $arguments
     */
    public static function dd(... $arguments)
    {
        if (empty($arguments)) {
            echo self::dtrace();
            die();
        }

        foreach ($arguments as $argument) {
            self::d($argument);
        }
        die();
    }

    /**
     * Simple print variable.
     *
     * @param  mixed $arguments
     */
    public static function p(... $arguments)
    {
        if (empty($arguments)) {
            return;
        }

        foreach ($arguments as $argument) {

            echo '<div style="background:#f8f8f8;margin:5px;padding:5px;border: solid grey 1px;">' . PHP_EOL;
            echo self::dtrace();
            echo '<pre style="margin:0px;padding:0px;">' . PHP_EOL;
            print_r($argument);
            echo '</pre>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
        }
    }

    /**
     * Print variable and die.
     *
     * @param  mixed $arguments
     */
    public static function pd(... $arguments)
    {
        if (empty($arguments)) {
            echo self::dtrace();
            die();
        }

        foreach ($arguments as $argument) {
            self::p($argument);
        }
        die();
    }

    /**
     * Dump variable as string.
     *
     * @param  mixed $arguments
     */
    public static function ds(... $arguments)
    {
        if (empty($arguments)) {
            return;
        }

        foreach ($arguments as $argument) {
            echo '<div style="background:#fafafa;margin:5px;padding:5px;border: solid grey 1px;">' . PHP_EOL;
            echo self::dtrace();
            echo '<pre style="margin:0px;padding:0px;">' . PHP_EOL;
            if (is_object($argument)) {
                var_dump('Class: ' . get_class($argument));
            } elseif (is_array($argument)) {
                var_dump('Array{' . count($argument) . '}');
            } else {
                var_dump((string)$argument);
            }
            echo '</pre>' . PHP_EOL;
            echo '</div>' . PHP_EOL;
        }
    }

    /**
     * Dump variable as string and die.
     *
     * @param  mixed $arguments
     */
    public static function dsd(... $arguments)
    {
        if (empty($arguments)) {
            echo self::dtrace();
            die();
        }

        foreach ($arguments as $argument) {
            self::ds($argument);
        }
        die();
    }

    /**
     * Print peak memory usage.
     *
     */
    public static function dmem()
    {
        echo '<div style="background:#fafafa;margin:5px;padding:5px;border: solid grey 1px;">' . PHP_EOL;
        echo self::dtrace();
        echo '<pre style="margin:0px;padding:0px;">' . PHP_EOL;
        echo sprintf('%sK of %s', round(memory_get_peak_usage() / 1024), ini_get('memory_limit'));
        echo '</pre>' . PHP_EOL;
        echo '</div>' . PHP_EOL;
    }

    /**
     * Measure execution time.
     *
     * @param array $timers
     * @param int $status
     * @param string $label
     */
    public static function dtimer(&$timers, $status = 0, $label = null)
    {
        if (!is_array($timers) || $status === -1) {
            $timers = array();
        }
        $where = self::dtrace();
        if (null !== $label) {
            $where = $label . ' - ' . $where;
        }
        $timers[] = array('where' => $where, 'time' => microtime(true));
        if ($status === 1) {
            echo '<table style="border-color: black;" border="1" cellpadding="3" cellspacing="0">';
            echo '<tr style="background-color:black;color:white;"><th>Trace</th><th>dT [ms]</th><th>dT(cumm) [ms]</th></tr>';
            $lastTime = $timers[0]['time'];
            $firstTime = $timers[0]['time'];
            foreach ($timers as $timer) {
                echo sprintf('<tr><td>%s</td><td>%s</td><td>%s</td></tr>',
                    $timer['where'],
                    sprintf('%01.6f', round(($timer['time'] - $lastTime) * 1000, 6)),
                    sprintf('%01.6f', round(($timer['time'] - $firstTime) * 1000, 6))
                );
                $lastTime = $timer['time'];
            }
            echo '</table>';
        }
    }

    /**
     * Backtrace.
     *
     * @return string backtrace
     */
    private static function dtrace()
    {
        $bt = debug_backtrace();
        while (!isset($bt[0]['file']) || $bt[0]['file'] === __FILE__) {
            array_shift($bt);
        }
        $trace = $bt[0];
        $line = $trace['line'];
        $file = basename($trace['file']);
        $function = $trace['function'];
        $class = (isset($bt[1]['class']) ? $bt[1]['class'] : basename($trace['file']));
        if (isset($bt[1]['class'])) {
            $type = $bt[1]['type'];
        } else {
            $type = ' ';
        }
        $function = isset($bt[1]['function']) ? $bt[1]['function'] : '';

        return sprintf('%s%s%s() line %s <small>(in %s)</small>', $class, $type, $function, $line, $file);
    }
}

function __d()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'd'), $args);
}

function __dd()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'dd'), $args);
}

function __p()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'p'), $args);
}

function __pd()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'pd'), $args);
}

function __ds()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'ds'), $args);
}

function __dsd()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'dsd'), $args);
}

function __dtrace()
{
    $args = func_get_args();
    call_user_func_array(array('VarDumper', 'dtrace'), $args);
}