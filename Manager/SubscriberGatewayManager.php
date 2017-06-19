<?php

namespace MailMotor\Bundle\MailMotorBundle\Manager;

use MailMotor\Bundle\MailMotorBundle\Gateway\SubscriberGateway;

class SubscriberGatewayManager
{
    private $subscriberGateways;

    public function __construct()
    {
        $this->subscriberGateways = array();
    }

    public function addSubscriberGateway(string $transport, string $alias)
    {
        $this->subscriberGateways[$alias] = $transport;
    }

    public function getSubscriberGateway($alias): SubscriberGateway
    {
        if (array_key_exists($alias, $this->subscriberGateways)) {
            return $this->subscriberGateways[$alias];
        }
    }

    public function getAll(): array
    {
        return $this->subscriberGateways;
    }
}
