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

    public function validateBookForm()
    {
        $this->validateInputs();

        $this->validateTitle();
        $this->validateImageUrl();
        $this->validatePublicationYear();
        $this->validateNumOfPages();
        $this->validateCategorieId();
        $this->validateAuthorId();

        return $this->errors;
    }

    public function validateCategoryForm()
    {
        $this->validateInputs();

        $this->validateCategoryName();

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

    public function validateTitle()
    {
        $val = trim($this->data['title']);

        if (empty($val)) {
            $this->addError('title', 'title cannot be empty');
        } elseif (strlen($val) < 3 || strlen($val) > 64) {
            $this->addError('title', 'title must be 3-64 chars');
        }
    }

    public function validateImageUrl()
    {
        $val = trim($this->data['image_url']);

        if (empty($val)) {
            $this->addError('image_url', 'image url cannot be empty');
        } elseif (!filter_var($val, FILTER_VALIDATE_URL)) {
            $this->addError('image_url', 'image url have to be a valid url address');
        }
    }

    public function validateNumOfPages()
    {
        $val = trim($this->data['num_of_pages']);

        if (empty($val)) {
            $this->addError('num_of_pages', 'Number of pages cannot be empty');
        } elseif (!is_numeric($val)) {
            $this->addError('num_of_pages', 'Number of pages has to be a number');
        }
    }

    public function validatePublicationYear()
    {
        $val = trim($this->data['year_of_publication']);

        if (empty($val)) {
            $this->addError('year_of_publication', 'Year of publication cannot be empty');
        } elseif (!is_numeric($val)) {
            $this->addError('year_of_publication', 'Year of publication has to be a number');
        }
    }

    public function validateCategorieId()
    {
        $val = trim($this->data['categorie_id']);

        if (empty($val)) {
            $this->addError('categorie_id', 'Category cannot be empty');
        }
    }

    public function validateAuthorId()
    {
        $val = trim($this->data['author_id']);

        if (empty($val)) {
            $this->addError('author_id', 'Author cannot be empty');
        }
    }

    public function validateCategoryName()
    {
        $val = trim($this->data['name']);

        if (empty($val)) {
            $this->addError('category', 'category name field cannot be empty');
        } elseif (strlen($val) < 3 || strlen($val) > 64) {
            $this->addError('category', 'category name must be 3-64 chars');
        }
    }

    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
}
