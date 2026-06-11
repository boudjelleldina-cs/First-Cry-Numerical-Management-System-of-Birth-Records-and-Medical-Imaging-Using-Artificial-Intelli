<?php

use function PHPSTORM_META\type;

@include 'connection.php';
session_start();
/*$id = $_SESSION["login_id"];
$out_date_str = date('Y-m-d H:i:s');

$res = mysqli_query($link, "SELECT * FROM manager_in_org WHERE id_manager = '$id' && state_in = 'في الخدمة'") or die(mysqli_error($link));
        $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
        foreach ($data as $row) { 	
			
			$new_date= strtotime($row['date_in']) - strtotime($out_date_str);
			$new_date= number_format(abs($new_date /3600), 3, '.', ' ');
			//number_format((($total_questionnaire / $max )*100), 2, ',', ' ')  ;
			$id_journal = $row['id_journal'];
			//$updateType_abn = "UPDATE manager_in_org SET `duree`= '$new_date' WHERE `id_journal` = '1'";
			$updateType_abn = "UPDATE manager_in_org SET `duree`= '$new_date', `date_out`= '$out_date_str', `state_in`= 'خارج الخدمة' WHERE `id_journal` = '$id_journal' ";
			//SELECT SUM(quantity) AS sum_quantity FROM product;
			//$response = mysqli_query($link, $request) or die(mysqli_error($link));
			$response1 = mysqli_query($link, $updateType_abn) or die(mysqli_error($link));
			
           
        }
*/

/*echo $out_date_str;
$out_date = new DateTime($out_date_str);
try {
    $qry = mysqli_query($link, "SELECT in_date from manager WHERE id='$id'");
    $row = mysqli_fetch_array($qry);
    echo "<br>";
    $in_date = strtotime($row["in_date"]);
    $in_date_str = date('Y-m-d H:i:s', $in_date);
    echo $in_date_str;
    echo "<br>";
    $in_date = new DateTime($in_date_str);
    //$in_date = $in_date->format("Y-m-d H:i:s");
} catch (\Throwable $th) {
    throw $th;
}
try {
    $interval = $in_date->diff($out_date)->format('%Y-%m-%d %H:%i:%s');
    echo $interval;
    //$interval = new DateTime($interval);
    mysqli_query($link, "UPDATE manager set out_date = '$out_date_str'") or die(mysqli_error($link));
    mysqli_query($link,"INSERT INTO access_manager (in_date, out_date, difference, manager_id) VALUES ('$in_date_str', '$out_date_str', '$interval', '$id')") or die(mysqli_error($link));
}catch (Exception $e){
    throw $e;
}*/
 session_unset();
session_destroy();

header('location:login.php');

?>