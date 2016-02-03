<?php

namespace MailMotor\Bundle\MailMotorBundle;

/**
 * A helper class that contains all possible MailMotor events
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
final class MailMotorMailMotorBundleEvents
{
    /**
     * The mailmotor.subscribed event is thrown each time an emailaddress is subscribed.
     *
     * The event listener receives an
     * MailMotor\Bundle\MailMotorBundle\Event\MailMotorSubscribedEvent instance.
     *
     * @var string
     */
    const SUBSCRIBED = 'mailmotor.subscribed';

    /**
     * The mailmotor.unsubscribed event is thrown each time an emailaddress is unsubscribed.
     *
     * The event listener receives an
     * MailMotor\Bundle\MailMotorBundle\Event\MailMotorUnubscribedEvent instance.
     *
     * @var string
     */
    const UNSUBSCRIBED = 'mailmotor.unsubscribed';
}
