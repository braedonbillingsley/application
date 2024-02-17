<?php
/**
 * This is my FORM VALIDATION for the job application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */

/**
 * Validates a name by checking if the concatenation of the first name and last name
 * consists only of alphabetic characters.
 *
 * @param string $firstName The first name to be validated.
 * @param string $lastName The last name to be validated.
 *
 * @return bool True if the name is valid and consists only of alphabetic characters, otherwise false.
 */
function validName(string $firstName, string $lastName): bool {
    return ctype_alpha($firstName.$lastName);
}

/**
 * Validates a GitHub link by checking if it is a valid URL.
 *
 * @param string $gitHubLink The GitHub link to be validated.
 *
 * @return bool True if the GitHub link is valid and is a valid URL, otherwise false.
 */
function validGithub(string $gitHubLink): bool {
    return filter_var($gitHubLink,
        FILTER_VALIDATE_URL) !== false;
}

/**
 * Validates an experience string value by checking if it is not empty.
 *
 * @param string $value The value to be validated.
 *
 * @return bool True if the value is not empty, otherwise false.
 */
function validExperience(string $value): bool {
    return !empty($value);
}

/**
 * Validates an email address using the filter_var function with the FILTER_VALIDATE_EMAIL filter.
 *
 * @param string $email The email address to be validated.
 *
 * @return bool True if the email address is valid, otherwise false.
 */
function validEmail(string $email): bool {
    return filter_var($email,
    FILTER_VALIDATE_EMAIL) !== false;
}