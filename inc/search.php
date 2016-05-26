<?php 
	require_once('../inc/model.php');
	$flag = false;
	if(isset($_GET['id'])) {
		$flag = true;
		$data = trim(addslashes(strip_tags($_GET['id'])));
	  	$db = new model();
	    $db1 = new model();
	    $db1->getQuery("INSERT INTO search_track(name) VALUES('{$data}')");
		$db->getQuery("SELECT b.id,i.img_thumb,b.name FROM boardgame AS b LEFT JOIN image AS i ON b.id=i.sku_no WHERE b.name LIKE'%{$data}%' LIMIT 20");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">

	<link rel="stylesheet" href="../css/jquery-mobile.min.css">

	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/sgbg.css">

	<script src="../js/jquery-1.12.2.min.js"></script>
	<script src="../js/jquery-mobile.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>

	<title>Saigon Board Game Store</title>
</head>

<body>

	<!-- Homepage -->
	<div data-role="page" id="search" data-theme="back">
	<?php include('../inc/header.php') ?>

	<div data-role="main" class="ui-content">
		<?php 
			if($db->getNumRows() != 0) {
          		while ($data = $db->getFetchAssoc()) {
		            $img = '../img/product/'.$data["img_thumb"];
		            if(!file_exists($img)) {
		              $img = './img/sgbg-default.png';
		            } 
		            echo '<a href="../inc/boardgame.php?id='.$data["id"].'" class="boardgame" data-transition="slide" >
		            		<div class="bg-picture">
		                    	<img src="'.$img.'" />
		                  	</div>
		                  	<div class="bg-name">
		                  		<p>'.$data["name"].'</p>
		                  	</div>
		                  	<div class="clear"></div>
		                  </a>'; 
       		 	}
         	}
        ?>      
  

	</div>

	<?php include('../inc/footer.php') ?>
</div>


</body>

</html>

