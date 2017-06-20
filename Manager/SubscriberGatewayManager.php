<?php

namespace MailMotor\Bundle\MailMotorBundle\Manager;

class SubscriberGatewayManager
{
    /** @var array */
    private $subscriberGateways;

    public function __construct()
    {
        $this->subscriberGateways = array();
    }

    public function addSubscriberGateway(string $gateway, string $alias): void
    {
        $this->subscriberGateways[$alias] = $gateway;
    }

    public function getAll(): array
    {
        return $this->subscriberGateways;
    }
}
