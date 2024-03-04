<?php
/**
 * This is my Applicant_SubscribedToLists class for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */
class Applicant_SubscribedToLists extends Applicant {
    private array $_selectionsJobs;
    private array $_selectionsVerticals;


    /**
     * Constructs a new instance of the class.
     *
     * @param array $_selectionsJobs An array of job selections.
     * @param array $_selectionsVerticals An array of vertical selections.
     * @param string $_first_name The first name of the user.
     * @param string $_last_name The last name of the user.
     * @param string $_email The email of the user.
     * @param string $_state The state of the user.
     * @param string $_phone The phone number of the user.
     *
     * @return void
     */
    public function __construct(array $_selectionsJobs, array $_selectionsVerticals, string $_first_name, string $_last_name, string $_email, string $_state, string $_phone) {
        parent::__construct($_first_name, $_last_name, $_email, $_state, $_phone);
        $this->_selectionsJobs = $_selectionsJobs;
        $this->_selectionsVerticals = $_selectionsVerticals;
    }

    /**
     * Gets the job selections.
     *
     * @return array The array of job selections.
     */
    public function getSelectionsJobs(): array {
        return $this->_selectionsJobs;
    }

    /**
     * Sets the job selections for the user.
     *
     * @param array $selectionsJobs An array of job selections.
     *
     * @return void
     */
    public function setSelectionsJobs(array $selectionsJobs): void {
        $this->_selectionsJobs = $selectionsJobs;
    }

    /**
     * Gets the array of vertical selections.
     *
     * @return array The array of vertical selections.
     */
    public function getSelectionsVerticals(): array {
        return $this->_selectionsVerticals;
    }

    /**
     * Set the selections verticals.
     *
     * @param array $selectionsVerticals An array of selections verticals.
     * @return void
     */
    public function setSelectionsVerticals(array $selectionsVerticals): void {
        $this->_selectionsVerticals = $selectionsVerticals;
    }
}
