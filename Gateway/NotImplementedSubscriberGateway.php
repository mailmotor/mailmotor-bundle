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
    public function exists(string $email, string $listId = null): bool
    {
        $this->throwException();
    }

    public function getInterests(string $listId = null): array
    {
        $this->throwException();
    }

    public function hasStatus(string $email, ?string $listId, string $status): bool
    {
        $this->throwException();
    }

    public function ping(string $listId = null): bool
    {
        $this->throwException();
    }

    public function subscribe(
        string $email,
        string $listId = null,
        string $language = null,
        array $mergeFields = array(),
        array $interests = array(),
        bool $doubleOptin = true
    ): bool {
        $this->throwException();
    }

    public function unsubscribe(
        string $email,
        string $listId = null
    ): bool {
        $this->throwException();
    }

    /**
     * @throws NotImplementedException
     */
    private function throwException(): void
    {
        throw new NotImplementedException('The MailMotor has no active mail-engine subscriber gateway.');
    }
}
