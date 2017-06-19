<?php

namespace MailMotor\Bundle\MailMotorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SubscriberGatewayPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        // always first check if the primary service is defined
        if (!$container->has('mailmotor.manager.subscriber_gateway')) {
            return;
        }

        $definition = $container->findDefinition('mailmotor.manager.subscriber_gateway');

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds('mailmotor.subscriber_gateway');

        foreach ($taggedServices as $id => $tags) {
            // a service could have the same tag twice
            foreach ($tags as $attributes) {
                // add the subscriber gateway service to the SubscriberGatewayManager service
                $definition->addMethodCall(
                    'addSubscriberGateway',
                    [
                        $id,
                        $attributes['alias']
                    ]
                );
            }
        }
    }
}
