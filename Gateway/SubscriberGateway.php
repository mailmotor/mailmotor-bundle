<?php

namespace MailMotor\Bundle\MailMotorBundle\Gateway;

use MailMotor\Bundle\MailMotorBundle\MailMotor;

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
     * @return boolean
     */
    public function exists(
        $email,
        $listId
    );

    /**
     * Get interests
     *
     * @param string $listId
     * @return array
     */
    public function getInterests(
        $listId
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
        $listId,
        $status
    );

    /**
     * Subscribe
     *
     * @param string $email
     * @param string $listId
     * @param string $language
     * @param array $mergeFields
     * @param array $interests The array is like: ['9AS489SQF' => true, '4SDF8S9DF1' => false]
     * @param boolean $doubleOptin Members need to validate their emailAddress before they get added to the list
     * @return boolean
     */
    public function subscribe(
        $email,
        $listId,
        $language,
        $mergeFields,
        $interests,
        $doubleOptin
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
        $listId
    );
}
