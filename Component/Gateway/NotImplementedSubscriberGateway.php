<?php

namespace MailMotor\Bundle\MailMotorBundle\Component\Gateway;

use MailMotor\Bundle\MailMotorBundle\Component\SubscriberGateway;
use MailMotor\Bundle\MailMotorBundle\Component\Exception\NotImplementedException;

/**
 * Not Implemented Subscriber Gateway
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class NotImplementedSubscriberGateway implements SubscriberGateway
{
    /**
     * Get
     *
     * @param string $email
     * @param string $listId
     * @return array
     */
    public function get(
        $email,
        $listId = null
    ) {
        return $this->throwException();
    }

    /**
     * Has status
     *
     * @param string $email
     * @param string $listId
     * @param string $status
     * @return boolean
     */
    public function hasStatus(
        $email,
        $listId = null,
        $status
    ) {
        $this->throwException();
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
        $this->throwException();
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
        $this->throwException();
    }

    /**
     * Throw exception
     *
     * @return NotImplementedException
     */
    protected function throwException()
    {
        throw new NotImplementedException('The MailMotor has no active mail-engine subscriber gateway.');
    }
}
