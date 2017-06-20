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

    public function __construct(
        Container $container,
        string $mailEngine
    ) {
        $this->container = $container;
        $this->setMailEngine($mailEngine);
    }

    public function getSubscriberGateway(): SubscriberGateway
    {
        return $this->container->get('mailmotor.' . $this->mailEngine . '.subscriber.gateway');
    }

    protected function setMailEngine(string $mailEngine): void
    {
        if ($mailEngine == null) {
            $mailEngine = 'not_implemented';
        }

        $this->mailEngine = strtolower($mailEngine);
    }
}
