<?php
header('Content-Type: text/html; charset=utf-8');

session_start();
include 'common/inc.common.php';
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
    <link rel="icon" href="images/top-icon.png">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Menu</title>
</head>
<body class="history-p"> 
                <div class="h2title">
                <a class="button1 btn button1-color" onclick="goBack()"> <img src="images/back.png" alt=""> 戻る</a> <br><br>
                <h2>注文済一覧</h2>
                </div>
                
        <script>
                function goBack() {
                window.history.back();
                }
        </script>

            <div class="container">    
                        <div id="Menu1">
                    <?php
if(isset($_REQUEST['ord'])){
	$ord=$_REQUEST['ord'];
	$sql = "SELECT * FROM menunagisa07.confirmedorders where or_order_id='$ord' order by or_order_id DESC";
                    
}else{
	$ord=$_SESSION['useridmap'];
	$sql = "SELECT * FROM menunagisa07.confirmedorders where or_userid='$ord' order by or_order_id DESC";
    
}
					                                            $result = $conn->query($sql);
$tot=0;
                                                                if ($result->num_rows > 0) {
                                                                // output data of each row
																
                                                                while($row = $result->fetch_assoc()) {
																	$rate=$row["productprice"]*$row["productquantity"];
																	$tot=$tot+$rate;
                                                                echo "<div class='list4'> " . $row["productname"] . "  <span class='price1'> ". $row["productprice"] . "円 </span><br> <div class='qty'> 量: ". $row["productquantity"] . "<br>  小計: ". $rate . "円 </div> </div> ";
                                                                                                                                   
                                                                //check if there is product image and display it
                                                                        if( $row["productimage"] == !null) { 
                                                                            echo "<img src='images/" . $row["productimage"] . "' alt='image'>";} else {}
                                                                            }
                                                                } else {
                                                                echo "<div class='defaultmessage'>該当結果が見つかりませんでした</div>";
                                                                } ?>
                        </div>
                        <p style="font-size: 25px; margin-top: 30px; color:black; background-color:#c9ad86"> 合計  ¥<span class="total-carts"> <?php  echo number_format($tot) ;?></span> <span style="float: right;">(税別)</span></p>

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