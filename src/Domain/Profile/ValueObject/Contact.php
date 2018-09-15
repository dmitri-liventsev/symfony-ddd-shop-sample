<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\ValueObject;

use App\Domain\Profile\ValueObject\Contact\Email;
use App\Domain\Profile\ValueObject\Contact\Phone;

class Contact {
    /** @var Email  */
	public $email;

	/** @var Phone  */
	public $phone;

	/**
	 * Contact constructor.
	 *
	 * @param $email
	 * @param $phone
	 */
	public function __construct(Email $email, Phone $phone) {
		$this->email = $email;
		$this->phone = $phone;
	}

    /**
     * @return Contact
     */
    public static function createBlank() {
	    return new self(Email::createBlank(), Phone::createBlank());
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }
}