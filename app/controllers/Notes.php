<?php

class Notes extends Controller
{
    private NoteModel $noteModel;

    public function __construct()
    {
        $this->noteModel = $this->model('NoteModel');
    }

    public function store()
    {
        postOnly();

        if (isset($_POST['action']) && $_POST['action'] == 'storeUserNote') {

            $data = [
                'user_id' => session_get('user')->user_id,
                'book_id' => $_POST['bookId'],
                'note_text' => $_POST['noteText']
            ];

            $executed = $this->noteModel->create($data);

            if ($executed) {
                echo true;
            }
        }
    }

    public function fetchUserNotes()
    {
        postOnly();

        if (isset($_POST['action']) && $_POST['action'] == 'fetchUserNotes') {
            $notes = $this->noteModel
                ->where([
                    'user_id' => session_get('user')->user_id,
                    'book_id' => $_POST['bookId']
                ])
                ->orderBy('updated_at', 'DESC')
                ->get();

            echo json_encode($notes);
        }
    }

    public function delete()
    {
        postOnly();

        if (isset($_POST['action']) && $_POST['action'] == 'deleteUserNote') {
            $deleted = $this->noteModel->delete('id', $_POST['noteId']);

            if ($deleted) echo true;
        }
    }

    public function edit()
    {
        postOnly();

        if (isset($_POST['action']) && $_POST['action'] == 'editUserNote') {
            $updated = $this->noteModel
                ->where(['id' => $_POST['noteId']])
                ->update([
                    'id' => $_POST['noteId'],
                    'note_text' => $_POST['noteText']
                ]);

            if ($updated) echo true;
        }
    }
}
