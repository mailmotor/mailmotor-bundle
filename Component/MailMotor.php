<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

/**
 * MailMotor
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotor
{
    /**
     * The default list id
     *
     * @var string
     */
    protected $listId;

    /**
     * Construct
     *
     * @param string $listId
     */
    public function __construct(
        $listId
    ) {
        $this->listId = $listId;
    }

    /**
     * Get list id
     *
     * @param string $listId If you want to use a custom list id
     * @return string
     */
    public function getListId($listId = null)
    {
        return ($listId == null) ? $this->listId : $listId;
    }
}
