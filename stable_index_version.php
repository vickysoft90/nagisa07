<?php

header('Content-Type: text/html; charset=utf-8');
session_start();
include 'common/inc.common.php';

$sql="select * from guest where refid=2";
$guestarr = $Cobj->union($sql);

$_SESSION['useridmap']=$guestarr[0]['refid'];
$_SESSION['c_name']=$guestarr[0]['c_name'];
$_SESSION['seatno']=$guestarr[0]['seatno'];
$_SESSION['roomno']=$guestarr[0]['roomno'];

?>

<!DOCTYPE html>
<html lang="ja-jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#c9ad86">
    <meta name="msapplication-navbutton-color" content="#c9ad86">
    <meta name="apple-mobile-web-app-status-bar-style" content="#c9ad86">
    <link rel="icon" href="images/top-icon.png">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	
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
            alert("ご注文を承りました\n サービスをご利用いただきありがとうございます。");
	        //header('Location: orderhistory.php');
			window.location.href = 'orderhistory.php?ord='+data;
		}
	</script>
    <title>Menu</title>
</head>

<body>
    <div class="shade">
        <div class="name1">
                <p>お名前　　:　 <?php echo $_SESSION['c_name'];?> 様</p>
                <p>お部屋番号: 　<?php echo $_SESSION['roomno'];?>　</p>
                
        </div>
		<div class="blackboard">
                    <a class="button1 btn button1-color" href="orderhistory.php">注文済一覧</a><br>
				<div class="container">

                            <div class="drink-type">
                                <img class="logo" src="images/4564.png" alt="">
                                <h3> <img src="images/drink-menu3.png" alt=""> </h3>
                                    <button id="english1" class="classic up" href="#Menu1" onclick="toggleVisibility('Menu1');"> <img src="images/sake.png" alt=""> <span>日本酒</span></button>
                                    <button id="english2" class="classic" href="#" onclick="toggleVisibility('Menu2');"> <img src="images/beer.png" alt=""> <span>ビール</span></button>
                                    <button id="english3" class="classic" href="#" onclick="toggleVisibility('Menu3');"> <img src="images/whiskey.png" alt=""> <span>ウイスキー</span></button>
                                    <button id="english4" class="classic" href="#" onclick="toggleVisibility('Menu4');"> <img src="images/cocktail.png" alt=""> <span>サワー　。　果実酒</span></button>
                                    <button id="english5" class="classic" href="#" onclick="toggleVisibility('Menu5');"> <img src="images/wine.png" alt=""> <span>ワイン</span></button>
                                    <button id="english6" class="classic" href="#" onclick="toggleVisibility('Menu6');"> <img src="images/destilled-bev.png" alt=""> <span>焼酎</span></button>
                                    <button id="english7" class="classic" href="#" onclick="toggleVisibility('Menu7');"> <img src="images/bottles.png" alt=""> <span>渚亭オリジナルボトル</span></button>
                                    <button id="english8" class="classic down" href="#" onclick="toggleVisibility('Menu8');"> <img src="images/soda.png" alt=""> <span>ソフトドリンク</span></button>
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

                                            <?php $sql = "SELECT * FROM menunagisa07.drinks WHERE category='日本酒' AND stock='可用'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {

                                                if( $row["productimage"] == !null) { 
                                            echo "<p><img class='drinkimage' src='images/" . $row["productimage"] . "'>";
                                            echo " <span class='drink-caption'> " . $row["drinkinfo"] . "</span><br><label><span> " . $row["product"] . "</span><span> ". $row["price"] . "円 </span></label> <input type='submit' value='追加' data-name='".$row["product"]."' data-price='". $row["price"] . "'  class='add-to-cart btn btn-primary'> </p> ";
                                                } else {
                                                    echo "<p><label><span class='drink-caption'> " . $row["drinkinfo"] . "</span><br><span> " . $row["product"] . "</span><span> ". $row["price"] . "円 </span></label> <input type='submit' value='追加' data-name='".$row["product"]."' data-price='". $row["price"] . "'  class='add-to-cart btn btn-primary'> </p> ";
                                                };      
                                                       //check if there a product image and display it
                                                       //if( $row["productimage"] == !null) { 
                                                      //  echo "<img class='drinkimage' src='images/" . $row["productimage"] . "'>";} else {}
                                                        }
                                            } else {
                                            echo "<div class='defaultmessage'>該当結果が見つかりませんでした</div>";
                                            } ?>

<!---exmaple 1-->
<!--<a href= "URLconvert.php?subject=PHP&web=W3schools.com">send</a>-->

<!---exmaple 2-->

<?php
$query_string = 'r=' . base64_encode($_SESSION['c_name'] . ':' . $_SESSION['roomno'] . ':' . $_SESSION['seatno']);
echo '<a id="modal"; href="URLconvert.php?' . $query_string . '">send</a>';
?>
<!---exmaple 3-->

<!---<script> 
document.getElementById("modal").click();
</script>

<?php

//echo base64_decode(strtr($query_string, '-_,', '+/='));

?>

<!--                                        <p>
                                                <label>[北海道]　北の節純米酒(+4) グラス <br><span>700円</span></label>　
                                                
                                                <input type="submit" value="追加" data-name="[北海道]北の節純米酒(+4)グラス" data-price="700" class="add-to-cart btn btn-primary"> 
                                            </p>
                                            <p>
                                                <label>[新潟県]　久保田千寿吟酸(+6) グラス <br><span>700円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="[新潟県]久保田千寿吟酸(+6)グラス" data-price="700" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>[青森県]　豊盃純米吟酒(土0) グラス <br><span>800円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="[青森県]豊盃純米吟酒(土0)グラス" data-price="800" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>熱側　(普通酒)  1合徳利 <br><span>600円</span> </label> 
                                                
                                                <input type="submit" value="追加" data-name="熱側(普通酒)1合徳利" data-price="600" class="add-to-cart btn btn-primary">
                                            </p> -->
                                            
                                            </div>  

                                    <div id="Menu2" style="display: none;">

                                            <?php $sql = "SELECT * FROM menunagisa07.drinks WHERE category='ビール' AND stock='可用'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                            echo "<p><label> " . $row["product"] . "  <br><span> ". $row["price"] . "円 </span></label> <input type='submit' value='追加' data-name='".$row["product"]."' data-price='". $row["price"] . "'  class='add-to-cart btn btn-primary'> </p> ";
                                            }
                                            } else {
                                            echo "0 results";
                                            } ?>


<!--                                            <p>
                                                <label>生ビール　(サッポロクラシック)　<br><span>700円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="生ビール(サッポロクラシック)" data-price="700" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>小沼ビール (アルト)　<br><span>800円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="小沼ビール(アルト)" data-price="800" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>ノンアルコールビール <br><span>500円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="ノンアルコールビール" data-price="500" class="add-to-cart btn btn-primary">
                                            </p>  -->
                                    </div>


                                    <div id="Menu3" style="display: none;">

                                    <?php $sql = "SELECT * FROM menunagisa07.drinks WHERE category='ウイスキー' AND stock='可用'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                            echo "<p><label> " . $row["product"] . "  <br><span> ". $row["price"] . "円 </span></label> <input type='submit' value='追加' data-name='".$row["product"]."' data-price='". $row["price"] . "'  class='add-to-cart btn btn-primary'> </p> ";
                                            }
                                            } else {
                                            echo "0 results";
                                            } ?>



 <!--                                       <p>
                                                <label>ハイボール　<br><span>600円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="ハイボール" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>サントリーオールド(シングル)　<br><span>600円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="サントリーオールド(シングル)" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>サントリーオールド(ダブル)　<br><span>1200円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="サントリーオールド(ダブル)" data-price="1200" class="add-to-cart btn btn-primary">
                                            </p>  -->
                                    </div>



                                    <div id="Menu4" style="display: none;">
                                  　　　　 　<p>
                                                <label>サワー(レモン.グレープフルーツ.巨峰.ウーロン.最茶)<br><span>600円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="サワー(レモン.グレープフルーツ.巨峰.ウーロン.最茶)" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>乳酸菌サワー　<br><span>700円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="乳酸菌サワー" data-price="700" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>梅酒(90ml)　<br><span>600円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="梅酒(90ml)" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                　　</div>
                                    <div id="Menu5" style="display: none;">
                                            <p>
                                                <label>[南フランス]　カンプジイ　グラス(赤.白)　<br><span>700円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="[南フランス]カンプジイグラス(赤.白)" data-price="700" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>[南フランス]　カンプジイ　デキャンタ(赤.白)　<br><span>1200円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="[南フランス]カンプジイデキャンタ(赤.白)" data-price="1200" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>スパークリングワイン　200ｍｌ(白)<br><span>800円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="スパークリングワイン 200ｍｌ(白)" data-price="800" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>スパークリングワイン　750ｍｌ(赤.白)<br><span>3000円</span></label>
                                                
                                                <input type="submit" value="追加" data-name="スパークリングワイン　750ｍｌ(赤.白)" data-price="3000" class="add-to-cart btn btn-primary">
                                            </p>
                                    </div>
                                    <div id="Menu6" style="display: none;">
                                    　　　　　<p>
                                                <label>トライアングル　60ｍｌ<br><span>500円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="トライアングル　60ｍｌ" data-price="500" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>半焼酎喜多里　60ｍｌ<br><span>600円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="半焼酎喜多里　60ｍｌ" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>麦焼酎和ら麦　60ｍｌ<br><span>600円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="麦焼酎和ら麦　60ｍｌ" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                　　</div>
                                    <div id="Menu7" style="display: none;">
                                    　　　　　<p>
                                                <label>渚の雫　(+4)　グラス<br><span>600円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="渚の雫　(+4)　グラス" data-price="600" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>渚の雫　(+4)　ボトル　900ｍｌ<br><span>2500円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="渚の雫　(+4)　ボトル　900ｍｌ" data-price="2500" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>渚の夢　(+10)　グラス<br><span>800円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="渚の夢　(+10)　グラス" data-price="800" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>渚の夢　(+10)　ボトル　900ｍｌ<br><span>3500円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="渚の夢　(+10)　ボトル　900ｍｌ" data-price="3500" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>渚の華　本格焼酎　グラス<br><span>700円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="渚の華　本格焼酎　グラス" data-price="700" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>オリジナルワイン(赤.白)　グラス<br><span>700円</span></label> <br>
                                                
                                                <input type="submit" value="追加" data-name="オリジナルワイン(赤.白)　グラス" data-price="700" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>オリジナルワイン(赤.白)　デキャンタ<br><span>1200円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="オリジナルワイン(赤.白)　デキャンタ" data-price="1200" class="add-to-cart btn btn-primary">
                                            </p>


                                　　</div>
                                    <div id="Menu8" style="display: none;">
                                    　　     <p>
                                                <label>コーラ　<br><span>400円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="コーラ" data-price="400" class="add-to-cart btn btn-primary">
                                            </p>
                                            <p>
                                                <label>サイダー　<br><span>400円</span></label> 
                                                
                                                <input type="submit" value="追加" data-name="サイダー" data-price="400" class="add-to-cart btn btn-primary">
                                            </p>
                                　　</div>
                            </div>
                </div>           
    </div>

    <div class="bottomfooter">
        <span style="color: #bfbfbf;"> ® <script type="text/javascript">
            document.write(new Date().getFullYear());
          </script> Yunokawa Prince Hotel Nagisatei • All Rights Reserved</span>
    </div>
<!--------------------------------------------------------------------------------------------------------------------------------------------------------------->

<script  rel="preconnect"
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>

            <script src="js/main.js"></script>
</body>
</html>