<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/6/15
 * Time: 11:10
 */
namespace wim\yii\oss;

use OSS\OssClient;

class WimOssClient extends OssClient
{
    public function upload($bucket,$object, $filePath)
    {
        return $this->uploadFile($bucket, $object, $filePath);
    }


}