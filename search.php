
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title> notre site </title>
<link rel="stylesheet" href="dec.css">
<link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;800&display=swap" rel="stylesheet">
<link  rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div class="recherchebarr">      

  <form method="POST" class="navbar-form navbar-left" action="search.php">
          <div class="input-group">
              <input type="text" class="form-control" id="navbar-search-input" name="keyword" placeholder="Search for Product" required>
              <input type="submit" name="Envoyer">
              
          </div>
        </form>
        
</div>            
    </div>
    
 </div>
</div>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	
<?php include 'conn.php';?>
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	            <?php
	       			
	       			$conn = $pdo->open();

	       			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE keyo  LIKE :keyword");
	       			$stmt->execute([':keyword' => '%'.$_POST['keyword'].'%']);
	       			$row = $stmt->fetch();
	       			if($row['numrows'] < 1){
	       				echo '<h1 class="page-header">No results found for <i>'.$_POST['keyword'].'</i></h1>';
                        
	       			}
	       			else{
	       				echo '<h1 class="page-header">Search results for <i>'.$_POST['keyword'].'</i></h1>';
		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE keyo  LIKE :keyword");
						    $stmt->execute(['keyword' => '%'.$_POST['keyword'].'%']);
					 
						    foreach ($stmt as $row) {
                                
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
                                
						        $inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='20%' height='300px' class='thumbnail'>
                                                   <div>
                                                   <h4> product name : </h4>
		       									<h4><a href='product.php?product=".$row['slug']."'>".$row['product_name']."</a></h4>
		       								</div>
		       								<div class='box-footer'>
                                               <h4> Price: </h4>
                                                <b> ".number_format($row['price'], 2)." &#36</b>
		       									</div>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
							
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}
					}

                    $pdo->close();	

	       		?> 
	        	</div>
	        	
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	
</div>



</body>
</html>