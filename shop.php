<?php 

	include('repetetive/conn.php');

	


	
    if(isset($_GET['category'])){
		
		
		$category = mysqli_real_escape_string($conn, $_GET['category']);
        // $category = strval($_GET['category']);



        $sql="SELECT * FROM products WHERE category = '".$category."' AND sub_category = 'clothings' LIMIT 0, 3";
        



		

        $result = mysqli_query($conn, $sql);

        $clothes = mysqli_fetch_all($result, MYSQLI_ASSOC);



        $sql="SELECT * FROM products WHERE category = '".$category."' AND sub_category = 'shoes' LIMIT 0, 3";


	
        $result = mysqli_query($conn, $sql);

        $shoes = mysqli_fetch_all($result, MYSQLI_ASSOC);





		

	}


?>



<!DOCTYPE html>
<html lang="en">
<?php include('repetetive/header.php'); ?>    
    <div class="container" id="content">
        <?php include('repetetive/search-box.php'); ?>
        <div class="container">
            <div class="row ">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul id="categories-list">
                                <li><a href=""><?php echo $category?></a></li>
                                <li><a href="shopping.php?category=<?php echo $category ?>&&sub_category=clothings">clothings</a></li>
                                <li><a href="shopping.php?category=<?php echo $category ?>&&sub_category=shoes">shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <aside class="col-sm-12">
                            <img id="pub" src="Images/pexels-nataliya-vaitkevich-6214145.jpg" alt="pub">
                        </aside>
                    </div>
                </div>
                <main class="col-lg-9 menu">
                    <div class="fluid-container gallery-container">
                        <h3>clothes :</h3>
      
                        <div class="tz-gallery">
                    
                            <div class="row">

                                <h3></h3>    
                                <?php foreach($clothes as $clothe): ?>
                                    

                                    <div class="col-sm-6 col-md-4">
                                        <a class="lightbox" data-toggle="modal" data-target="<?php echo "#check-product{$clothe['product_id']}" ;?>" href="../images/park.jpg">
                                            <img src="<?php echo htmlspecialchars($clothe['photo']); ?>" alt="Park" class="item-image">
                                        </a>
                                        <h4 class="price">Price : <?php echo htmlspecialchars($clothe['price']); ?> DH</h4>                              
                                    </div>


                                    
                                    <div class="modal" id="<?php echo "check-product{$clothe['product_id']}" ; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <img src="<?php echo htmlspecialchars($clothe['photo']); ?>" alt="Sky" class="zoom-image">
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h2 class="modal-title"><?php echo htmlspecialchars($clothe['product_name']); ?></h3>
                                                            <h3>price : <?php echo htmlspecialchars($clothe['price']); ?> DH</h3>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <form action="info.php">
                                                                <label for="fcolor">Color:</label><br>
                                                                <input type="color" name="fcolor" id="fcolor" value=""><br>
                                                                <label for="fsize">Size:</label><br>
                                                                <?php foreach(explode(',', $clothe['size']) as $size): ?>
                                                                    <input type="radio" name="size" id="<?php echo htmlspecialchars($size); ?>" value="<?php echo htmlspecialchars($size); ?>">
								                                    <label for="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></label>
								                                <?php endforeach; ?>
                                                                <label for="quantity">Quantity :</label>
                                                                <input type="number" id="quantity" name="quantity" min="1" max="1000">                        
                                                            </form>                          
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fluid-container modal-footer">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-6 btna">
                                                            <button type="button" class="btn btn-primary">add to bag</button>
                                                        </div>
                                                        <div class="col-sm-6 btna">
                                                            <button type="button" class="btn btn-primary">buy now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                       
                                <?php endforeach; ?>
                                        
                            </div>         
                        </div>
                    
                    </div>

                    <h3>shoes :</h3>

                    <div class="fluid-container gallery-container">
      
                        <div class="tz-gallery">
                    
                            <div class="row">

                                <h3></h3>    
                                <?php foreach($shoes as $shoe): ?>
                                    

                                    <div class="col-sm-6 col-md-4">
                                        <a class="lightbox" data-toggle="modal" data-target="<?php echo "#check-product{$shoe['product_id']}" ;?>" href="../images/park.jpg">
                                            <img src="<?php echo htmlspecialchars($shoe['photo']); ?>" alt="Park" class="item-image">
                                        </a>
                                        <h4 class="price">Price : <?php echo htmlspecialchars($shoe['price']); ?> DH</h4>                              
                                    </div>


                                    
                                    <div class="modal" id="<?php echo "check-product{$shoe['product_id']}" ; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <img src="<?php echo htmlspecialchars($shoe['photo']); ?>" alt="Sky" class="zoom-image">
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h2 class="modal-title"><?php echo htmlspecialchars($shoe['product_name']); ?></h3>
                                                            <h3>price : <?php echo htmlspecialchars($shoe['price']); ?> DH</h3>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <form action="info.php">
                                                                <label for="fcolor">Color:</label><br>
                                                                <input type="color" name="fcolor" id="fcolor" value=""><br>
                                                                <label for="fsize">Size:</label><br>
                                                                <?php foreach(explode(',', $shoe['size']) as $size): ?>
                                                                    <input type="radio" name="size" id="<?php echo htmlspecialchars($size); ?>" value="<?php echo htmlspecialchars($size); ?>">
								                                    <label for="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></label>
								                                <?php endforeach; ?>
                                                                <label for="quantity">Quantity :</label>
                                                                <input type="number" id="quantity" name="quantity" min="1" max="1000">                        
                                                            </form>                          
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fluid-container modal-footer">
                                                    <div class="row justify-content-center">
                                                        <div class="col-sm-6 btna">
                                                            <button type="button" class="btn btn-primary">add to bag</button>
                                                        </div>
                                                        <div class="col-sm-6 btna">
                                                            <button type="button" class="btn btn-primary">buy now</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                       
                                <?php endforeach; ?>
                                        
                            </div>         
                        </div>
                    
                    </div>
                    
                </main>
            </div>
        </div>
        
    </div>


    <br><br><br>
    <a href="add_product.php">add product</a>

    <?php include('repetetive/footer.php'); ?>
</html>
