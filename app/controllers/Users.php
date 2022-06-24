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

        $executed = $this->userModel->create($data);

        if ($executed) {
            session_put(
                'success',
                'You have successfully registered!'
            );

            redirect('home/login');
        }

        session_put('errors', ['Something wrong happen, try again.']);
        redirect('home/register');
    }

    public function authenticate()
    {
        postOnly();

        $data = [ // field to be validated
            'email',
            'password',
        ];

        $validation = new Validator($_POST, $data);

        $errors = $validation->validateLoginForm();

        if (!empty($errors)) {
            session_put('errors', $errors);

            redirect('home/login');
        }

        $emailExists = $this->userModel
            ->where(['email' => $_POST['email']])
            ->exists();

        if ($emailExists) {
            $userPassword = $this->userModel
                ->selectRaw('password')
                ->get()[0]
                ->password;

            if (password_verify($_POST['password'], $userPassword)) {
                $user = $this->userModel
                    ->selectRaw(
                        '
                        users.id as user_id,
                        users.first_name as first_name,
                        users.last_name as last_name,
                        users.email as email,
                        roles.role as role'
                    )
                    ->join('roles', 'users.role_id', '=', 'roles.id')
                    ->get()[0];

                session_put('user', $user);
                redirect();
            }
        }
    }
}
