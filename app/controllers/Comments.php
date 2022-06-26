<?php

class Comments extends Controller
{
    private CommentModel $commentModel;

    public function __construct()
    {
        $this->commentModel = $this->model('CommentModel');
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

    public function delete()
    {
    }
}
