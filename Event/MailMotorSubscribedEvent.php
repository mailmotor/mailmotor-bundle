<?php

namespace MailMotor\Bundle\MailMotorBundle\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * This class is in fact an immutable event class holding all the data
 * that could be needed by event subscribers on the MailMotorSubscribedEvent
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class MailMotorSubscribedEvent extends Event
{
    const EVENT_NAME = 'mail_motor_event.subscribed';

    /**
     * @var boolean
     */
    protected $hasDoubleOptin;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $listId;

    /**
     * @var array
     */
    protected $mergeFields;

    /**
     * @var array
     */
    protected $interests;

    /**
     * Construct
     *
     * @param string $email
     * @param string $listId
     * @param string $language
     * @param array $mergeFields
     * @param array $interests
     * @param boolean $hasDoubleOptin
     */
    public function __construct(
        $email,
        $listId,
        $language,
        $mergeFields,
        $interests,
        $hasDoubleOptin
    ) {
        $this->email = $email;
        $this->listId = $listId;
        $this->language = $language;
        $this->mergeFields = $mergeFields;
        $this->interests = $interests;
        $this->hasDoubleOptin = $hasDoubleOptin;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get interests
     *
     * @return array
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get listId
     *
     * @return string
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * Get mergeFields
     *
     * @return array
     */
    public function getMergeFields()
    {
        return $this->mergeFields;
    }

    /**
     * Has double optin
     *
     * @return boolean
     */
    public function hasDoubleOptin()
    {
        return $this->hasDoubleOptin;
    }
}
