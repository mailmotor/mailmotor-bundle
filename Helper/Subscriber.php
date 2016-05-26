<?php

namespace MailMotor\Bundle\MailMotorBundle\Helper;

use MailMotor\Bundle\MailMotorBundle\Gateway\SubscriberGateway;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use MailMotor\Bundle\MailMotorBundle\MailMotor;
use MailMotor\Bundle\MailMotorBundle\MailMotorMailMotorBundleEvents;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorSubscribedEvent;
use MailMotor\Bundle\MailMotorBundle\Event\MailMotorUnsubscribedEvent;

/**
 * Subscriber - this is the class that will be used in the web app.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class Subscriber extends MailMotor
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
     * @param string $listId
     */
    public function __construct(
        SubscriberGateway $subscriberGateway,
        EventDispatcherInterface $eventDispatcher,
        $listId
    ) {
        parent::__construct($listId);
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
            $this->getListId($listId)
        );
    }

    /**
     * Get interests
     *
     * @param string $listId
     * @return array
     */
    public function getInterests(
        $listId = null
    ) {
        return (array) $this->subscriberGateway->getInterests(
            $this->getListId($listId)
        );
    }

    /**
     * Get interests for category id
     *
     * @param string $interestCategoryId
     * @param string $listId
     * @return array
     */
    public function getInterestsForCategoryId(
        $interestCategoryId,
        $listId = null
    ) {
        return (array) $this->subscriberGateway->getInterestsForCategoryId(
            $interestCategoryId,
            $this->getListId($listId)
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
            $this->getListId($listId),
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
            $this->getListId($listId),
            self::MEMBER_STATUS_UNSUBSCRIBED
        );
    }

    /**
     * Subscribe
     *
     * @param string $email
     * @param array $mergeFields
     * @param string $language
     * @param boolean $doubleOptin Members need to validate their emailAddress before they get added to the list
     * @param string $listId
     * @return boolean
     */
    public function subscribe(
        $email,
        $language = null,
        $mergeFields = array(),
        $interests = array(),
        $doubleOptin = true,
        $listId = null
    ) {
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
                MailMotorMailMotorBundleEvents::SUBSCRIBED,
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
            $this->getListId($listId)
        );

        if ($unsubscribed) {
            // dispatch unsubscribed event
            $this->eventDispatcher->dispatch(
                MailMotorMailMotorBundleEvents::UNSUBSCRIBED,
                new MailMotorUnsubscribedEvent(
                    $email,
                    $this->getListId($listId)
                )
            );
        }

        return $unsubscribed;
    }
}
