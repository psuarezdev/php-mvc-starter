<section class="d-flex flex-column align-items-center" style="height: 80vh;">
  <div class="w-75 m-auto">
    <a class="btn btn-primary" href="/user/create">Create</a>
  </div>
  <table class="table table-striped-columns table-hover text-center w-75 m-auto mt-0">
    <thead>
      <tr>
        <th scope="col">
          ID
        </th>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($paginate['users'] as $user): ?>
        <tr id="<?="user_".$user['id']?>">
          <th scope="row"><?=$user['id']?></th>
          <td><?=$user['name']?></td>
          <td><?=$user['surname']?></td>
          <td><?=$user['email']?></td>
          <td><?=$user['role']?></td>
          <td><?=DateTime::createFromFormat('Y-m-d', $user['created_at'])->format('d/m/Y')?></td>
          <td>
            <a href="/user/edit/<?=$user['id']?>" class="btn btn-primary">Edit</a>
            <a href="/user/delete/<?=$user['id']?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <nav>
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="/user/index&page=<?= $page > 1 ? $page - 1 : $page ?>">
          &lt;
        </a>
    </li>
      <?php for($i = 1; $i <= $paginate['pages']; $i++): ?>
        <li class="page-item <?=$i == $page ? 'active' : ''?>">
          <a class="page-link" href="/user/index&page=<?=$i?>">
            <?=$i?>
          </a>
        </li>
      <?php endfor; ?>
      <li class="page-item">
        <a class="page-link" href="/user/index&page=<?= $page < $paginate['pages'] ? $page + 1 : $page ?>">
          &gt;
        </a>
      </li>
    </ul>
  </nav>
</section>
