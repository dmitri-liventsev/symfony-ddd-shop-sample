<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\ValueObject;

class Contact {
	public $email;
	public $phone;

	/**
	 * Contact constructor.
	 *
	 * @param $email
	 * @param $phone
	 */
	public function __construct($email, $phone) {
		$this->email = $email;
		$this->phone = $phone;
	}
}