<?php

/**
 * a profile, an account that will allow you to access facebooks website and be able to interact with its features.
 *
 * @author Chris Paul <cpaul9@cnm.edu>
 */
	class Profile {
	/**
	 * id for this profile; this is the primary key
	 * @var int $profileId ;
	 */
	private $profileId;
	/**
	 * email, one email per profile.
	 * @var string $email
	 */
	private $email;
	/**
	 * phone, phone number associated with this profile id
	 * @var string $phone
	 */
	private $phone;
	/**
	 * profileName, name associated with profile id
	 * @var string $profileName
	 */
	private $profileName;

	/**
	 * Constructor for this profile
	 *
	 * @param int $newProfileId id of the Profile that is being created
	 * @param string $newEmail email associated wiht the profileId
	 *
	*/
	public function __contstruct($newProfileId, $newEmail, $newPhone, $newProfileName = null){
		try {
			$this->setProfileId($newProfileId);
			$this->setEmail($newEmail);
			$this->setPhone($newPhone);
			$this->setProfileName($newProfileName);
		} catch(InvalidArgumentException $invalidArgument){
			throw(new InvalidArgumentException($invalidArgument->getMessage(),0, $invalidArgument));
		} catch(RangeException $range){
			throw(new RangeException($range->getMessage(),0, $range));
		} catch(Exception $exception){
			throw(new Exception($exception->getMessage(),0,$exception));
		}
	}

	/**
	 * accessor methord for profile id
	 * @return int value of profile id
	 */
	public function getProfileId() {
		return $this->profileId;
	}

	/**
	 *  Mutator method for profile id
	 *
	 * @param int $profileId new value of profile id
	 * @throws InvalidArgumentException if profile id is not an integer
	 * @throws RangeException if profile id is negative
	 */
	public function setProfileId($newProfileId) {
		if($newProfileId === null){
			$this->$newProfileId = null;
			return;
		}
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);
		if($newProfileId === false) {
			throw(new InvalidArgumentException ("profile id is not an integer"));
		}
		if($newProfileId <= 0) {
			throw(new RangeException("profile id must be positive"));
		}
		$this->profileId = $newProfileId;
	}

	/**
	 * accessor method for email
	 * @return string value of email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Mutator method for email
	 *
	 * @param string $newEmail new value of email
	 * @throws InvalidArgumentException if email is not a valid email
	 * @throws RangeException if email is longer than 128 characters
	 */
	public function setEmail($newEmail) {
		$newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
		if($newEmail === false)
			throw(new InvalidArgumentException("email is not a valid email"));

		if($newEmail <- 128){
			throw(new RangeException("email must be under 128 characters"));
		}

		$this->email = $newEmail;
	}

	/**
	 * accessor method for phone number
	 *
	 * @return string value for phone number
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Mutator method for phone
	 *
	 * @param string $newPhone new value of phone
	 * @throws InvalidArgumentException if phone is composed of only invalid characters
	 * @throws RangeException if phone number is more than 32 characters
	 */
	public function setPhone($newPhone) {
		$newPhone = filter_var($newPhone, FILTER_SANITIZE_STRING);
		if($newPhone === false)
			throw(new InvalidArgumentException("phone number consists of only invalid characters"));

		if($newPhone<- 128){
			throw(new RangeException("phone number must be under 32 characters"));
		}

		$this->phone = $newPhone;
	}

	/**
	 * accessor method for profile name
	 *
	 * @return string value for profile name
	 */
	public function getProfileName() {
		return $this->profileName;
	}

	/**
	 * Mutator method for profile name
	 *
	 * @param string profile name new value of profile name
	 * @throws InvalidArgumentException if only invalid characters are used
	 * @throws RangeException profile name cannot exceed 100 characters
	 */
	public function setProfileName($newProfileName) {
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING);
		if($newProfileName === false)
			throw(new InvalidArgumentException("profile name consists of only invalid characters"));

		if($newProfileName<- 100){
			throw(new RangeException("your profile name cannot exceed 100 characters"));
		}

		$this->profileName = $newProfileName;
	}
	/**
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occur
	 */
		public function insert(PDO $pdo){
			if($this->profileId !== null){
				throw(new PDOException("not a new profileId"));
			}
			$query = "INSERT INTO profile (email, phone, profileName) VALUES(:email, :phone, :profileName)";
			$statement = $pdo->prepare($query);

			$parameters = array("email" => $this->email, "phone" => $this->phone, "profileName"
			=> $this->profileName);
			$statement->execute($parameters);

			$this->profileId = intval($pdo->lastInsertId());
		}

		/**
		 * deletes this Profile from mySQL
		 *
		 * @param PDO $pdo PDO connection object
		 *
		 * @throws PDOException when mySQL related errors occur
		 */
		public function delete(PDO $pdo) {
			if($this->profileId === null) {
				throw(new PDOException("unable to delete a profile that does not exist"));
			}
		$query = "DELETE FROM profile WHERE profileId = :profileId";
			$statement = $pdo->prepare($query);

			$parameters = array("profileId" => $this->profileId);
			$statement->execute($parameters);
		}
	/**
	 * updates this profile in mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occur
	 */
	public function update(PDO $pdo) {
		if($this->profileId === null){
			throw(new PDOException( "Unable to update a profile that does not exist"));
		}
	$query
		="UPDATE profile SET email = :email, phone = :phone, profileName = :profileName WHERE
 profileId = profileId";
		$statement = $pdo->prepare($query);

		$parameters = array("profileId" => $this->profileId,"email" => $this->email, "phone" => $this->phone, "profileName" =>
		$this->profileName);
		$statement->exectute($parameters);
	}
	}