<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/6/15
 * Time: 11:08
 */
namespace wim\yii\oss;

use OSS\OssClient;

class WimOss extends BaseOss
{
    /**
     * init
     */
    public function init()
    {
        parent::init();
        $this->_ossClient = $this->setClient(new WimOssClient($this->accessKeyId,$this->accessKeySecret,$this->endpoint));
    }

    /**
     * @param $object
     * @param $filepath
     */
    public function upload($object, $filePath)
    {
        return $this->getClient()->uploadFile($this->bucket, $object, $filePath);
    }

}