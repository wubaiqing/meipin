<?php
require_once dirname(__DIR__).'/aliyunapi/aliyun.php';
use Aliyun\OSS\OSSClient;
class OSSClient2 extends CComponent
{
    public $keyId = 'OdJ4QqumwkDsQB9G';
    public $keySecret = '3ZVXBVEgDLZcYjcbKywQbn1nYpWInk';
    public $bucket = 'wubaiqing';
    //public $key = 'images/123.txt';
    public $client;
    function __construct()
    {
        $this->client= OSSClient::factory(array(
            'AccessKeyId' => $this->keyId,
            'AccessKeySecret' => $this->keySecret,
        ));
    }

    function putStringObject($key,$content) {
        $result = $this->client->putObject(array(
            'Bucket' => $this->bucket,
            'Key' => $key,
            'Content' => $content,
        ));
        return  $result->getETag();
    }

    // Sample of put object from resource
    function putResourceObject($key, $content, $size) {
        $result = $this->client->putObject(array(
            'Bucket' => $this->bucket,
            'Key' => $key,
            'Content' => $content,
            'ContentLength' => $size,
        ));
        return  $result->getETag();
    }

    // Sample of delete object
    function deleteObject($key) {
        $this->client->deleteObject(array(
            'Bucket' => $this->bucket,
            'Key' => $key,
        ));
    }

    // Sample of get object
    function getObject($key) {
        $object = $this->client->getObject(array(
            'Bucket' => $this->bucket,
            'Key' => $key,
        ));

        echo "Object: " . $object->getKey() . "\n";
        echo (string) $object;
    }

}







