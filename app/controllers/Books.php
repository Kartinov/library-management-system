<?php

class Books extends Controller
{
    private BookModel $bookModel;

    public function __construct()
    {
        $this->bookModel = $this->model('BookModel');
    }

    public function index()
    {
    }

    /**
     * Shows a book
     * 
     * @param int bookId The ID of the book to show.
     */
    public function show($bookId = null)
    {
        if (!is_numeric($bookId)) {
            redirect();
        }

        $bookExists = $this->bookModel
            ->where(['id' => $bookId])
            ->exists();

        if (!$bookExists) {
            redirect();
        }

        $this->bookModel
            ->clearWhere()
            ->orWhere(['books.id', '=', $bookId]);

        $this->bookModel
            ->selectRaw(
                'books.*,
                     authors.first_name as a_first_name,
                     authors.last_name as a_last_name,
                     categories.name as c_name
                     '
            )
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.categorie_id', '=', 'categories.id');

        $book = $this->bookModel->get()[0];

        $this->view('book/show', ['book' => $book]);
    }


    /**
     * It fetches books from the database and returns them as JSON.
     */
    public function fetchBooks()
    {
        postOnly();

        if (isset($_POST['action'])) {
            $this->bookModel
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
                $this->bookModel->whereIn([
                    'categorie_id', $_POST['checkedCategories'] // [1, 2, 3, 4]
                ]);
            }

            echo json_encode($this->bookModel->get());
        }
    }
}
