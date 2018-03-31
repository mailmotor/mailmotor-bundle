<?php

namespace MailMotor\Bundle\MailMotorBundle\Helper;

use MailMotor\Bundle\MailMotorBundle\Event\MailMotorSubscribedEvent;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorUnsubscribedEvent;
use MailMotor\Bundle\MailMotorBundle\Gateway\SubscriberGateway;
use MailMotor\Bundle\MailMotorBundle\MailMotor;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Subscriber - this is the class that will be used in the web app.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class Subscriber extends MailMotor
{
    public const MEMBER_STATUS_SUBSCRIBED = 'subscribed';
    public const MEMBER_STATUS_UNSUBSCRIBED = 'unsubscribed';

    /** @var EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var SubscriberGateway */
    protected $subscriberGateway;

    public function __construct(
        SubscriberGateway $subscriberGateway,
        EventDispatcherInterface $eventDispatcher,
        string $listId = null
    ) {
        parent::__construct($listId);
        $this->subscriberGateway = $subscriberGateway;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function exists(string $email, string $listId = null): bool
    {
        return (bool) $this->subscriberGateway->exists(
            $email,
            $this->getListId($listId)
        );
    }

    public function getInterests(string $listId = null): array
    {
        return (array) $this->subscriberGateway->getInterests(
            $this->getListId($listId)
        );
    }

    public function isSubscribed(string $email, string $listId = null): bool
    {
        return $this->subscriberGateway->hasStatus(
            $email,
            $this->getListId($listId),
            self::MEMBER_STATUS_SUBSCRIBED
        );
    }

    public function isUnsubscribed(string $email, string $listId = null): bool
    {
        return $this->subscriberGateway->hasStatus(
            $email,
            $this->getListId($listId),
            self::MEMBER_STATUS_UNSUBSCRIBED
        );
    }

    public function ping(): bool
    {
        return $this->subscriberGateway->ping($this->getListId());
    }

    /**
     * Subscribe
     *
     * @param string $email
     * @param string $language
     * @param array $mergeFields
     * @param array $interests The array is like: ['9AS489SQF' => true, '4SDF8S9DF1' => false]
     * @param bool $doubleOptin Members need to validate their emailAddress before they get added to the list
     * @param string $listId
     * @return boolean
     */
    public function subscribe(
        string $email,
        string $language = null,
        array $mergeFields = array(),
        array $interests = array(),
        bool $doubleOptin = true,
        string $listId = null
    ): bool {
        $subscribed = $this->subscriberGateway->subscribe(
            $email,
            $this->getListId($listId),
            $language,
            $mergeFields,
            $interests,
            $doubleOptin
        );

        if ($subscribed) {
            // dispatch subscribed event
            $this->eventDispatcher->dispatch(
                MailMotorSubscribedEvent::EVENT_NAME,
                new MailMotorSubscribedEvent(
                    $email,
                    $this->getListId($listId),
                    $language,
                    $mergeFields,
                    $interests,
                    $doubleOptin
                )
            );
        }

        return $subscribed;
    }

    public function unsubscribe(string $email, string $listId = null): bool
    {
        $unsubscribed = $this->subscriberGateway->unsubscribe(
            $email,
            $this->getListId($listId)
        );

        if ($unsubscribed) {
            // dispatch unsubscribed event
            $this->eventDispatcher->dispatch(
                MailMotorUnsubscribedEvent::EVENT_NAME,
                new MailMotorUnsubscribedEvent(
                    $email,
                    $this->getListId($listId)
                )
            );
        }

        return $unsubscribed;
    }
}
