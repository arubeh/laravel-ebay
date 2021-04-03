<?php

namespace Hkonnet\LaravelEbay;

use DTS\eBaySDK\Sdk;

class EbayServices
{
    private $sdk;

    function __construct($devId=null, $appId=null, $certId=null)
    {
        $args = [];
        $ebay = new Ebay($devId, $appId, $certId);
        $config = $ebay->getConfig($args);
        $this->sdk = new Sdk($config);
    }

    function __call($name, $args)
    {
        if (strpos($name, 'create') === 0) {
            $service = 'create'.substr($name, 6);
            $configuration = isset($args[0]) ? $args[0] : [];
            return $this->sdk->$service($configuration);
        }
    }

}
