<?php

/*
 * This file is part of the liqunx/laravel-baidu.
 *
 * (c) liqunx <i@liqunx.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Liqunx\Baidu;

use Liqunx\Baidu\Kernel\ServiceContainer;

/**
 * Class Factory.
 *
 * @method static \Liqunx\Baidu\Ai\Application            aip(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return \Liqunx\Baidu\Kernel\ServiceContainer
     */
    public static function make($name, array $config): ServiceContainer
    {
        $namespace = self::studly($name);
        $application = "\\Liqunx\\Baidu\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }

    /**
     * Convert a value to studly caps case.
     *
     * @param string $name
     *
     * @return string
     */
    private static function studly($name = 'aip'): string
    {
        if ('aip' === $name) {
            $name = 'ai';
        }
        $name = ucwords(str_replace(['-', '_'], ' ', $name));

        return str_replace(' ', '', $name);
    }
}
