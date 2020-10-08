<?php

header('Content-Type: text/html; charset=utf-8');

session_start();
include 'common/inc.common.php';

$_request['qrcode'];
		$sql="select * from guest where refid=1";
	$guestarr = $Cobj->union($sql);

$_SESSION['useridmap']=$guestarr[0]['refid'];
$_SESSION['c_name']=$guestarr[0]['c_name'];
$_SESSION['seatno']=$guestarr[0]['seatno'];
$_SESSION['roomno']=$guestarr[0]['roomno'];

?>

<?php
	$sql="select distinct category from drinks";
	$colarr = $Cobj->union($sql);
	//print_r($colarr);
?>

<!DOCTYPE html>
<html lang="ja-jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#c9ad86">
    <meta name="msapplication-navbutton-color" content="#c9ad86">
    <meta name="apple-mobile-web-app-status-bar-style" content="#c9ad86">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <script src="script.js"></script>
     

<script type='text/javascript'>
         $(document).ready(function() {
		
			 
            //option A
            $("#cartform").submit(function(e){
               // alert('submit intercepted');
			   //loader($.param(args));

			   var ver="";
                e.preventDefault(e);
							$('#loading').show();
							//var datastring = $("#cartform").serialize();
                            //alert(datastring);
                            //var nam=$("input[name='prd_name']").val();

                                    //alert(nam);
$.ajax({
				url: "addorderInfo.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,  
				success: handleResult
			
				/* url: "../masters/addStudentInfo.php",
				type: "POST",
				data: $('form#add_studentform').serialize(),
				dataType: "json",
				success: handleResult */
			});

				
            });
        });
		
		function handleResult(data){
			
			$( "#clearcart" ).click();
           alert("Order placed");
	 //header('Location: orderhistory.php');
	 
			window.location.href = 'orderhistory.php?ord='+data;

        }
        
		function setAlbum(album) {  
        $('.right_nav').each(function() {
             if ( $(this).id != album )
                   $(this).hide();
      });
      $('#' + album).show();
		}
		
	 function callmenu(ev=''){
   	//var van_no=$("#van").val();
	//alert(ev);
   $.ajax({
type: "POST",
url: "fetch_pro.php",
data: "mnu="+ev,
cache: false,
//beforeSend: function () {
//$('#output1').html('<img src="loader.gif" alt="" width="24" height="24">');
//},
success: function(html) {   
//alert(html); 
$("#Menu1").html( html );
   // $("#Menu1").append(html);
	  //  $('button').live('click',buttonClickEvent);


}
});
}
	
function callcart(id) {
 event.preventDefault();
  var name = $("#"+id).data('name');
 var price = Number($("#"+id).data('price'));
  shoppingCart.addItemToCart(name, price, 1);
  displayCart();
}

</script>



    <title>Menu</title>
</head>

<body>
    <div class="shade">
        <div class="name1">
		<!--<input type="button" name="scan" value="scanQR" onclick="scanqr()">-->
        <p>お名前　　:　 <?php echo $_SESSION['c_name'];?> 様</p>
        <p>お部屋番号: 　<?php echo $_SESSION['roomno'];?>　</p>
        </div>
		<div class="blackboard">
                    <a class="button1 btn button1-color" href="orderhistory.php">注文済一覧</a><br>
				<div class="container">

                            <div class="drink-type">
                                <img class="logo" src="images/4564.png" alt="">
                                <h3> <img src="images/drink-menu3.png" alt=""> </h3>
								
								<?php
									$s=0;
								for($t=0;$t<sizeof($colarr);$t++){
									$s=$s+1;
								?>
								
                                    <button id="english<?php echo $s;?>" class="classic" value="<?php echo $colarr[$t]['category'];?>" href="#Menu<?php echo $s;?>" onclick="callmenu('<?php echo $colarr[$t]['category'];?>');"> <!--<img src="images/<?php echo $drinkicon ?>" alt="">--> <span><?php echo $colarr[$t]['category'];?></span></button>
									
									<?php
								}
									?>
									
                            </div>
							
                </div>    
        </div>
        <!--------------------------cart------------------------>
         <div class="container">       
                <div class=" list cart-drinks">    

                    <button class="order-buttons" >カート (<span class="total-count"></span>) <img src="images/shopping-cart.png" alt=""> </button>
                    <button class="clear-cart btn btn-danger order-buttons" id="clearcart">すべて削除 <img src="images/trash-black.png" alt=""> </button>

            <form action="" method="GET" name="cartform" id="cartform">

                    <div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                        <div class="modal-header">
                                            <h3>選ばれたドリンク</h3>
                                            
                                        </div>
                                        <div class="modal-body">
                                                    <table class="show-cart table"> </table>
                                                    <div style="font-size: 25px; margin-top: 30px;">合計 ￥ <span class="total-cart"></span></div>
                                        </div>
                                        <div class="send-order">
                                            <button type="submit" onclick="myFunctionPro()" value="注文する" class="order-buttons checkout-btn">注文する </button>
                                            <div id="demo">
                                         
                                            </div>
                                        </div>
                                </div>
                        </div>
                    </div> 
							</form>

                </div>
        </div>
		
        <!------------------------------------------------------->
               <div class="container">
                           <div class="list smooth-scroll">
                                            <div id="Menu1">

                                            </div>  

                                  
                            </div>
                </div>           
    </div>

    <div class="bottomfooter">
        <span style="color: #c9ad86;"> ® <script type="text/javascript">
            document.write(new Date().getFullYear());
          </script> Niseko Prince Hotel Nagisatei • All Rights Reserved</span>
    </div>
<!------------------------------------------------------------------------------------------------------------------------------

<script  rel="preconnect"
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>--------------------------------->


            <script src="js/main.js"></script>
			
</body>
</html>