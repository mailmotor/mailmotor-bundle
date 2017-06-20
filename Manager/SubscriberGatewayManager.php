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

    public function addSubscriberGateway(string $transport, string $alias)
    {
        $this->subscriberGateways[$alias] = $transport;
    }

    public function getAll(): array
    {
        return $this->subscriberGateways;
    }
}
