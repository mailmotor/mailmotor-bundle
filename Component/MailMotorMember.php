<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

use MailMotor\Bundle\MailMotorBundle\Component\MailMotor;
use MailMotor\Bundle\MailMotorBundle\Component\Member;

/**
 * MailMotor member
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class MailMotorMember implements Member
{
    /**
     * @var Gateway
     */
    protected $gateway;

    /**
     * Construct
     *
     * @param MailMotor $mailMotor
     */
    public function __construct(
        MailMotor $mailMotor
    ) {
        $this->gateway = $mailMotor->getGateway();
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
            'subscribed'
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
            'unsubscribed'
        );
    }

    /**
     * Subscribe
     *
     * @param string $email
     * @param string $listId
     * @param array $mergeVars
     * @return boolean
     */
    public function subscribe(
        $email,
        $listId = null,
        $mergeVars = null
    ) {
        return $this->gateway->subscribe(
            $email,
            $listId,
            $mergeVars
        );
    }

    /**
     * Unsubscribe
     *
     * @param string $email
     * @param string $listId
     * @param array $mergeVars
     * @return boolean
     */
    public function unsubscribe(
        $email,
        $listId = null,
        $mergeVars = null
    ) {
        return $this->gateway->unsubscribe(
            $email,
            $listId,
            $mergeVars
        );
    }
}
