<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/6/15
 * Time: 13:57
 */
namespace wim\yii\oss\tests;
use PHPUnit\Framework\TestCase;
use wim\yii\oss\demo\UploadDemo;

class test extends TestCase
{
    public function testUpload()
    {
        $uploadDemo = new UploadDemo();
        $response = $uploadDemo->uploadImg('1.jpg', '/vagrant/www/1.jpg');
        $this->assertInstanceOf('yii\httpclient\Client', $response);
    }
}
