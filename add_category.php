<?php 
include 'header.php';
include 'navbar.php' ;
include "dbConnection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add_category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php

if(isset($_POST['add'])){
    trim(htmlspecialchars(extract($_POST)));

    $errors = [] ;

    if(empty($add_category)){
        $errors [] = "Please enter the Category Name";
    }

    if(empty($errors)){
        //do query
        $insert_query = "insert into category (`name`) values ('$add_category') ";

        $run_query = mysqli_query($conn,$insert_query);

        if($run_query == true){
            // $_SESSION['success'] = "category is added successfully";
        }else{
            // $_SESSION['errors'] = "error in adding category";

        }

    }else{
        $_SESSION['add_category'] = $add_category;
        $_SESSION['errors'] = $errors;
    }



}else{
    // header("location:{$_SERVER['PHP_SELF']}");
}


?>
<?php
    if (isset($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $error) {?>

        <p style="color:red;"><?php echo $error ; ?></p>

<?php  
    }
    unset($_SESSION['errors']);
}
?>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
    <div class="form-group">
        <label for="add_category">Add Category</label>
        <input type="text" name="add_category" class="form-control" id="add_category" aria-describedby="add_category" placeholder="Enter Category Name">
    </div>
    <br>
    <button type="submit" name="add" class="btn btn-success">Add</button>
    </form>

<?php
    $categoriesQuery = "SELECT * FROM category";
    $categoriesResult = mysqli_query($conn, $categoriesQuery);
?>

    <h2>Categories List</h2>
    <table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($category = mysqli_fetch_assoc($categoriesResult)) { ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['name'] ?></td>
                    <td><?= $category['description'] ?></td>
                </tr>
            <?php } ?>

    </tbody>
    </table>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>



























<?php include "footer.php" ?>