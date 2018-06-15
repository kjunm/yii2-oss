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
    public function __construct($accessKeyId, $accessKeySecret, $endpoint, $isCName = false, $securityToken = NULL, $requestProxy = NULL)
    {
        parent::__construct($accessKeyId, $accessKeySecret, $endpoint, $isCName, $securityToken, $requestProxy);
    }


}