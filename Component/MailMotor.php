<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

use MailMotor\Bundle\MailMotorBundle\Component\Gateway;

/**
 * MailMotor
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class MailMotor
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * Construct
     *
     * @param Gateway $gateway
     */
    public function __construct(
        Gateway $gateway
    ) {
        $this->gateway = $gateway;
    }

    /**
     * Get gateway
     *
     * @return Gateway
     */
    public function getGateway()
    {
        return $this->gateway;
    }
}
