<?php

namespace Liqunx\Baidu\Ai;

use Liqunx\Baidu\Ai\Ocr\ServiceProvider as Ocr;
use Liqunx\Baidu\Kernel\ServiceContainer;

class Application extends ServiceContainer
{

    /**
     * @var array
     */
    protected $providers = [
        Ocr::class
    ];
}