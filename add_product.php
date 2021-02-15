<?php

	include('repetetive/conn.php');

	$reference = $category = $sub_category = $name = $size = $price = $quantity = $path = $keyWords = '';
	$errors = array('reference' => '', 'category' => '', 'sub_category' => '', 'name' => '', 'size' => '', 'price' => '', 'path' => '', 'keyWords' => '');
	if(isset($_POST['submit'])){
		
		if(empty($_POST['reference'])){
			$errors['reference'] = 'A reference is required';
		} else{
			$reference = $_POST['reference'];
			if(!is_numeric($reference)){
				$errors['reference'] = 'Reference must be numbers only';
			}
        }


        
        if(empty($_POST['category'])){
			$errors['category'] = 'A category is required';
		} else{
			$category = $_POST['category'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $category)){
				$errors['category'] = 'invalid category, enter women fashion or men fashion';
			}
        } 

        if(empty($_POST['sub_category'])){
			$errors['sub_category'] = 'A sub category is required';
		} else{
			$sub_category = $_POST['sub_category'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $sub_category)){
				$errors['sub_category'] = 'Category must be letters and spaces only';
			}
        } 

        
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['name'] = 'Name must be letters and spaces only';
			}
		}
		
		if(empty($_POST['size'])){
			$errors['size'] = 'At least one size must be indicated';
		} else{
			$size = $_POST['size'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $size)){
				$errors['size'] = 'Sizes must be a comma separated list';
			}
        }

        if(empty($_POST['price'])){
			$errors['price'] = 'Price must be indicated';
		} else{
			$price = $_POST['price'];
			if(!is_numeric($price)){
				$errors['price'] = 'Price must be a number separated by .';
			}
        }

        if(empty($_POST['path'])){
			$errors['path'] = 'A path is required';
		} else{
			$path = 'images/'.$_POST['path'];
        } 
        


        if(empty($_POST['keyWords'])){
			$errors['keyWords'] = 'Enter one key word at least';
		} else{
			$keyWords = $_POST['keyWords'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $keyWords)){
				$errors['keyWords'] = 'Key words must be a comma separated list';
			}
        }
        
        $quantity = $_POST['quantity'];


		if(array_filter($errors)){
			// echo 'errors in form';
		} else {
            //echo 'form is valid';
            
			// header('Location: index.php');
            
            // escape sql chars
			$reference = mysqli_real_escape_string($conn, $_POST['reference']);
			$category = mysqli_real_escape_string($conn, $_POST['category']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $size = mysqli_real_escape_string($conn, $_POST['size']);
            $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $path = 'images/'.mysqli_real_escape_string($conn, $_POST['path']);
            $keyWords = mysqli_real_escape_string($conn, $_POST['keyWords']);


            
			// create sql
$q1="SELECT category_id from category where category_name='".$category."'";
            $q2="SELECT sub_category_id from subcat where sub_category='".$sub_category."'";
            $result1=mysqli_query($conn, $q1);
            $result2=mysqli_query($conn, $q2);
            $q11 = mysqli_fetch_assoc($result1);
            $q22 = mysqli_fetch_assoc($result2);
            print_r($q11);
			$sql = "INSERT INTO products(product_id, category_id, sub_category_id, product_name, keyo, price, photo, quantity, size) VALUES('$reference' ,".$q11['category_id']." ,".$q22['sub_category_id'].",'$name','$keyWords','$price','$path','$quantity','$size')";
			// save to db and check
			if(mysqli_query($conn, $sql)){
				// success
				header('Location: index.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}


		}

	} // end POST check
?>

<!DOCTYPE html>
<html>
<?php include('repetetive/header.php'); ?>
    <div class="container" id="form">
        <div class="card text-center">
            <div class="card-header">
                <h2>Admin pannel</h2>
            </div>
            <div class="card-body">
                <h3 class="card-title">Add product</h3>
                <div class="con">
                    <form class="row g-3 format" action="add_product.php" method="POST">
                        <div class="row row-pad">
                            <div class="col-md-6 form-field">
                                <input type="text" class="form-control input-text" id="reference" name="reference" value="<?php echo htmlspecialchars($reference) ?>" placeholder="Product reference">
                                <div class="text-error"><p><?php echo $errors['reference']; ?></p></div>
                            </div>
                            <div class="col-md-3 form-field">
                                <input type="text" class="form-control input-text" id="category" name="category" value="<?php echo htmlspecialchars($category) ?>" placeholder="Category (women fashion/men fashion)">
                                <div class="text-error"><p><?php echo $errors['category']; ?></p></div>
                            </div>
                            <div class="col-md-3 form-field">
                                <input type="text" class="form-control input-text" id="sub_category" name="sub_category" value="<?php echo htmlspecialchars($sub_category) ?>" placeholder="Sub-category (clothings/shoes)">
                                <div class="text-error"><p><?php echo $errors['sub_category']; ?></p></div>
                            </div>
                        </div>
                        <div class="row row-pad">
                            <div class="col-md-4 form-field">
                                <input type="text" name="name" class="form-control input-text" value="<?php echo htmlspecialchars($name) ?>" placeholder="Product name">
                                <div class="text-error"><p><?php echo $errors['name']; ?></p></div>
                            </div>
                            <div class="col-md-4 form-field">
                                <input type="text" name="size" class="form-control input-text" value="<?php echo htmlspecialchars($size) ?>" placeholder="size">
                                <div class="text-error"><p><?php echo $errors['size']; ?></p></div>
                            </div>
                            <div class="col-md-4 form-field">
                                <input type="number" class="form-control input-text" id="quantity" name="quantity" value="<?php echo htmlspecialchars($quantity) ?>" placeholder="Quantity">
                            </div>
                        </div>
                        <div class="row row-pad">
                            <div class="col-md-3 form-field">
                                <input type="text" class="form-control input-text" id="price" name="price" value="<?php echo htmlspecialchars($price) ?>" placeholder="Price in DH">
                                <div class="text-error"><p><?php echo $errors['price']; ?></p></div>
                            </div>
                            <div class="col-md-9 form-field">
                                <input type="file" class="form-control input-text" name="path" id="image_path" accept="image/*" value="<?php echo htmlspecialchars($path) ?>" placeholder="Enter product image path here">
                                <div class="text-error"><p><?php echo $errors['path']; ?></p></div>
                            </div>
                        </div>
                        <div class="row row-pad">
                            <div class="col-md-12 form-field">
                                <input type="text" class="form-control input-text" name="keyWords" id="key_words" value="<?php echo htmlspecialchars($keyWords) ?>" placeholder="Enter search key words">
                                <div class="text-error"><p><?php echo $errors['keyWords']; ?></p></div>
                            </div>
                        </div>
                        <div class="row row-pad">
                            <div class="col-md-12">
                                <input type="submit" name="submit" value="Add now" class="btn add-btn">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <a class="go" href="./admin_dashboard.html" >Go back to dashboard</a> <br>
    <?php include('repetetive/footer.php'); ?>

