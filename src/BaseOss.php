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
    public function getClient(){
        if ($this->_ossClient === null) {
            $this->setClient(new OssClient($this->accessKeyId,$this->accessKeySecret,$this->endpoint));
        }
        return $this->_ossClient;
    }
    /**
     * @param $path
     * @return bool
     */
    public function has($path)
    {
        return $this->getClient()->doesObjectExist($this->bucket, $path);
    }
    /**
     * @param $path
     * @return bool
     */
    public function read($path)
    {
        if (!($resource = $this->readStream($path))) {
            return false;
        }
        $resource['contents'] = stream_get_contents($resource['stream']);
        fclose($resource['stream']);
        unset($resource['stream']);
        return $resource;
    }
    /**
     * @param $path
     * @return array|bool
     * @throws \OSS\Core\OssException
     */
    public function readStream($path)
    {
        $url = $this->getClient()->signUrl($this->bucket, $path, 3600);
        $stream = fopen($url, 'r');
        if (!$stream) {
            return false;
        }
        return compact('stream', 'path');
    }
    /**
     * @param $fileName string 文件名 eg: '824edb4e295892aedb8c49e4706606d6.png'
     * @param $filePath string 要上传的文件绝对路径 eg: '/storage/image/824edb4e295892aedb8c49e4706606d6.png'
     * @return null
     * @throws \OSS\Core\OssException
     */
    public function upload($fileName, $filePath)
    {
        return $this->getClient()->uploadFile($this->bucket, $fileName, $filePath);
    }
    /**
     * 删除文件
     * @param $path
     * @return bool
     */
    public function delete($path)
    {
        return $this->getClient()->deleteObject($this->bucket, $path) === null;
    }
    /**
     * 创建文件夹
     * @param $dirName
     * @return array|bool
     */
    public function createDir($dirName)
    {
        $result = $this->getClient()->createObjectDir($this->bucket, rtrim($dirName, '/'));
        if ($result !== null) {
            return false;
        }
        return ['path' => $dirName];
    }
    /**
     * 获取 Bucket 中所有文件的文件名，返回 Array。
     * @param array $options = [
     *      'max-keys'  => max-keys用于限定此次返回object的最大数，如果不设定，默认为100，max-keys取值不能大于1000。
     *      'prefix'    => 限定返回的object key必须以prefix作为前缀。注意使用prefix查询时，返回的key中仍会包含prefix。
     *      'delimiter' => 是一个用于对Object名字进行分组的字符。所有名字包含指定的前缀且第一次出现delimiter字符之间的object作为一组元素
     *      'marker'    => 用户设定结果从marker之后按字母排序的第一个开始返回。
     * ]
     * @return array
     */
    public function getAllObject($options = [])
    {
        $objectListing = $this->getClient()->listObjects($this->bucket, $options);
        $objectKeys = [];
        foreach ($objectListing->getObjectList() as $objectSummary) {
            $objectKeys[] = $objectSummary->getKey();
        }
        return $objectKeys;
    }


}