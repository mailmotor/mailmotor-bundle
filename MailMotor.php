<?php

namespace MailMotor\Bundle\MailMotorBundle;

/**
 * MailMotor
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class MailMotor
{
    /** @var string - The default list id */
    protected $listId;

    public function __construct(?string $listId)
    {
        $this->listId = $listId;
    }

    /**
     * Get list id
     *
     * @param string $listId - If you want to use a custom list id
     * @return string
     */
    public function getListId(string $listId = null): string
    {
        return ($listId == null) ? $this->listId : $listId;
    }
}
