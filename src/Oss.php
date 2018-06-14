<?php
/**
 * Created by PhpStorm.
 * User: wim
 * Date: 2018/6/14
 * Time: 17:13
 */
namespace wim\yii\oss;

use yii\base\Component;

class Oss extends Component
{
    /**
     * @var string bucket
     */
    public $bucket;
    /**
     * @var object OssClient
     */
    private $client;
    /**
     * Oss constructor.
     * @param $bucket
     * @param array $config\
     */
    public function __construct($bucket, $config = [])
    {
        $this->bucket = $bucket;
        parent::__construct($config);
    }

    /**
     * init
     */
    public function init()
    {
        parent::init();

    }

    /**
     * set ossClient
     */
    public function setClient($name = 'oss')
    {
        $this->client = Client::getInstance($name);
    }

    /**
     * get ossClient
     */
    public function getOssClient($name = '')
    {
        if($this->client === null){
            $this->client = Client::getInstance($name);
        }
        return $this->client->ossClient;
    }


    /**
     * upload
     */
    public function upload($object,$filepath)
    {

    }


}