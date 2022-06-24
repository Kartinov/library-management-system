<?php

class Users extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function store()
    {
        postOnly();

        $data = [ // field to be validated
            'first_name',
            'last_name',
            'email',
            'password',
        ];

        $validation = new Validator($_POST, $data);

        $errors = $validation->validateRegistrationForm();

        /* Checking if the email already exists in the database. */
        if (empty($errors)) {
            $emailExists = $this->userModel
                ->where(['email' => $_POST['email']])
                ->exists();

            if ($emailExists) {
                $errors['email'] = "Email already exists. Please choose a different email";
            }
        }

        if (!empty($errors)) {
            unset($_POST['password']);

            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect('home/register');
        }

        $data = [
            'role_id' => 2, // default role is user
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

        $this->userModel->create($data);
    }
}
