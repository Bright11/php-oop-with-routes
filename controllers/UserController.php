<?php


require_once __DIR__ . '/../core/BaseController.php';

require_once __DIR__ . '/../models/User.php';

class UserController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $this->requireAuth(); // protect route

        $users = $this->userModel->getAllUsers();
        $this->view('users/index', ['users' => $users]);
    }

    public function create()
    {
        $this->requireAuth(); // protect route
        $this->view('users/create');
    }

    public function store()
    {

        $this->requireAuth(); // protect route

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $photo = null;
        $errors = [];

        if (empty($name)) $errors['name'] = 'Name is required';
        if (empty($email)) $errors['email'] = 'Email is required';



        if ($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = compact('name', 'email');
            $this->redirect('?action=create');
        }

        // ✅ Handle Image Upload
        if (!empty($_FILES['photo']['name'])) {
            $imageTmp = $_FILES['photo']['tmp_name'];
            $photo = time() . '_' . basename($_FILES['photo']['name']);
            $uploadPath = '../public/uploads/' . $photo;

            if (!move_uploaded_file($imageTmp, $uploadPath)) {
                $_SESSION['error'] = 'Failed to upload image.';
                $this->redirect('?action=create');
            }
        }

        $this->userModel->createUser($name, $email, $photo);
        $this->setFlash('success', 'User created successfully!');
        $this->redirect('?action=index');
    }

    public function edit($id)
    {
        $this->requireAuth(); // protect route


        $user = $this->userModel->getUserById($id);
        $this->view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $this->requireAuth(); // protect route


        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $user = $this->userModel->getUserById($id); // get existing user
        $photo = $user['photo']; // default: keep existing


        // ✅ Handle Image Upload
        if (!empty($_FILES['photo']['name'])) {
            $imageTmp = $_FILES['photo']['tmp_name'];
            $photo = time() . '_' . basename($_FILES['photo']['name']);
            $uploadPath = '../public/uploads/' . $photo;

            if (!move_uploaded_file($imageTmp, $uploadPath)) {
                $_SESSION['error'] = 'Failed to upload image.';
                $this->redirect('?action=create');
            }
        }
        $this->userModel->updateUser($id, $name, $email, $photo);
        $this->setFlash('success', 'User updated successfully!');
        $this->redirect('?action=index');
    }

    public function delete($id)
    {
        $this->requireAuth(); // protect route

        $this->userModel->deleteUser($id);
        $this->setFlash('success', 'User deleted.');
        $this->redirect('?action=index');
    }

    public function paginatedIndex()
    {
        $this->requireAuth(); // protect route

        $page = $_GET['page'] ?? 1;
        $limit = 5;
        $totalUsers = $this->userModel->getUserCount();
        $totalPages = ceil($totalUsers / $limit);
        $users = $this->userModel->getUsersByPage($page, $limit);

        $this->view('users/paginated', [
            'users' => $users,
            'totalPages' => $totalPages,
            'page' => $page
        ]);
    }
}
