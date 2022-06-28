<?php

class Comments extends Controller
{
    private CommentModel $commentModel;

    public function __construct()
    {
        adminOnly();

        $this->commentModel = $this->model('CommentModel');
    }

    public function index()
    {
        redirect('comments/table');
    }

    public function store($bookId)
    {
        postOnly();

        $validation = new Validator($_POST, ['comment_text']);

        $errors = $validation->validateCommentForm();

        if (!empty($errors)) {
            session_put('errors', $errors);

            redirect("books/show/{$bookId}");
        }

        $data = [
            'user_id' => session_get('user')->user_id,
            'book_id' => $bookId,
            'comment_text' => $_POST['comment_text']
        ];

        $executed = $this->commentModel->create($data);

        if ($executed) {
            session_put(
                'success',
                'Your comment has been submited'
            );

            redirect("books/show/{$bookId}");
        }

        session_put('errors', ['Something wrong happen, try again.']);
        redirect("books/show/{$bookId}");
    }

    public function delete($commentId, $bookId)
    {
        $this->commentModel->delete('id', $commentId);

        redirect("books/show/{$bookId}");
    }

    public function table()
    {
        $comments = $this->commentModel
            ->selectRaw('
            comments.*,
            users.first_name as u_first_name,
            users.last_name as u_last_name,
            books.image_url,
            books.title
            ')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->join('books', 'books.id', '=', 'comments.book_id')
            ->where(['is_approved' => 0])
            ->get();

        $this->view('comments/table', [
            'comments' => $comments
        ]);
    }

    public function approve($commentId)
    {
        $data = [
            'id' => $commentId,
            'is_approved' => 1
        ];

        $this->commentModel
            ->where(['id' => $data['id']])
            ->update($data);

        session_put('success', 'Comment approved.');
        redirect('comments/table');
    }
}
