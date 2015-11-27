<?php

namespace MailMotor\Bundle\MailMotorBundle\Component;

/**
 * Member interface
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
interface Member
{
	/**
	 * Exists
	 *
	 * @param string $email
	 * @param string $listId
	 * @return boolean
	 */
	public function exists($email, $listId);

	/**
	 * Is subscribed
	 *
	 * @param string $email
	 * @param string $listId
	 * @return boolean
	 */
	public function isSubscribed($email, $listId);

	/**
	 * Is unsubscribed
	 *
	 * @param string $email
	 * @param string $listId
	 * @return boolean
	 */
	public function isUnsubscribed($email, $listId);

	/**
	 * Subscribe
	 *
	 * @param string $email
	 * @param string $listId
	 * @param array $mergeVars
	 * @return boolean
	 */
	public function subscribe($email, $listId, $mergeVars);

	/**
	 * Unsubscribe
	 *
	 * @param string $email
	 * @param string $listId
	 * @param array $mergeVars
	 * @return boolean
	 */
	public function unsubscribe($email, $listId, $mergeVars);
}