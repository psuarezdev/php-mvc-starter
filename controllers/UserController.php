<?php

class UserController 
{
  private $modelPath = 'models/User.php';
  private $viewPath = 'views/user/';

  public function index()
  {
    require_once $this->modelPath;

    $page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;

    $user = new User();
    $paginate = $user->paginate($page);

    require_once $this->viewPath . 'index.php';
  }

  public function create()
  {
    require_once $this->viewPath . 'create.php';
  }

  public function save()
  {
    if (isset($_POST)) {
      require_once $this->modelPath;

      $user = new User();

      $user->setName($_POST['name']);
      $user->setSurname($_POST['surname']);
      $user->setAge($_POST['age']);
      $user->setDescription($_POST['description']);
      $user->setEmail($_POST['email']);
      $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cost' => 4]));

      $save = $user->save();

      $save ? $_SESSION['user_save'] = 'User registered successfully' : $_SESSION['user_save'] = 'User registration failed';
    }

    header('Location: ' . BASE_URL . 'user/create');
  }

  public function edit()
  {
    if (isset($_GET['id'])) {
      require_once $this->modelPath;

      $user = new User();
      $user->setId($_GET['id']);
      $user = $user->getOne();

      require_once $this->viewPath . 'edit.php';
    }
  }

  public function update()
  {
    if (isset($_POST)) {
      require_once $this->modelPath;
      $user = new User();
      $user->setId($_POST['id']);
      $user->setName($_POST['name']);
      $user->setSurname($_POST['surname']);
      $user->setAge($_POST['age']);
      $user->setDescription($_POST['description']);
      $user->setEmail($_POST['email']);
      $user->setPassword($_POST['password']);
      $user->setRole($_POST['role']);
      $update = $user->update();

      $update ? $_SESSION['user_update'] = 'User updated successfully' : $_SESSION['user_update'] = 'User update failed';
    }

    header('Location: ' . BASE_URL . 'user');
  }

  public function delete()
  {
    if (isset($_GET['id'])) {
      require_once $this->modelPath;

      $user = new User();
      $user->setId($_GET['id']);
      $delete = $user->delete();

      $delete ? $_SESSION['user_delete'] = 'User deleted successfully' : $_SESSION['user_delete'] = 'User deletion failed';
    }

    header('Location: ' . BASE_URL . 'user');
  }
}
