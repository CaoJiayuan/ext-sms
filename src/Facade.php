<?php


namespace Nerio\Sms;

/**
 * Class Facade
 * @package Nerio\Sms
 * @method static Client aliyun($config)
 * @method static Client aliyunrest($config)
 * @method static Client yunpian($config)
 * @method static Client submail($config)
 * @method static Client luosimao($config)
 * @method static Client yuntongxun($config)
 * @method static Client huyi($config)
 * @method static Client juhe($config)
 * @method static Client sendcloud($config)
 * @method static Client baidu($config)
 * @method static Client huaxin($config)
 * @method static Client chuanglan($config)
 * @method static Client rongcloud($config)
 * @method static Client tianyiwuxian($config)
 * @method static Client twilio($config)
 * @method static Client qcloud($config)
 * @method static Client avatardata($config)
 */
class Facade extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return app('nerio.sms');
    }
}
