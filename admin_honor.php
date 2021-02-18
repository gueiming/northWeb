<?php
header("Content-Type: text/html; charset=Big5");

include_once "./include/conn.php";

$sql_o = "SELECT * FROM honor ORDER BY event_id DESC";
$result = odbc_exec($conn, $sql_o)or die("SQL ERROR: " . odbc_errormsg());

?>

<?php include_once "./template/header.php";?>
<!-- more or less function -->
<script> 

  	function setMore(event_id) { 

  		var moreOrLess = document.getElementById( "moreOrLess" +  event_id );
    	var more = document.getElementById( "more-" + event_id);
    	var less = document.getElementById( "less-" + event_id);

    	moreOrLess.className = "readMore";
    	more.style.display = "none";
    	less.style.display = "inline";
    }

    function setLess(event_id) { 

    	var moreOrLess = document.getElementById( "moreOrLess" +  event_id );
    	var more = document.getElementById( "more-" + event_id);
    	var less = document.getElementById( "less-" + event_id);
    	moreOrLess.className = "readLess";
    	more.style.display = "inline";
    	less.style.display = "none";
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
	<h1>榮譽榜</h1>
	<!-- logout link -->
	 <a href="index.php?logout='1'">Logout</a>
</div>
<div class="container admin-honor-width">
	<div class="title">
		<h2>資料列表</h2>
		<a href="./index.php">返回</a>
		<a href="./admin_honor_add_conf.php" >新增</a>
	</div>
	<?php 
		while($row = odbc_fetch_array($result)) { 
			$event_id = $row['event_id'];
			$dest = $row['dest'];
			$more = "more-".$event_id;
			$less = "less-".$event_id;
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
				<button id="delete" onclick='location.href="./admin_honor_del_conf.php?event_id=<?php echo $event_id;?>"'>刪除</button>
				<button id="modify" onclick='location.href="./admin_honor_mod_conf.php?event_id=<?php echo $event_id;?>"'>修改</button>
			</div>
			<!-- display of time -->
			<div class="time admin-honor-width ">
				<?php echo substr($row['created_at'], 0, 16)?>
			</div>
			<!-- image section -->
			<img id="<?php echo $imgId;?>" src="./img/icons/image_transB.png" onclick="showModal(<?php echo $event_id;?>)">
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