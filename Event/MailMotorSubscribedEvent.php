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
     */
    public function __construct(
        $email,
        $listId = null,
        $mergeFields = array(),
        $language = null
    ) {
        $this->email = $email;
        $this->listId = $listId;
        $this->mergeFields = $mergeFields;
        $this->language = $language;
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
}
