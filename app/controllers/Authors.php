<?php

class Authors extends Controller
{
    private AuthorModel $authorModel;

    public function __construct()
    {
        $this->authorModel = $this->model('AuthorModel');
    }

    public function table()
    {
        adminOnly();

        $authors = $this->authorModel->get();

        $this->view('authors/table', [
            'authors' => $authors
        ]);
    }

    public function archieve($authorId)
    {
        $archieved = $this->authorModel
            ->where(['id' => $authorId])
            ->update([
                'id' => $authorId,
                'is_archived' => 1
            ]);


        if ($archieved) {
            session_put(
                'success',
                'You have successfully archived a author!'
            );

            redirect('authors/table');
        }

        redirect('authors/table');
    }

    public function restore($authorId)
    {
        $restored = $this->authorModel
            ->where(['id' => $authorId])
            ->update([
                'id' => $authorId,
                'is_archived' => 0
            ]);


        if ($restored) {
            session_put(
                'success',
                'You have successfully restored a author!'
            );

            redirect('authors/table');
        }

        redirect('authors/table');
    }

    public function create($authorId = null)
    {
        $action = 'create';

        if (is_numeric($authorId)) {
            $author = $this->authorModel->where(['id' => $authorId])->first();

            session_put('old', (array) $author);
            session_put('authorId', $authorId);
            $action = 'update';
        }

        $this->view('authors/create', [
            'action' => $action
        ]);
    }

    public function store()
    {
        postOnly();

        $data = [
            'first_name',
            'last_name',
            'bio'
        ];

        $validation = new Validator($_POST, $data);

        $errors = $validation->validateAuthorForm();

        if (!empty($errors)) {
            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect('authors/create');
        }

        $executed = $this->authorModel->create($_POST);

        if ($executed) {
            session_put(
                'success',
                'You have successfully added a author!'
            );

            redirect('authors/table');
        }

        session_put('errors', ['Something wrong happen, try again.']);
        redirect('authors/table');
    }

    public function update()
    {
        postOnly();

        $data = [
            'first_name',
            'last_name',
            'bio'
        ];

        $validation = new Validator($_POST, $data);

        $errors = $validation->validateAuthorForm();

        if (!empty($errors)) {
            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect('authors/create');
        }

        $data = $_POST;

        $data['id'] = session_once('authorId');

        $updated = $this->authorModel
            ->where(['id' => $data['id']])
            ->update($data);

        if ($updated) {
            session_put(
                'success',
                'You have successfully updated an author!'
            );

            redirect('authors/table');
        }
    }
}
