<?php

namespace Nerio\Sms;


interface SmsGateway
{
    public function getSmsGatewayConfig() : array;
    public function getSmsGatewayName() : string;
}
