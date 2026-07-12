<?php

ob_start();

include("../code.php");

$conn = connection();

/* ===========================
   GET CURRENT DATABASE NAME
=========================== */

$db = mysqli_query($conn, "SELECT DATABASE()");
$db = mysqli_fetch_row($db);
$dbname = $db[0];

/* ===========================
   MYSQL LOGIN
=========================== */

$host = "localhost";
$user = "root";
$pass = "";

/* ===========================
   MYSQLDUMP PATH
=========================== */

$mysqldump = "C:\\xampp\\mysql\\bin\\mysqldump.exe";

/* Agar XAMPP kisi aur drive mein hai to path change kar dena */

/* ===========================
   FILE NAME
=========================== */

$filename = $dbname . "_" . date("Y-m-d_H-i-s") . ".sql";

/* ===========================
   DOWNLOAD HEADERS
=========================== */

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

/* ===========================
   COMMAND
=========================== */

$command = "\"$mysqldump\"";

$command .= " --host=$host";
$command .= " --user=$user";

if($pass != "")
{
    $command .= " --password=$pass";
}

$command .= " --databases $dbname";
$command .= " --add-drop-table";
$command .= " --create-options";
$command .= " --extended-insert";
$command .= " --events";
$command .= " --routines";
$command .= " --triggers";
$command .= " --single-transaction";

/* ===========================
   OUTPUT
=========================== */

passthru($command);

exit;