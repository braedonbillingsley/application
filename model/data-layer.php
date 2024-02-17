<?php
/**
 * This is my DATA-LAYER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */
class DataLayer {

    /**
     * Retrieves the form fields for personal information.
     *
     * This method returns an array of form fields that are required to collect personal information.
     *
     * @return array The array of form fields for personal information. Each element represents a field name.
     */

    function getPersonalInfoFormFields(): array {
        return ['first_name', 'last_name', 'email', 'state', 'phone'];
    }

    /**
     * Retrieves the form fields for experience information.
     *
     * This method returns an array of form fields that are required to collect experience information.
     *
     * @return array The array of form fields for experience information. Each element represents a field name.
     */
    function getExperienceFormFields(): array {
        return ['bio', 'github', 'experience', 'relocate'];
    }
}