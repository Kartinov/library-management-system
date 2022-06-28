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
        redirect();
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

        $authenticated = session_has('user') ? true : false;

        $comments = null;
        $commented = false;

        if ($authenticated) {
            $commentModel = $this->model('CommentModel');

            $commented = $commentModel
                ->where([
                    'user_id' => session_get('user')->user_id,
                    'book_id' => $bookId
                ])
                ->first();

            $comments = $commentModel
                ->clearWhere()
                ->selectRaw('
                     comments.*,
                     users.first_name as u_first_name,
                     users.last_name as u_last_name
                ')
                ->join('users', 'users.id', '=', 'comments.user_id')
                ->where([
                    'is_approved' => 1,
                    'book_id' => $bookId
                ])
                ->get();
        }

        $this->view('books/show', [
            'book' => $book,
            'bookId' => $bookId,
            'authenticated' => $authenticated,
            'comments' => $comments,
            'commented' => $commented
        ]);
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

    public function table()
    {
        $books = $this->bookModel
            ->selectRaw(
                'books.*,
                authors.first_name as a_first_name,
                authors.last_name as a_last_name,
                categories.name as c_name
                '
            )
            ->join('authors', 'books.author_id', '=', 'authors.id')
            ->join('categories', 'books.categorie_id', '=', 'categories.id')
            ->get();

        $this->view('books/table', ['books' => $books]);
    }

    public function create($bookId = null)
    {
        $categories = $this->model('CategoryModel')
            ->where(['is_archived' => 0])
            ->get();

        $authors = $this->model('AuthorModel')
            ->where(['is_archived' => 0])
            ->get();

        $action = 'create';

        if (is_numeric($bookId)) {
            $book = $this->bookModel->where(['id' => $bookId])->get()[0];

            session_put('old', (array) $book);
            session_put('bookId', $bookId);
            $action = 'update';
        }

        $this->view('books/create', [
            'categories' => $categories,
            'authors' => $authors,
            'action' => $action
        ]);
    }

    public function store()
    {
        postOnly();

        $data = [ // field to be validated
            'title',
            'image_url',
            'author_id',
            'categorie_id',
            'num_of_pages',
            'year_of_publication',
        ];

        $validation = new Validator($_POST, $data);

        $errors = $validation->validateBookForm();

        if (empty($errors)) {
            $authorExists = $this->model('AuthorModel')
                ->where(['id' => $_POST['author_id']])
                ->exists();

            $categoryExists = $this->model('CategoryModel')
                ->where(['id' => $_POST['categorie_id']])
                ->exists();

            if (!$authorExists) {
                $errors['author'] = 'Author does not exists.';
            }

            if (!$categoryExists) {
                $errors['category'] = 'Category does not exists.';
            }
        }

        if (!empty($errors)) {
            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect('books/create');
        }

        $executed = $this->bookModel->create($_POST);

        if ($executed) {
            session_put(
                'success',
                'You have successfully added a book!'
            );

            redirect('books/table');
        }

        session_put('errors', ['Something wrong happen, try again.']);
        redirect('books/create');
    }

    public function delete($bookId)
    {
        $this->bookModel->delete('id', $bookId);

        session_put('success', 'Book deleted.');
        redirect('books/table');
    }

    public function update()
    {
        postOnly();

        $data = [ // field to be validated
            'title',
            'image_url',
            'author_id',
            'categorie_id',
            'num_of_pages',
            'year_of_publication',
        ];

        $validation = new Validator($_POST, $data);

        $errors = $validation->validateBookForm();

        if (empty($errors)) {
            $authorExists = $this->model('AuthorModel')
                ->where(['id' => $_POST['author_id']])
                ->exists();

            $categoryExists = $this->model('CategoryModel')
                ->where(['id' => $_POST['categorie_id']])
                ->exists();

            if (!$authorExists) {
                $errors['author'] = 'category does not exists.';
            }

            if (!$categoryExists) {
                $errors['category'] = 'category does not exists.';
            }
        }

        if (!empty($errors)) {
            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect('books/create');
        }

        $data = $_POST;

        $data['id'] = session_once('bookId');

        $updated = $this->bookModel
            ->where(['id' => $data['id']])
            ->update($data);

        if ($updated) {
            session_put(
                'success',
                'You have successfully updated a book!'
            );

            redirect('books/table');
        }

        session_put('errors', ['Something wrong happen, try again.']);
        redirect('books/create');
    }
}
