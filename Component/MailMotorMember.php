<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use MailMotor\Bundle\MailMotorBundle\Component\MailMotor;
use MailMotor\Bundle\MailMotorBundle\Component\Member;
use MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundleEvents;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorSubscribedEvent;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorUnsubscribedEvent;

/**
 * MailMotor member
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class MailMotorMember implements Member
{
    const MEMBER_STATUS_SUBSCRIBED = 'subscribed';
    const MEMBER_STATUS_UNSUBSCRIBED = 'unsubscribed';

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * Construct
     *
     * @param MailMotor $mailMotor
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(
        MailMotor $mailMotor,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->gateway = $mailMotor->getGateway();
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
        return (bool) $this->gateway->get(
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
        return $this->gateway->hasStatus(
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
        return $this->gateway->hasStatus(
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
     * @return boolean
     */
    public function subscribe(
        $email,
        $listId = null,
        $mergeFields = array(),
        $language = null
    ) {
        $subscribed = $this->gateway->subscribe(
            $email,
            $listId,
            $mergeFields,
            $language
        );

        if ($subscribed) {
            // dispatch event
            $this->eventDispatcher->dispatch(
                MailMotorMailMotorBundleEvents::SUBSCRIBED,
                new MailMotorSubscribedEvent(
                    $email,
                    $listId,
                    $mergeFields,
                    $language
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
        $unsubscribed = $this->gateway->unsubscribe(
            $email,
            $listId
        );

        if ($unsubscribed) {
            // dispatch event
            $this->eventDispatcher->dispatch(
                MailMotorMailMotorBundleEvents::SUBSCRIBED,
                new MailMotorUnsubscribedEvent(
                    $email,
                    $listId
                )
            );
        }

        return $unsubscribed;
    }
}
