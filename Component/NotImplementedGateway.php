<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

use MailMotor\Bundle\MailMotorBundle\Component\Gateway;
use MailMotor\Bundle\MailMotorBundle\Component\NotImplementedException;

/**
 * Not Implemented Gateway
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class NotImplementedGateway implements Gateway
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
        throw new NotImplementedException('The MailMotor has no active mail-engine gateway');
    }
}
