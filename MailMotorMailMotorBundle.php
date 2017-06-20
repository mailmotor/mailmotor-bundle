<?php

namespace MailMotor\Bundle\MailMotorBundle;

use MailMotor\Bundle\MailMotorBundle\DependencyInjection\Compiler\SubscriberGatewayPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * MailMotor MailMotor Bundle
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotorMailMotorBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new SubscriberGatewayPass());
    }
}
