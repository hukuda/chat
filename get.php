<?php

require("lib.php");

if(array_key_exists("name",$_GET))
{
$name = $_GET["name"];
}else{
$name = null;
}



$result = [];



//-------------------------------------------------

//準備

//-------------------------------------------------
$value = [];
// 実行したいSQL
if($name === null)
{
$sql = 'SELECT * FROM log';
}else{
$sql = "SELECT * FROM log WHERE name=?";
$value[]=$name;
}



//-------------------------------------------------

//SQLを実行

//-------------------------------------------------

$dbh = connectDB();   //接続

$sth = $dbh->prepare($sql);         //SQL準備

$sth->execute($value);                    //実行



//取得した内容を表示する

while(true){

    //ここで1レコード取得

    $buff = $sth->fetch(PDO::FETCH_ASSOC);

    if( $buff === false ){

        break;    //データがもう存在しない場合はループを抜ける

    }

    

    $result[] = [

    	  "name"    => $buff["name"]

		, "message" => $buff["message"]

		, "time"    => $buff["time"]

	];

}



echo json_encode($result);
