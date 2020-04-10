<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
            img {
                width: 1rem;
            }
    </style>
</head>
<?php




include("config.php");
include("connect.php");
include("libery.php");


if (isset($_SESSION['bantime']) && ($_SESSION['bantime'] > time())) {
    echo ($_SESSION['bantime'] - time());
}

if (isset($_SESSION['visit'])) {
    echo "посещений: " . $_SESSION['visit']= $_SESSION['visit']+1 . "<br>";
}else {
    $_SESSION['visit']=1;
    echo "посещений: " . $_SESSION['visit'] . "<br>";
}


$result_count = $mysqli->query('SELECT count(*) FROM `table`'); //считаем количество строк в таблице
$count = $result_count->fetch_array(MYSQLI_NUM)[0];
echo "количество записей: <b>$count</b>";
$result_count->free();

$mysqli = new mysqli('localhost', 'root', '', 'gb');


$result= $mysqli->query('SELECT* FROM `table`');



// $pagecount = ceil($count / $pagesize);

// $currientpage = $_GET['page'] ?? 1;

// $startrow = ($currientpage - 1) * $pagesize;

// $pageination = "<div class='pageination'>\n";

// for ($i = 1; $i <= $pagecount; $i++) {
//     // if ($currientpage == $i) {
//     //     $str = " class='selectedpage'";
//     // } else {
//     //     $str = "";
//     // }
//     $str = ($currientpage == $i) ? " class='selectedpage'" : "";
    
//     $pageination .= "<a href='?page=$i'$str>$i</a>\n";
// }

// $pageination .= "</div>";

// $result = $mysqli->query("SELECT * FROM gb LIMIT $startrow, $pagesize");

// echo $pageination;




echo "<table border='1'>\n";
while ($row = $result->fetch_object()) {
    echo "<tr>";
    echo "<td>" . smile($row->text) . "</td>";
    echo "<td>" . $row->name . "</td>";
    echo "</tr>";
}
echo "</table>\n";
$result->free();
$mysqli->close();
if (!empty($_POST['text']) && !empty($_POST['name'])) {
    $mysqli->query(
        $sql = "INSERT INTO `table` VALUES (NULL, '$_POST[text]', '$_POST[name]')"
    );
        }
    
    //$mysqli->close();

?>

<body>

    <form action="add.php" method="POST">
        <textarea name="text" cols="30" rows="10"></textarea><br>
        <input type="text" name="name"><br>
        <button type="submit">отправить</button>
    </form>


</body>

</html>