<?php

namespace MailMotor\Bundle\MailMotorBundle\Factory;

use Symfony\Component\DependencyInjection\ServiceLocator;
use MailMotor\Bundle\MailMotorBundle\Gateway\SubscriberGateway;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotorFactory
{
    /** @var ServiceLocator */
    protected $serviceLocator;

    /** @var string|null */
    protected $mailEngine;

    public function __construct(
        ServiceLocator $serviceLocator,
        ?string $mailEngine
    ) {
        $this->serviceLocator = $serviceLocator;
        $this->setMailEngine($mailEngine);
    }

    public function getSubscriberGateway(): SubscriberGateway
    {
        return $this->serviceLocator->get($this->mailEngine);
    }

    protected function setMailEngine(?string $mailEngine): void
    {
        if ($mailEngine === null || !$this->serviceLocator->has($mailEngine)) {
            $mailEngine = 'not_implemented';
        }

        $this->mailEngine = strtolower($mailEngine);
    }
}
