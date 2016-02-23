<?php
session_start();
require_once("shopdb.php");
$db_handle = new Shopdb();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM item_detail WHERE item_desc='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["item_desc"]=>array('item_name'=>$productByCode[0]["item_name"], 'item_desc'=>$productByCode[0]["item_desc"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["item_desc"],$_SESSION["cart_item"])) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["item_desc"] == $k)
								$_SESSION["cart_item"][$k]["quantity"] = $_POST["quantity"];
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>
<HTML>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./image/Group_icon.png">
	<link href="./css/style.css" type="text/css" rel="stylesheet" />
    <title>TeamMember Linker</title>
	
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/navbar.css" rel="stylesheet">

    <script src="./css/ie-emulation-modes-warning.js"></script>
	<style>
      body {
        margin: 0;
        background-color: azure;
        background-image: url("./image/shop.jpg");
        background-position: right;
		background-repeat: no-repeat;
        background-attachment: fixed;
      }
     </style>
  </head>
<BODY>
	
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./dashboard.php">TeamMember Linker</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="./dashboard.php">Home</a></li>
            <li><a href="./messageboard.php">Message</a></li>
            <li><a href="./album.php">Album</a></li>
            <li class="active"><a href="./shopping.php">Shopping</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./userphoto.php"><?php echo $_COOKIE["haslogin"] ?></a></li>
            <li><a href="./pdo_logout.php">Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>

	<div id="product-grid">
		<br><br>
		<?php
		$product_array = $db_handle->runQuery("SELECT * FROM item_detail ORDER BY item_id ASC");
		if (!empty($product_array)) { 
			foreach($product_array as $key=>$value){
		?>
			<div  class="product-item" align="center">
				<form method="post" action="shopping.php?action=add&code=<?php echo $product_array[$key]["item_desc"]; ?>">
				<div class="product-image" align="center"><img src="<?php echo $product_array[$key]["item_url"]; ?>" width="100"></div>
				<div><strong><?php echo $product_array[$key]["item_name"]; ?></strong></div>
				<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
				<div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to cart" /></div>
				</form>
			</div>
		<?php
				}
		}
		?>
	</div>

	<div id="shopping-cart">

		<?php
		if(isset($_SESSION["cart_item"])){
			$item_total = 0;
		?>	
		<table cellpadding="10" cellspacing="1">
		<tbody>
				<tr>
					<th><strong>Name</strong></th>
					<th><strong>Quantity</strong></th>
					<th><strong>Price</strong></th>
					<th><strong>Action</strong></th>
					<th><a id="btnEmpty" href="shopping.php?action=empty">Empty Cart</a></th>
				</tr>	
			
		<?php		
				foreach ($_SESSION["cart_item"] as $item){
					?>
							<tr>
							<td><strong><?php echo $item["item_name"]; ?></strong></td>
							<td><?php echo $item["quantity"]; ?></td>
							<td align=left><?php echo "$".$item["price"]; ?></td>
							<td><a href="shopping.php?action=remove&code=<?php echo $item["item_desc"]; ?>" class="btnRemoveAction">Remove Item</a></td>
							</tr>
							<?php
					$item_total += ($item["price"]*$item["quantity"]);
					}
					?>
			
				<tr>
					<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?>
						<form target="paypal" name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_xclick">
							<input type="hidden" name="business" value="pass@bu.edu">
							<input type="hidden" name="currency_code" value="USD">
							<input type="hidden" name="item_name" value="Total Order Prices">
							<input type="hidden" name="amount" value=<?php echo "$".$item_total; ?>>
							<input type="image" src="./image/btn_buynow.gif" border="0" name="submit" alt="">
						</form>
					</td>
				</tr>
		
		</tbody>
		</table>		
		<?php } ?>
	</div>

</BODY>
</HTML>