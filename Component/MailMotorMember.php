<?php

namespace MailMotor\Bundle\MailChimpBundle\Component;

use MailMotor\Bundle\MailMotorBundle\Component\Service;
use MailMotor\Bundle\MailMotorBundle\Component\Member;

/**
 * MailMotor member
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
final class MailMotorMember implements Member
{
	/**
	 * @var Service
	 */
	protected $service;

	/**
	 * Construct
	 *
	 * @param Service $service
	 */
	public function __construct(
		Service $service
	) {
		$this->service = $service;
	}

	/**
	 * Is subscribed
	 *
	 * @param string $email
	 * @param string $listId
	 * @return boolean
	 */
	public function isSubscribed(
		$email,
		$listId = null
	) {
		return $this->service->isSubscribed(
			$email,
			$listId
		);
	}

	/**
	 * Subscribe
	 *
	 * @param string $email
	 * @param string $listId
	 * @return boolean
	 */
	public function subscribe(
		$email,
		$listId = null
	) {
		return $this->service->isSubscribed(
			$email,
			$listId
		);
	}

	/**
	 * Unsubscribe
	 *
	 * @param string $email
	 * @param string $listId
	 * @return boolean
	 */
	public function unsubscribe(
		$email,
		$listId = null
	) {
		return $this->service->isSubscribed(
			$email,
			$listId
		);
	}
}