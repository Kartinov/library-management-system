<?php

class Home extends Controller
{
    public function index($name = '')
    {
        $books = $this->model('Book')
            ->selectRaw(
                'books.*,
                 authors.first_name as a_first_name,
                 authors.last_name as a_last_name,
                 authors.bio as a_bio,
                 categories.name as c_name
                '
            )
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.categorie_id', '=', 'categories.id');


        $this->view('home/index', ['books' => $books->get()]);
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
