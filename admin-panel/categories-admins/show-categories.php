<?php require '../layout/header.php' ; ?>
<?php require '../../config.php ' ; ?>

<?php  
    $categories = $conn->query("SELECT * FROM categorie");
    $categories->execute();
    $categorie= $categories->fetchAll(PDO::FETCH_OBJ);

?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Categories</h5>
             <a  href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create Categories</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                   <?php foreach($categorie as $category) :?>
                  <tr>
                    <th scope="row"><?php echo $category->ID  ?></th></th>
                    <td><?php echo $category->name  ?></td>
                     <td><a  href="update-category.php?id=<?php echo $category->ID  ?>" class="btn btn-warning text-white text-center ">Update </a></td>
                    <td><a href="delete-category.php?id=<?php echo $category->ID  ?>" class="btn btn-danger text-center">Delete </a></td>
                  </tr>
                </tbody>
                <?php  endforeach ;?>
              </table> 
            </div>
          </div>
        </div>
      </div>



      <?php require'../layout/footer.php' ; ?>