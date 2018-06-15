<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/6/15
 * Time: 11:08
 */
namespace wim\yii\oss;

class WimOss extends BaseOss
{
    /**
     * @return OssClient
     */
    public function getClient()
    {
        if ($this->_ossClient === null) {
            $this->setClient(new WimOssClient($this->accessKeyId,$this->accessKeySecret,$this->endpoint));
        }
        return $this->_ossClient;
    }
    /**
     * @param $object
     * @param $filepath
     */
    public function upload($object, $filePath)
    {
        return $this->getClient()->upload($this->bucket, $object, $filePath);
    }

}