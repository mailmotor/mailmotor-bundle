<?php

namespace MailMotor\Bundle\MailMotorBundle\Gateway;

use MailMotor\Bundle\MailMotorBundle\Gateway\SubscriberGateway;
use MailMotor\Bundle\MailMotorBundle\Exception\NotImplementedException;

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
