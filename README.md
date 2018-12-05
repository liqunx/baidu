# baidu sdk via composer

百度SDK composer版本

### 目前已集成功能

- AI模块
  - OCR 文字识别 [参考链接](https://ai.baidu.com/docs#/OCR-API/top)
  
### 此包不能直接使用，是liqunx/laravel-baidu包的配套产品

### 使用方法

- ocr使用方法
    1. 通过laravl-baidu包的Facade获取AI模块实例
        ```php
        $ai = Facade::aip();
        ```
    2. 调用ai模块下的ocr功能
        ```php
        $ocr = Facade::aip()->ocr;
        ```
    3. `$ocr`则是百度SDK中AipOoc类的实例，具体方法请参考[百度文档](https://ai.baidu.com/docs#/OCR-API/top)
        
        例如调用身份证识别：
        ```php
        $image = file_get_contents('http://i9.hexunimg.cn/2015-07-02/177227394.jpg'); // 正面测试图片
        $idCardSide = 'front'; // 正面
        $result = $ocr->idcard($image, $idCardSide);
        ```
        
- others
