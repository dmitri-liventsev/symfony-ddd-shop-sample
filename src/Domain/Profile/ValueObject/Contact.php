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

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }
}