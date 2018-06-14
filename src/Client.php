<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/5/29
 * Time: 16:37
 */
namespace wim\yii\oss;

use Yii;
use OSS\OssClient;

class Client
{
    /**
     * @var accessKeyId
     */
    private $accessKeyId;
    /**
     * accessKeySecret
     */
    private $accessKeySecret;
    /**
     * endpoint
     */
    private $endpoint;

    /**
     * bucket
     */
    private $bucket;

    /**
     * OssClient
     */
    private $ossClient;

    private static $_instance = [];

    private function __construct($name)
    {
//        $this->accessKeyId = Yii::$app->params[$name]['accessKeyId'];
//        $this->accessKeySecret = Yii::$app->params[$name]['accessKeySecret'];
//        $this->endpoint = Yii::$app->params[$name]['endpoint'];
        $this->accessKeyId = 'QL5ZdX0rX0OgCuuu';
        $this->accessKeySecret = 'Plu019UJvfI48QmIbPmADJwiNKzK2D';
        $this->endpoint = 'http://oss-cn-hangzhou.aliyuncs.com';
        $this->ossClient = new OssClient($this->accessKeyId,$this->accessKeySecret,$this->endpoint);
    }
    /**
     * get Oss
     */
    public static function getInstance($name)
    {
        if(!self::$_instance[$name]){
            self::$_instance = new self($name);
        }
        return self::$_instance[$name];
    }

    private function __clone(){}
}