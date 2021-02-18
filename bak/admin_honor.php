<?php
header("Content-Type: text/html; charset=Big5");

include_once "./include/conn.php";

$sql_o = "SELECT * FROM honor_test ORDER BY event_id DESC";
$result = odbc_exec($conn, $sql_o)or die("SQL ERROR: " . odbc_errormsg());

?>

<?php include_once "./template/header.php";?>
<!-- more or less function -->
<script> 

  	function setMore(event_id) { 

    	document.getElementById( "moreOrLess" +  event_id).className = "readMore";
    	document.getElementById( "more" + event_id).style = "display: none;";
    	document.getElementById( "less" + event_id).style = "display: inline;";
    }

    function setLess(event_id) { 

    	document.getElementById( "moreOrLess" +  event_id ).className = "readLess";
    	document.getElementById( "less" + event_id).style = "display: none;";
    	document.getElementById( "more" + event_id).style = "display: inline;";
    }

    function showModal(event_id) {

    	var modal = document.getElementById( "modal-" + event_id);

    	modal.style.display = "block";
	    
	    window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
    }

    function closeModal(event_id) {

		var modal = document.getElementById( "modal-" + event_id);
		
		modal.style.display = "none";
    }


</script>
<!-- content start -->
<div class="header">
	<img src="./img/logo/tw_cga.png">
	<h1>Honor</h1>
</div>
<div class="container admin-honor-width">
	<div class="title">
		<h2>Data list</h2>
		<a href="./index.php">Home</a>
		<a href="./admin_honor_add_conf.php" >Add</a>
	</div>
	<?php 
		while($row = odbc_fetch_array($result)) { 
			$event_id = $row['event_id'];
			$dest = $row['dest'];
			$more = "more".$event_id;
			$less = "less".$event_id;
			$imgId = "img-".$event_id;
			$modalId = "modal-".$event_id;
			$moreOrLess = "moreOrLess".$event_id;
	?>
		<!-- display to items -->
		<div class="item">
			<div class="readLess" id="<?php echo $moreOrLess;?>">

				<button id="<?php echo $more; ?>" onclick="setMore(<?php echo $event_id?>)">...More</button>

				<p><?php echo $row['events'];?>
				<button id="<?php echo $less; ?>" onclick="setLess(<?php echo $event_id;?>)" style="display: none;">...Less</button>
				</p>

			</div>
			<!-- btns of actions -->
			<div class="btn admin-honor-width ">
				<button id="delete" onclick='location.href="./admin_honor_del_conf.php?event_id=<?php echo $event_id;?>"'>Delete</button>
				<button id="modify" onclick='location.href="./admin_honor_mod_conf.php?event_id=<?php echo $event_id;?>"'>Modify</button>
			</div>
			<!-- display of time -->
			<div class="time admin-honor-width ">
				<?php echo substr($row['created_at'], 0, 16)?>
			</div>
			<!-- image section -->
			<img id="<?php echo $imgId;?>" src="./img/icons/image_transB.png" onmouseout="this.src='./img/icons/image_transB.png'"
             onmouseover="this.src='<?php echo $dest;?>'" onclick="showModal(<?php echo $event_id;?>)">
		</div>
        <!-- modal box -->
        <div id="<?php echo $modalId;?>" class="img-modal">
        	<div class="container">
        		<div class="close">
        			<img src="./img/icons/cross_icon.png" onclick="closeModal(<?php echo $event_id;?>)">
        		</div>
        		<img src="<?php echo $dest;?>">
        	</div>
        </div>
	<?php } ?>
</div>
<?php include_once "./template/footer.php";?>