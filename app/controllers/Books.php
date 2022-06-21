<?php

class Books extends Controller
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
            ->join('categories', 'books.categorie_id', '=', 'categories.id')
            ->get();

        echo $books;
    }


    public function fetchBooks()
    {
        if (isset($_POST['action'])) {
            $book = $this->model('Book')
                ->selectRaw(
                    'books.*,
                authors.first_name as a_first_name,
                authors.last_name as a_last_name,
                categories.name as c_name
                '
                )
                ->join('authors', 'books.author_id', '=', 'authors.id')
                ->join('categories', 'books.categorie_id', '=', 'categories.id');

            if (isset($_POST['checkedCategories'])) {
                $book->whereIn([
                    'categorie_id', $_POST['checkedCategories'] // [1, 2, 3, 4]
                ]);
            }

            echo json_encode($book->get());
        }
    }
}
