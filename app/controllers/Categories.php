<?php
class Categories extends Controller
{
    private CategoryModel $categoryModel;

    public function __construct()
    {
        adminOnly();

        $this->categoryModel = $this->model('CategoryModel');
    }

    public function index()
    {
        redirect('categories/table');
    }

    public function table()
    {
        adminOnly();

        $categories = $this->categoryModel->get();

        $this->view('categories/table', [
            'categories' => $categories
        ]);
    }

    public function archieve($bookId)
    {
        $archieved = $this->categoryModel
            ->where(['id' => $bookId])
            ->update([
                'id' => $bookId,
                'is_archived' => 1
            ]);


        if ($archieved) {
            session_put(
                'success',
                'You have successfully archived a category!'
            );

            redirect('categories/table');
        }

        redirect('categories/table');
    }

    public function restore($bookId)
    {
        $restored = $this->categoryModel
            ->where(['id' => $bookId])
            ->update([
                'id' => $bookId,
                'is_archived' => 0
            ]);


        if ($restored) {
            session_put(
                'success',
                'You have successfully restored a category!'
            );

            redirect('categories/table');
        }

        redirect('categories/table');
    }

    public function create($categoryId = null)
    {
        $action = 'create';

        if (is_numeric($categoryId)) {
            $category = $this->categoryModel->where(['id' => $categoryId])->first();

            session_put('old', (array) $category);
            session_put('categoryId', $categoryId);
            $action = 'update';
        }

        $this->view('categories/create', [
            'action' => $action
        ]);
    }

    public function store()
    {
        postOnly();

        $validation = new Validator($_POST, ['name']);

        $errors = $validation->validateCategoryForm();

        if (!empty($errors)) {
            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect('categories/create');
        }

        $executed = $this->categoryModel->create($_POST);

        if ($executed) {
            session_put(
                'success',
                'You have successfully added a category!'
            );

            redirect('categories/table');
        }

        session_put('errors', ['Something wrong happen, try again.']);
        redirect('categories/table');
    }

    public function update()
    {
        postOnly();

        $validation = new Validator($_POST, ['name']);

        $errors = $validation->validateCategoryForm();

        $categoryId = session_once('categoryId');

        if (!empty($errors)) {
            session_put('errors', $errors);
            session_put('old', $_POST);

            redirect("categories/create/{$categoryId}");
        }

        $data = $_POST;

        $data['id'] = $categoryId;

        $updated = $this->categoryModel
            ->where(['id' => $data['id']])
            ->update($data);

        if ($updated) {
            session_put(
                'success',
                'You have successfully updated an category!'
            );

            redirect('categories/table');
        }
    }
}
