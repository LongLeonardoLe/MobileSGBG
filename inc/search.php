<?php 
	require_once('../inc/model.php');
	$flag = false;
	if(isset($_POST['search'])) {
		$flag = true;
		$data = trim(addslashes(strip_tags($_POST['data'])));
	  	$db = new model();
	    $db1 = new model();
	    $db1->getQuery("INSERT INTO search_track(name) VALUES('{$data}')");
		$db->getQuery("SELECT b.id,i.img_thumb,b.name FROM boardgame AS b LEFT JOIN image AS i ON b.id=i.sku_no WHERE b.name LIKE'%{$data}%' LIMIT 20");
	}
?>
<div data-role="page" id="homepage" data-theme="back">
	<?php include('../inc/header.php') ?>

	<div data-role="main" class="ui-content">
		<?php 
			if($db->getNumRows() != 0) {
          		while ($data = $db->getFetchAssoc()) {
		            $img = '../img/product/'.$data["img_thumb"];
		            if(!file_exists($img)) {
		              $img = './img/sgbg-default.png';
		            } 
		            echo '<a href="#" class="boardgame">
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
