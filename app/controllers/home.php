<?php

class Home extends Controller
{
    public function index($name = '')
    {
        $user = $this->model('User');
        $user->name = $name;

        $this->view('home/index', ['name' => $user->name]);
    }

    public function login()
    {
        $this->view('home/login');
    }

    public function register()
    {
        $this->view('home/register');
    }
}
