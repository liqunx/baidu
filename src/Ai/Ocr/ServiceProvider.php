<?php
namespace Liqunx\Baidu\Ai\Ocr;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        !isset($app['ocr']) && $app['ocr'] = function ($app) {
            return new Client($app);
        };
    }
}