<?php

namespace MailMotor\Bundle\MailMotorBundle\Factory;

use MailMotor\Bundle\MailMotorBundle\Gateway\SubscriberGateway;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotorFactory
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var string
     */
    protected $mailEngine;

    /**
     * Construct
     *
     * @param Container $container
     * @param string $mailEngine
     */
    public function __construct(
        Container $container,
        $mailEngine
    ) {
        $this->container = $container;
        $this->setMailEngine($mailEngine);
    }

    /**
     * Get subscriber gateway
     *
     * @return SubscriberGateway
     */
    public function getSubscriberGateway()
    {
        return $this->container->get('mailmotor.' . $this->mailEngine . '.subscriber.gateway');
    }

    /**
     * Set mail engine
     *
     * @param string $mailEngine
     */
    protected function setMailEngine($mailEngine)
    {
        if ($mailEngine == null) {
            $mailEngine = 'not_implemented';
        }

        $this->mailEngine = strtolower($mailEngine);
    }
}
