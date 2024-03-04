<?php
/**
 * This is my FORM-CONTROLLER for the application app.
 *
 * https://www.bbillingsley.greenriverdev.com/328/application
 *
 * @author Braedon Billingsley
 */
class FormController {

    /**
     * Processes the form data and performs necessary actions based on the provided parameters.
     *
     * @param object $f3 The Fat-Free Framework instance.
     * @param array $requiredFields An array of required form fields.
     * @param array $nonRequiredFields An array of non-required form fields.
     * @param string $redirect The URL to redirect to if the form data is valid.
     * @return void
     */
    public function processFormData(object $f3, array $requiredFields, array $nonRequiredFields, string $redirect): void {

        // Set empty error messages to initialize
        $this->initializeErrorMessages($f3, $requiredFields);

        // Call methods to process fields
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formIsValid = $this->processRequiredFields($f3, $requiredFields);
            $this->processNonRequiredFields($f3, $nonRequiredFields);

            // Only reroute if the form data is valid
            if ($formIsValid) {
                $f3->reroute($redirect);
            }
        }
    }

    /**
     * Initializes error messages for the specified fields.
     *
     * @param object $f3 The object on which to set the error messages.
     * @param array $requiredFields The array of required fields.
     * @return void
     */
    private function initializeErrorMessages(object $f3, array $requiredFields): void {

        // Initialize each error variable with empty string
        foreach ($requiredFields as $field) {
            $f3->set("{$field}_error", '');
        }
    }

    /**
     * Processes the required fields in the form.
     *
     * @param object $f3 The object on which to set the error messages and store the field values.
     * @param array $requiredFields The array of required fields.
     * @return bool Returns true if all required fields are valid, false otherwise.
     */
    private function processRequiredFields(object $f3, array $requiredFields): bool {

        // Initialize variable and default to true
        $formIsValid = true;

        // Validate each field and set to empty string if not required or valid.
        foreach ($requiredFields as $field) {
            $value = $_POST[$field] ?? '';
            $fieldIsValid = $this->validateField($f3, $field, $value);

            // If field is valid capitalize fist letters of name and save to session
            if (!$fieldIsValid) {
                $formIsValid = false;
            } else {
                if($field == 'first_name' || $field == 'last_name'){
                    $_SESSION[$field] = ucwords(strtolower($value));
                } else {
                    $_SESSION[$field] = $value;
                }
            }
        }
        return $formIsValid;
    }

    /**
     * Process non-required fields and store the values in the session.
     *
     * @param object $f3 The object containing the session.
     * @param array $nonRequiredFields An array of non-required field names.
     *
     * @return void
     */
    private function processNonRequiredFields(object $f3, array $nonRequiredFields): void {

        // Validate each non required field and set to empty string.
        foreach ($nonRequiredFields as $field) {
            $value = $_POST[$field] ?? '';

            // GITHUB field
            if($field == 'github' && $value != '') {
                if (Validate::validGithub($value)) {
                    $_SESSION[$field] = $value;
                } else {
                    $f3->set("{$field}_error", 'Invalid Github link provided');
                }

                // RELOCATE field
            } else if($field == 'relocate' && $value != '') {
                $_SESSION[$field] = ucfirst($value);

                // BIO field
            } else if($field == 'bio' && $value != '') {
                $_SESSION[$field] = $value;

                // STATE field
            } else if ($field == 'state' && isset($_POST['state'])) {
                $selected_state = $_POST['state'];
                $_SESSION[$field] = $selected_state;

                // MAILING field
            } else if($field == 'mailing') {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                $_SESSION[$field] = $value;
            }
        }
    }

    /**
     * Validate a field based on its name and value.
     *
     * @param object $f3 The Fat-Free Framework instance.
     * @param string $field The name of the field to validate.
     * @param mixed $value The value of the field.
     *
     * @return bool Returns true if the field is valid, false otherwise.
     */
    private function validateField(object $f3, string $field, mixed $value): bool {

        // Initialize variable and default to true
        $isValid = true;

        // FIRST NAME and LAST NAME fields
        if ($field == 'first_name' || $field == 'last_name') {
            if (!Validate::validName($value)) {
                $isValid = false;

                // Set error message
                $f3->set("{$field}_error", "Valid {$field} is required");
            }
        }

        // EMAIL field
        else if ($field == 'email') {
            if (!Validate::validEmail($value)) {
                $isValid = false;

                // Set error message
                $f3->set("{$field}_error", "Valid {$field} is required");
            }
        }

        // PHONE fields
        else if ($field == 'phone') {
            if (!Validate::validPhone($value)) {
                $isValid = false;

                // Set error message
                $f3->set("{$field}_error", "Valid {$field} is required");
            }
        }

        // EXPERIENCE fields
        else if ($field == 'experience') {
            if (!Validate::validExperience($value)) {
                $isValid = false;

                // Set error message
                $f3->set("{$field}_error", "Valid {$field} is required");
            }
        }
        return $isValid;
    }
}