<!-- 

3ande habet mashkel fel page deh : 

1. ana 3amlt table esmo product category 3ashan mayhslsh duplicate lel category 
msh rady lama a3mel add le category tedaf henak aw yemken ana fahma haga ghalat 

2.Msh rady asln lama a add product yedfhole fel table 3ashan feh constrain fa bey2ole
cant add or update child row tab 23mel eh ?

3.bey3mle dayman error lama ba3mel el header location php_self leeh ma3rfsh ?

4.tab3an tool ma ana msh 3arfa a3mel add lel product msh ha3raf 23melo display asln
wa le zalek ana kda dah akhry fe assignment el marade

-->


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
    <title>Add_Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php


    
if(isset($_POST['add'])){
    trim(htmlspecialchars(extract($_POST)));

    $errors = [] ;

    if(empty($product_name)){
        $errors [] = "Please enter the Product Name";
    }

    if(empty($product_description)){
        $errors [] = "Please enter the Product Description";
    }  

    if(empty($product_price)){
        $errors [] = "Please enter the Product Price";
    }
    

    if(empty($errors)){
    //     //do query
        $insert_query = "insert into products (`name` , `description` , `price` , `category_id`) values ('$product_name' , '$product_description' ,'$product_price' 
        , '$product_category') ";

        $run_query = mysqli_query($conn,$insert_query);

        if($run_query == true){
            // $_SESSION['success'] = "category is added successfully";
        }else{
            // $_SESSION['errors'] = "error in adding category";

        }

    }else{
        $_SESSION['product_name'] = $product_name;
        $_SESSION['product_description'] = $product_description;
        $_SESSION['product_price'] = $product_price;
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
        <label for="product_name">Product name</label>
        <input type="text" name="product_name" class="form-control" id="product_name" aria-describedby="product_name" placeholder="Enter Product Name">
    </div>
    <div class="form-group">
        <label for="product_description">Description</label>
        <input type="text" name="product_description" class="form-control" id="product_description" aria-describedby="product_description" placeholder="Enter Product Description">
    </div>
    <div class="form-group">
        <label for="product_price">Price</label>
        <input type="text" name="product_price" class="form-control" id="product_price" aria-describedby="product_price" placeholder="Enter Product Price">
    </div><br>
    <div>
    <label>Category:</label>
    <?php
    // $categoriesQuery = "SELECT products.*, category.* FROM category JOIN products ON category.id = products.category_id;";
    $categoriesQuery = "SELECT * FROM category";
    $categoriesResult = mysqli_query($conn, $categoriesQuery);

    $productsQuery = "SELECT products.*, category.name AS category_name FROM products JOIN category ON products.category_id = category.id";
    $productsResult = mysqli_query($conn, $productsQuery);
    ?>
    <select name="product_category" required>
        
        <option value="">Select Category</option>
        <?php while ($category = mysqli_fetch_assoc($categoriesResult)) { ?>
            <option value="<?php $category['id']?>"><?php echo $category['name']?></option>
        <?php } ?>

    </select>
    </div><br>
    <button type="submit" name="add" class="btn btn-success">Add</button>
    </form>

<?php

?>

    <h2>Products List</h2>
    <table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">price</th>
        <th scope="col">category</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($product  = mysqli_fetch_assoc($productsResult)) { ?>
                <tr>
                <td><?= $product['id']; ?></td>
                <td><?= $product['name']; ?></td>
                <td><?= $product['description']; ?></td>
                <td><?= $product['price']; ?></td>
                <td><?= $category['name']; ?></td>
                </tr>
            <?php } ?>

    </tbody>
    </table>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>



























<?php include "footer.php" ?>