<?php
session_start();
include 'common/inc.common.php';
$mnu=$_REQUEST['mnu'];

											$sql = "SELECT * FROM menunagisa07.drinks WHERE category='$mnu' ";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                        
                                                            if( $row["productimage"] == !null) { 
                                                                echo "<p><label><span> " . $row["product"] . "</span><span> ". $row["price"] . "円 </span></label> ";
                                                                echo "<img class='drinkimage' src='images/" . $row["productimage"] . "'>";
                                                                echo "<span class='drink-caption'> " . $row["drinkinfo"] . "</span><br><input type='submit' value='追加' data-name='".$row["product"]."' data-price='". $row["price"]  . "' data-prdid='". $row["CD2"] . "'  class='add-to-cart btn btn-primary' id='".$row["CD2"]."' onclick='callcart(this.id)'> </p> ";
                                                            } else {
                                                                echo "<p><label><span> " . $row["product"] . "</span><span> ". $row["price"] . "円 </span></label><br><span class='drink-caption'> " . $row["drinkinfo"] . "</span><br><input type='submit' value='追加' data-name='".$row["product"]."' data-price='". $row["price"]  . "' data-prdid='". $row["CD2"] . "'  class='add-to-cart btn btn-primary' id='".$row["CD2"]."' onclick='callcart(this.id)'> </p> ";
                                                            };      
                                                                    }
                                                } else {
                                                echo "<div class='defaultmessage'>該当結果が見つかりませんでした</div>";
                                                } ?>
                                            


