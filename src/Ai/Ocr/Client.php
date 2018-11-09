<?php

namespace Liqunx\Baidu\Ai\Ocr;

use Mockery\Exception;
use Pimple\Container;

class Client
{
    public function __construct(Container $app)
    {
        $this->app = $app;

        $config = $this->getConfig();

        $this->ocr = new \AipOcr($config['app_id'], $config['api_key'], $config['secret']);
    }

    protected function getConfig() :array
    {
        return $this->app->getConfig();
    }

    public function __call($name, $arguments) :array
    {
        if (method_exists($this->ocr, $name)) {
            $result = call_user_func_array([$this->ocr, $name], $arguments);
            if ($content = $this->shouldTranslate($result)) {
                $result = $this->translateIntoEnglish($content, $name);
            }
            return $result;
        }
        throw new Exception('method not found');
    }

    private function shouldTranslate(array $result)
    {
        $content = json_encode($result);
        if (preg_match('/\\\\u([0-9a-f]{4})/i', $content)) {
            return $content;
        }
        return false;
    }

    private function translateIntoEnglish($content, $name = 'idcard') :array
    {
        $search = $this->getSearch($name);
        $replace = $this->getReplace($name);
        $content = str_replace($search, $replace, $content);
        return json_decode($content, true);
    }

    private function getSearch($name) :array
    {
        $search = [
            'idcard' => [
                '\\u4f4f\u5740', //地址
                '\\u516c\\u6c11\\u8eab\\u4efd\\u53f7\\u7801', // 公民身份证号
                '\\u51fa\\u751f', //出生
                '\\u59d3\\u540d', //姓名
                '\\u6027\\u522b', //性别
                '\\u6c11\\u65cf', // 民族
                '\\u7b7e\\u53d1\\u65e5\\u671f', //签发日期
                '\\u7b7e\\u53d1\\u673a\\u5173', //签发机关
                '\\u5931\\u6548\\u65e5\\u671f', //失效日期
            ],
            'businessLicense' => [
                '\\u5355\\u4f4d\\u540d\\u79f0', //单位名称
                '\\u6cd5\\u4eba', //法人
                '\\u4f4f\u5740', //地址
                '\\u6709\\u6548\\u671f', //有效期
                '\\u8bc1\\u4ef6\\u7f16\\u53f7', // 证件编号
                '\\u793e\\u4f1a\\u4fe1\\u7528\\u4ee3\\u7801', // 社会信用代码
            ]
        ];
        if (array_key_exists($name, $search)) {
            return $search[$name];
        }
        return [];
    }

    private function getReplace($name) :array
    {
        $replace = [
            'idcard' => [
                'address','id', 'birth_day', 'name', 'gender', 'nation', 'issue', 'organization', 'expiration',
            ],
            'businessLicense' => [
                'company', 'corporation ', 'address', 'expiration', 'number', 'code',
            ],
        ];
        if (array_key_exists($name, $replace)) {
            return $replace[$name];
        }
        return [];
    }
}