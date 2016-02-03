<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

/**
 * Not implemented exception
 *
 * @author Jeroen Desloovere <jeroen@siesqo.be>
 */
class NotImplementedException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
