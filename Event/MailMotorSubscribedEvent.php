<?php

namespace MailMotor\Bundle\MailMotorBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * This class is in fact an immutable event class holding all the data
 * that could be needed by event subscribers on the MailMotorSubscribedEvent
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotorSubscribedEvent extends Event
{
    const EVENT_NAME = 'mail_motor_event.subscribed';

    /** @var boolean */
    protected $hasDoubleOptin;

    /** @var string */
    protected $email;

    /** @var string */
    protected $language;

    /** @var string */
    protected $listId;

    /** @var array */
    protected $mergeFields;

    /** @var array */
    protected $interests;

    public function __construct(
        string $email,
        string $listId,
        string $language,
        array $mergeFields,
        array $interests,
        bool $hasDoubleOptin
    ) {
        $this->email = $email;
        $this->listId = $listId;
        $this->language = $language;
        $this->mergeFields = $mergeFields;
        $this->interests = $interests;
        $this->hasDoubleOptin = $hasDoubleOptin;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getInterests(): array
    {
        return $this->interests;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getListId(): string
    {
        return $this->listId;
    }

    public function getMergeFields(): array
    {
        return $this->mergeFields;
    }

    public function hasDoubleOptin(): bool
    {
        return $this->hasDoubleOptin;
    }
}
