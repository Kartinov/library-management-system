<?php

class Validator
{
    private array $data = [];

    private array $errors = [];

    private array $fields = [];

    public function __construct($postData, $fields)
    {
        $this->data = $postData;
        $this->fields = $fields;
    }

    public function validateRegistrationForm()
    {
        $this->validateInputs();

        $this->validateFirstName();
        $this->validateLastName();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }

    public function validateLoginForm()
    {
        $this->validateInputs();

        $this->allFieldsRequired();

        return $this->errors;
    }

    public function allFieldsRequired()
    {
        foreach ($this->data as $field) {
            if (empty($field)) {
                $this->addError('required', 'All fields are required');
                break;
            }
        }
    }

    private function validateInputs()
    {
        foreach ($this->fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                die('Something wrong happen.');
            }
        }
    }

    private function validateFirstName()
    {
        $val = trim($this->data['first_name']);

        if (empty($val)) {
            $this->addError('first_name', 'firstname cannot be empty');
        } else if (!preg_match('/^[a-zA-Z]{3,32}$/', $val)) {
            $this->addError('first_name', 'firstname must be 3-32 chars & only letters');
        }
    }

    private function validateLastName()
    {
        $val = trim($this->data['last_name']);

        if (empty($val)) {
            $this->addError('last_name', 'lastname cannot be empty');
        } else if (!preg_match('/^[a-zA-Z]{3,32}$/', $val)) {
            $this->addError('last_name', 'lastname must be 3-32 chars & only letters');
        }
    }

    private function validateEmail()
    {
        $val = trim($this->data['email']);

        if (empty($val)) {
            $this->addError('email', 'email cannot be empty');
        } else if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $this->addError('email', 'email must be valid email');
        }
    }

    private function validatePassword()
    {
        $val = trim($this->data['password']);

        if (empty($val)) {
            $this->addError('password', 'password cannot be empty');
        } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $val)) {
            $this->addError('password', 'password does not meet the requirements');
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
