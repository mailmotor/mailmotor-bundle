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
     * Construct
     *
     * @param string $email
     * @param string $listId
     * @param array $mergeFields
     * @param string $language
     * @param boolean $hasDoubleOptin
     */
    public function __construct(
        $email,
        $listId,
        $mergeFields,
        $language,
        $hasDoubleOptin
    ) {
        $this->email = $email;
        $this->listId = $listId;
        $this->mergeFields = $mergeFields;
        $this->language = $language;
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
