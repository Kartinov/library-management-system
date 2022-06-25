<?php

class Home extends Controller
{
    public function index()
    {
        $categories = $this->model('CategoryModel')
            ->where(['is_archived' => 0])
            ->get();

        $this->view('home/index', [
            'categories' => $categories
        ]);
    }

    /**
     * It loads the login view.
     */
    public function login()
    {
        guestOnly();

        $this->view('home/login');
    }

    /**
     * It loads the register view.
     */
    public function register()
    {
        guestOnly();

        $this->view('home/register');
    }
}
