<?php

namespace MailMotor\Bundle\MailMotorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('mailmotor');
        if (method_exists($treeBuilder, 'root')) {
            $treeBuilder->root('mailmotor');
        }

        return $treeBuilder;
    }
}
