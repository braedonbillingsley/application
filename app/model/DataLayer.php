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
        return ['first_name', 'last_name', 'email', 'phone'];
    }

    /**
     * Retrieves the optional form fields for personal information.
     *
     * This method returns an array of optional form fields that can be used to collect additional personal information.
     *
     * @return array The array of optional form fields for personal information. Each element represents a field name.
     */
    function getOptionalPersonalInfoFormFields(): array {
        return ['state', 'mailing'];
    }

    /**
     * Retrieves the form fields for experience information.
     *
     * This method returns an array of form fields that are required to collect experience information.
     *
     * @return array The array of form fields for experience information. Each element represents a field name.
     */
    function getExperienceFormFields(): array {
        return ['experience'];
    }

    /**
     * Returns an array of optional experience form fields.
     *
     * @return array The array of optional experience form fields.
     */
    function getOptionalExperienceFormFields(): array {
        return ['github', 'relocate', 'bio'];
    }
}