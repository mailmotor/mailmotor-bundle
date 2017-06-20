<?php

namespace MailMotor\Bundle\MailMotorBundle\Gateway;

/**
 * Subscriber gateway
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
interface SubscriberGateway
{
    public function exists(string $email, string $listId): bool;

    public function getInterests(string $listId): array;

    public function hasStatus(string $email, string $listId, string $status): bool;

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
        string $email,
        string $listId,
        string $language,
        array $mergeFields,
        array $interests,
        bool $doubleOptin
    ): bool;

    public function unsubscribe(string $email, string $listId): bool;
}
