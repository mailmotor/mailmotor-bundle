<?php

namespace MailMotor\Bundle\MailMotorBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * This class is in fact an immutable event class holding all the data
 * that could be needed by event subscribers on the MailMotorUnsubscribedEvent
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotorUnsubscribedEvent extends Event
{
    const EVENT_NAME = 'mail_motor_event.unsubscribed';

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $listId;

    /**
     * @var array
     */
    protected $mergeFields;

    public function __construct(
        string $email,
        string $listId = null,
        array $mergeFields = array()
    ) {
        $this->email = $email;
        $this->listId = $listId;
        $this->mergeFields = $mergeFields;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getListId(): string
    {
        return $this->listId;
    }

    public function getMergeFields(): array
    {
        return $this->mergeFields;
    }
}
