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
     * Process form data and validate the fields.
     *
     * @param object $f3 The Fat-Free Framework instance.
     * @param array $formFields The array of form fields to validate.
     * @param string $redirect The URL to redirect to if the form data is valid.
     *
     * @return void
     */
    function processFormData(object $f3, array $formFields, string $redirect): void {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $formIsValid = true; // keep track if all fields are valid
            foreach ($formFields as $field) {
                if(isset($_POST[$field])){
                    $value = $_POST[$field];
                    $fieldIsValid = $this->validateField($f3, $field, $value);
                    if(!$fieldIsValid) {
                        $formIsValid = false; // if even one field is not valid, the form becomes invalid
                    }
                    $_SESSION[$field] = $value;
                }
            }


            if($formIsValid) { // only reroute if the form data is valid
                $f3->reroute($redirect);
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
        $isValid = true;
        if ($field == 'first_name' || $field == 'last_name') {
            if (!Validate::validName($value)) {
                $isValid = false;
                $f3->set("{$field}_error", "Invalid {$field}");
            }
        } elseif ($field == 'email') {
            if (!Validate::validEmail($value)) {
                $isValid = false;
                $f3->set("{$field}_error", "Invalid {$field}");
            }
        } elseif ($field == 'github') {
            if (!Validate::validGithub($value)) {
                $isValid = false;
                $f3->set("{$field}_error", "Invalid {$field}");
            }
        } elseif ($field == 'experience') {
            if (!Validate::validExperience($value)) {
                $isValid = false;
                $f3->set("{$field}_error", "Invalid {$field}");
            }
        }

        return $isValid;
    }
}