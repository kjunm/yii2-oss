<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/6/15
 * Time: 14:07
 */
namespace wim\yii\oss\demo;

use wim\yii\oss\WimOss;

class UploadDemo
{
    /**
     * test upload
     */
    public function uploadImg($object,$filePath)
    {
        $oss = \Yii::createObject([
            'class' => WimOss::class,
            'accessKeyId' => 'LTAIsUqClBMCH14a',
            'accessKeySecret' => 'L4XCNmgyv8zdizT1ZfKpKcvPiSQtAU',
            'endpoint' => 'oss-cn-shenzhen.aliyuncs.com'
        ]);
        $response = $oss->upload($object,$filePath);
        return $response;
    }
}