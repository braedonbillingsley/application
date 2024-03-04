<?php
/**
 * This is my APPLICANT class for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */
class Applicant {
    private string $_first_name;
    private string $_last_name;
    private string $_email;
    private string $_state;
    private string $_phone;
    private string $_github;
    private string $_experience;
    private string $_relocate;
    private string $_bio;

    /**
     * Constructor for creating a new instance of the given class.
     *
     * @param string $first_name The first name of the person.
     * @param string $last_name The last name of the person.
     * @param string $email The email address of the person.
     * @param string $state The state of the person.
     * @param string $phone The phone number of the person.
     *
     * @return void
     */
    public function __construct(string $first_name, string $last_name, string $email, string $state, string $phone) {
        $this->_first_name = $first_name;
        $this->_last_name = $last_name;
        $this->_email = $email;
        $this->_state = $state;
        $this->_phone = $phone;
    }

    /**
     * Retrieves the first name of the person.
     *
     * @return string The first name of the person.
     */
    public function getFirstName(): string {
        return $this->_first_name;
    }

    /**
     * Set the first name of the person.
     *
     * @param string $first_name The first name of the person.
     *
     * @return void
     */
    public function setFirstName(string $first_name): void {
        $this->_last_name = $first_name;
    }

    /**
     * Retrieves the last name of the person.
     *
     * @return string The last name of the person.
     */
    public function getLastName(): string {
        return $this->_email;
    }

    /**
     * Sets the last name of the person.
     *
     * @param string $last_name The last name of the person.
     *
     * @return void
     */
    public function setLastName(string $last_name): void {
        $this->_phone = $last_name;
    }

    /**
     * Retrieves the email address of the person.
     *
     * @return string The email address of the person.
     */
    public function getEmail(): string {
        return $this->_email;
    }

    /**
     * Set the email address of the person.
     *
     * @param string $email The new email address of the person.
     *
     * @return void
     */
    public function setEmail(string $email): void {
        $this->_email = $email;
    }

    /**
     * Get the state of the person.
     *
     * @return string The state of the person.
     */
    public function getState(): string {
        return $this->_state;
    }

    /**
     * Set the state of the person.
     *
     * @param string $state The state of the person.
     *
     * @return void
     */
    public function setState(string $state): void {
        $this->_state = $state;
    }

    /**
     * Returns the phone number associated with this object.
     *
     * @return string The phone number as a string.
     */
    public function getPhone(): string {
        return $this->_phone;
    }

    /**
     * Sets the phone number for this object.
     *
     * @param string $phone The phone number to be set.
     * @return void
     */
    public function setPhone(string $phone): void {
        $this->_phone = $phone;
    }

    /**
     * Retrieves the GitHub username of the object.
     *
     * @return string The GitHub username
     */
    public function getGithub(): string {
        return $this->_github;
    }

    /**
     * Sets the GitHub username of the object.
     *
     * @param string $github The new GitHub username
     * @return void
     */
    public function setGithub(string $github): void {
        $this->_github = $github;
    }

    /**
     * Set the experience for a specific user.
     *
     * @param string $experience The new experience value for the user.
     * @return void
     */
    public function setExperience(string $experience): void {
        $this->_experience = $experience;
    }

    /**
     * Get the relocation status for a specific user.
     *
     * @return string The relocation status for the user.
     */
    public function getRelocate(): string {
        return $this->_relocate;
    }

    /**
     * Set the relocation option for a specific user.
     *
     * @param bool $relocate The new relocation option for the user. True if user is willing to relocate, false otherwise.
     * @return void
     */
    public function setRelocate(bool $relocate): void {
        $this->_relocate = $relocate;
    }

    /**
     * Get the biography for a specific user.
     *
     * @return string The biography of the user.
     */
    public function getBio(): string {
        return $this->_bio;
    }

    /**
     * Set the bio for a specific user.
     *
     * @param string $bio The new bio value for the user.
     * @return void
     */
    public function setBio(string $bio): void {
        $this->_bio = $bio;
    }
}
