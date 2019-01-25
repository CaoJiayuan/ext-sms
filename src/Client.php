<?php

namespace Nerio\Sms;


use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Strategies\OrderStrategy;
/**
 * Class Client
 * @package TyphoonSMS
 * @method Client aliyun($config)
 * @method Client aliyunrest($config)
 * @method Client yunpian($config)
 * @method Client submail($config)
 * @method Client luosimao($config)
 * @method Client yuntongxun($config)
 * @method Client huyi($config)
 * @method Client juhe($config)
 * @method Client sendcloud($config)
 * @method Client baidu($config)
 * @method Client huaxin($config)
 * @method Client chuanglan($config)
 * @method Client rongcloud($config)
 * @method Client tianyiwuxian($config)
 * @method Client twilio($config)
 * @method Client qcloud($config)
 * @method Client avatardata($config)
 */
class Client
{
    protected $config;

    protected $gateways = [];

    protected $knownGateways = [
        'aliyun', 'aliyunrest', 'yunpian', 'submail',
        'luosimao', 'yuntongxun', 'huyi', 'juhe',
        'sendcloud', 'baidu', 'huaxin', 'chuanglan',
        'rongcloud', 'tianyiwuxian', 'twilio', 'qcloud',
        'avatardata'
    ];


    public function __construct($config = [])
    {
        $config = array_merge([
            'timeout'  => 5.0,
            'errorlog' => storage_path('logs/nerio-sms.log'),
            'strategy' => OrderStrategy::class,
        ], $config);
        $this->timeout($config['timeout'])
            ->errorLog($config['errorlog'])
            ->strategy($config['strategy']);
    }

    public function timeout($sec)
    {
        return $this->setConfig('timeout', $sec);
    }

    public function strategy($clz)
    {
        return $this->setConfig('default.strategy', $clz);
    }

    public function errorLog($logFile)
    {
        return $this->setConfig('gateways.errorlog.file', $logFile);
    }

    public function gateway($name, $config)
    {
        $this->gateways[$name] = $config;
        return $this->setConfig("gateways.{$name}", $config);
    }

    public function fromGateway(SmsGateway $gateway)
    {
        return $this->gateway($gateway->getSmsGatewayName(), $gateway->getSmsGatewayConfig());
    }

    public function send($phone, $data)
    {
        $this->setConfig('default.gateways', array_keys($this->gateways));

        $sms = new EasySms($this->config);

        return $sms->send($phone, $data);
    }

    protected function setConfig($key, $value)
    {
        array_set($this->config, $key, $value);

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (in_array($name, $this->knownGateways)) {
            return $this->gateway($name, $arguments);
        }

        throw new \BadMethodCallException("call unknown method {$name}");
    }
}
