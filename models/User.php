<?php

class User
{
  private int $id;
  private string $name;
  private string $surname;
  private int $age;
  private string $description;
  private string $email;
  private string $password;
  private string $role = 'user';
  private ?string $image;
  private string $created_at;
  private ?string $updated_at;
  private $db;

  public function __construct()
  {
    $this->db = DB::connect();
  }

  public function getAll(): array | bool
  {
    try {
      $sql = "SELECT * FROM users ORDER BY id DESC";
      $users = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);

      return $users;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getOne(): object | bool
  {
    try {
      $sql = "SELECT * FROM users WHERE id = {$this->db->real_escape_string($this->getId())}";
      $users = $this->db->query($sql);

      return $users->fetch_object();
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function save(): bool
  {
    try {
      $sql = "INSERT INTO users (name, surname, age, description, email, password, role, image, created_at, updated_at) 
              VALUES (
                {$this->db->real_escape_string($this->getName())},
                {$this->db->real_escape_string($this->getSurname())},
                {$this->db->real_escape_string($this->getAge())},
                {$this->db->real_escape_string($this->getDescription())},
                {$this->db->real_escape_string($this->getEmail())},
                {$this->db->real_escape_string($this->getPassword())},
                {$this->db->real_escape_string($this->getRole())},
                {$this->db->real_escape_string($this->getImage())},
                {$this->db->real_escape_string($this->getCreatedAt())},
                {$this->db->real_escape_string($this->getUpdatedAt())}
              )";

      $insert = $this->db->query($sql);

      return $insert;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function update(): bool
  {
    try {
      $sql = "UPDATE users SET 
                name = {$this->db->real_escape_string($this->getName())},
                surname = {$this->db->real_escape_string($this->getSurname())},
                age = {$this->db->real_escape_string($this->getAge())},
                description = {$this->db->real_escape_string($this->getDescription())},
                email = {$this->db->real_escape_string($this->getEmail())},
                password = {$this->db->real_escape_string($this->getPassword())},
                role = {$this->db->real_escape_string($this->getRole())},
                image = {$this->db->real_escape_string($this->getImage())},
                updated_at = {$this->db->real_escape_string($this->getUpdatedAt())}
              WHERE id = {$this->db->real_escape_string($this->getId())}";

      $update = $this->db->query($sql);

      return $update;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function delete(): bool
  {
    try {
      $delete = $this->db->query("DELETE FROM users WHERE id = {$this->db->real_escape_string($this->getId())}}");

      return $delete;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function paginate(int $page, int $itemsPerPage = 10, string $order = 'ASC'): array | bool
  {
    try {
      $sql = "SELECT * FROM users ORDER BY id {$order}";
      $allUsers = $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
      $pages = ceil(count($allUsers) / $itemsPerPage);

      $users = array_slice($allUsers, ($page - 1) * $itemsPerPage, $itemsPerPage);

      return [
        'users' => $users,
        'pages' => $pages
      ];
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): void
  {
    $this->id = $this->db->real_escape_string($id);
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $this->db->real_escape_string($name);
  }

  public function getSurname(): string
  {
    return $this->surname;
  }

  public function setSurname(string $surname): void
  {
    $this->surname = $this->db->real_escape_string($surname);
  }

  public function getAge(): int
  {
    return $this->age;
  }

  public function setAge(int $age): void
  {
    $this->age = $this->db->real_escape_string($age);
  }

  public function getDescription(): string
  {
    return $this->description;
  }

  public function setDescription(string $description): void
  {
    $this->description = $this->db->real_escape_string($description);
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): void
  {
    $this->email = $this->db->real_escape_string($email);
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): void
  {
    $this->password = $this->db->real_escape_string($password);
  }

  public function getRole(): string
  {
    return $this->role;
  }

  public function setRole(string $role): void
  {
    $this->role = $this->db->real_escape_string($role);
  }

  public function getImage(): ?string
  {
    return $this->image;
  }

  public function setImage(?string $image): void
  {
    $this->image = $this->db->real_escape_string($image);
  }

  public function getCreatedAt(): string
  {
    return $this->created_at;
  }

  public function setCreatedAt(string $created_at): void
  {
    $this->created_at = $this->db->real_escape_string($created_at);
  }

  public function getUpdatedAt(): ?string
  {
    return $this->updated_at;
  }

  public function setUpdatedAt(?string $updated_at): void
  {
    $this->updated_at = $this->db->real_escape_string($updated_at);
  }
}
