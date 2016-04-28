<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

use MailMotor\Bundle\MailMotorBundle\Component\Gateway\SubscriberGateway;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundleEvents;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorSubscribedEvent;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorUnsubscribedEvent;

/**
 * Subscriber - this is the class that will be used in the web app.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Subscriber
{
    const MEMBER_STATUS_SUBSCRIBED = 'subscribed';
    const MEMBER_STATUS_UNSUBSCRIBED = 'unsubscribed';

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var SubscriberGateway
     */
    protected $subscriberGateway;

    /**
     * Construct
     *
     * @param SubscriberGateway $subscriberGateway
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        SubscriberGateway $subscriberGateway,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->subscriberGateway = $subscriberGateway;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Exists
     *
     * @param string $email
     * @param string $listId
     * @return boolean
     */
    public function exists(
        $email,
        $listId = null
    ) {
        return (bool) $this->subscriberGateway->get(
            $email,
            $listId
        );
    }

    /**
     * Is subscribed
     *
     * @param string $email
     * @param string $listId
     * @return boolean
     */
    public function isSubscribed(
        $email,
        $listId = null
    ) {
        return $this->subscriberGateway->hasStatus(
            $email,
            $listId,
            self::MEMBER_STATUS_SUBSCRIBED
        );
    }

    /**
     * Is unsubscribed
     *
     * @param string $email
     * @param string $listId
     * @return boolean
     */
    public function isUnsubscribed(
        $email,
        $listId = null
    ) {
        return $this->subscriberGateway->hasStatus(
            $email,
            $listId,
            self::MEMBER_STATUS_UNSUBSCRIBED
        );
    }

    /**
     * Subscribe
     *
     * @param string $email
     * @param string $listId
     * @param array $mergeFields
     * @param string $language
     * @param boolean $doubleOptin Members need to validate their emailAddress before they get added to the list
     * @return boolean
     */
    public function subscribe(
        $email,
        $listId = null,
        $mergeFields = array(),
        $language = null,
        $doubleOptin = true
    ) {
        $subscribed = $this->subscriberGateway->subscribe(
            $email,
            $listId,
            $mergeFields,
            $language,
            $doubleOptin
        );

        if ($subscribed) {
            // dispatch subscribed event
            $this->eventDispatcher->dispatch(
                MailMotorMailMotorBundleEvents::SUBSCRIBED,
                new MailMotorSubscribedEvent(
                    $email,
                    $listId,
                    $mergeFields,
                    $language,
                    $doubleOptin
                )
            );
        }

        return $subscribed;
    }

    /**
     * Unsubscribe
     *
     * @param string $email
     * @param string $listId
     * @return boolean
     */
    public function unsubscribe(
        $email,
        $listId = null
    ) {
        $unsubscribed = $this->subscriberGateway->unsubscribe(
            $email,
            $listId
        );

        if ($unsubscribed) {
            // dispatch unsubscribed event
            $this->eventDispatcher->dispatch(
                MailMotorMailMotorBundleEvents::UNSUBSCRIBED,
                new MailMotorUnsubscribedEvent(
                    $email,
                    $listId
                )
            );
        }

        return $unsubscribed;
    }
}
