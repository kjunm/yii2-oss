<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/5/29
 * Time: 16:37
 */
namespace wim\yii\oss;

use OSS\OssClient;
use yii\base\Component;

abstract class BaseOss extends Component
{
    /**
     * @var accessKeyId
     */
    public $accessKeyId;
    /**
     * accessKeySecret
     */
    public $accessKeySecret;
    /**
     * endpoint
     */
    public $endpoint;
    /**
     * bucket
     */
    public $bucket;
    /**
     * OssClient
     */
    protected $_ossClient;

    /**
     * init
     */
    public function init()
    {
        if ($this->accessKeyId === null) {
            throw new InvalidConfigException('The "accessKeyId" property must be set.');
        } elseif ($this->accessKeySecret === null) {
            throw new InvalidConfigException('The "accessKeySecret" property must be set.');
        } elseif ($this->bucket === null) {
            throw new InvalidConfigException('The "bucket" property must be set.');
        } elseif ($this->endpoint === null) {
            throw new InvalidConfigException('The "endpoint" property must be set.');
        }
    }

    /**
     * @param  $ossClient
     */
     public function setClient(OssClient $ossClient){
         $this->_ossClient = $ossClient;
     }
    /**
     * @return OssClient
     */
    abstract public function getClient();
    /**
     * upload
     */
    abstract public function upload($object,$filepath);


}