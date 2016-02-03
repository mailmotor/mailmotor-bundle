<?php

namespace MailMotor\Bundle\MailMotorBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * This class is in fact an immutable event class holding all the data
 * that could be needed by event subscribers on the MailMotorUnsubscribedEvent
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class MailMotorUnsubscribedEvent extends Event
{
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

    /**
     * @param string $email
     * @param string $listId
     * @param array $mergeFields
     */
    public function __construct(
        $email,
        $listId = null,
        $mergeFields = array()
    ) {
        $this->email = $email;
        $this->listId = $listId;
        $this->mergeFields = $mergeFields;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets the value of listId.
     *
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * Gets the value of mergeFields.
     *
     * @return array
     */
    public function getMergeFields()
    {
        return $this->mergeFields;
    }
}
