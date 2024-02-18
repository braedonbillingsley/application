<?php
/**
 * This is my FORM VALIDATION for the job application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

class Validate {

    /**
     * Validates the given name.
     *
     * @param string $name The name to be validated.
     * @return bool Returns true if the name is valid, false otherwise.
     */
    public static function validName(string $name): bool {
        return ctype_alpha($name);
    }

    /**
     * Validates the given GitHub link.
     *
     * @param string $gitHubLink The GitHub link to be validated.
     * @return bool Returns true if the GitHub link is valid, false otherwise.
     */
    public static function validGithub(string $gitHubLink): bool {
        return preg_match("/^(https?:\/\/)?(www\.)?github\.com\/.+$/i", trim($gitHubLink)) === 1;
    }

    /**
     * Validates an experience string value by checking if it is not empty.
     *
     * @param string $value The value to be validated.
     *
     * @return bool True if the value is not empty, otherwise false.
     */
    public static function validExperience(string $value): bool {
        return !empty($value);
    }

    /**
     * Validates the given phone number.
     *
     * @param string $value The phone number to be validated.
     * @return bool Returns true if the phone number is valid, false otherwise.
     */
    public static function validPhone(string $value): bool {
        return preg_match("/^\d*$/", $value);
    }

    /**
     * Validates an email address using the filter_var function with the FILTER_VALIDATE_EMAIL filter.
     *
     * @param string $email The email address to be validated.
     *
     * @return bool True if the email address is valid, otherwise false.
     */
    public static function validEmail(string $email): bool {
        return filter_var($email,
                FILTER_VALIDATE_EMAIL) !== false;
    }
}