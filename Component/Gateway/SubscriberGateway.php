<?php

namespace MailMotor\Bundle\MailMotorBundle\Component\Gateway;

use MailMotor\Bundle\MailMotorBundle\Component\MailMotor;

/**
 * Subscriber gateway
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
interface SubscriberGateway
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
    );

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
    );

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
    );

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
    );
}
