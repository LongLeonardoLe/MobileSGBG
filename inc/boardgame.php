<?php 
	require_once('../inc/model.php');

	if(isset($_GET['id'])) {

		$data = trim(addslashes(strip_tags($_GET['id'])));
	  	$db = new model();
		$db->getQuery("SELECT b.*,i.img_thumb FROM `boardgame` AS b LEFT JOIN `image` AS i ON b.id=i.sku_no WHERE b.id='".$data."'");
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
		<div class="boardgame-hover">
			<div class="colorful-page-wrapper"></div>
		<?php 
			if($db->getNumRows() != 0) {
          		$data = $db->getFetchAssoc();
		        $img = '../img/product/'.$data["img_thumb"];
	            if(!file_exists($img)) {
	              $img = './img/sgbg-default.png';
	            } 
	            echo '<h1>'.$data['name'];
	            if(isset($data['publisher']) && $data['publisher'] != '') {
        			echo ' - '.$data['publisher'];
     			}
	            echo'</h1>
	         		<div class="ui-grid-solo">
	         			<img src="'.$img.'" alt="'.$data['name'].'" />
	         		</div>
	         		<p>
	         			<i class="fa fa-star"></i>
					    <i class="fa fa-star"></i>
					    <i class="fa fa-star"></i>
					    <i class="fa fa-star"></i>
					    <i class="fa fa-star-half-o"></i> 
					    <span class="doc">|</span>
                   		<strong><small>VND</small><strong> '.str_replace(",",".",$data['price']).'<span class="doc">|</span>
                   <strong>Inventory: </strong> <small>'.$data['inventory'].' STOCK</small>'; 
            		if($data['inventory'] == "IN") echo "<i class='fa fa-check'></i>"; 
            		else echo "<i class='fa fa-close'></i>";
				echo '</p>
					<h3><strong>Summary // <span>Nội dung</span></strong></h3>
					<p>';
				if($data['content_en'] != 0 && isset($data['content_en'])) echo $data['content_en'];
          		else echo "Content for this item will be updated soon.";
        		if($data['content_vi'] != 0 && isset($data['content_vi'])) echo " // <span>".$data['content_vi']."</span>";
          		else echo " // <span> Nội dung cho mặt hàng này sẽ được update trong những tuần sau.</span>"; 
          		echo '</p><p>';
          		if(isset($data['time']) && $data['time'] != '')
		        echo '<strong><i class="fa fa-clock-o"></i></strong>'.$data['time'].' minutes // <span>phút</span><span class="doc">|</span>';
		     	 if(isset($data['player']) && $data['player'] != '')
		        echo  '<strong><i class="fa fa-people"></i></strong>'.$data['player'].' people // <span>người</span>';
    			echo '</p>';
    			if(isset($data['tags']) && $data['tags'] != '') {
		        $tags = explode(',',$data['tags']);
		        echo '<p><strong><i class="fa fa-tags"></i></strong>';
		        foreach ($tags as $key => $tag) {
		          echo '<a href="#" class="tag" id="'.trim($tag).'">'.trim($tag).'</a>&nbsp;';
			    }
			        echo '</p>';
			    }
			    if(isset($data['sku_no']) && $data['sku_no'] != '') {
			        echo '<p><strong><i class="fa fa-ticket"></i>SKU# </strong> <small>'.$data['sku_no'].'</small> </p>';
			    }
         	} else {
         		echo 'Hello';
         		//return 404 http
         	}
        ?>      
  		</div>

	</div>

	<?php include('../inc/back.php') ?>
</div>


</body>

</html>