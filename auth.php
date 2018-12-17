<?php

require("lib.php");

$id = $_POST["id"];
$pw = $_POST["pw"];

$_chat = new ChatAPI();
$_chat ->auth($id,$pw);
