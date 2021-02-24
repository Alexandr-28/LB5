<?php
    require_once 'db.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
        $t1=$_POST['yr'];
        $t2=$_POST['yr2'];
        $publ=$_POST['publ'];
        $author=$_POST['auth'];

        $expr1="SELECT `NAME`, `ISBN`, `PUBLISHER`, `YEAR`, `NUMBER` FROM `LITERATURE` WHERE `PUBLISHER`=:publ";
        $expr2="SELECT b.NAME, b.YEAR, a.IMG FROM `RESOURSE` a JOIN `LITERATURE` b ON a.Id=b.FID_RES WHERE b.YEAR BETWEEN :t1 AND :t2";
        $expr3="SELECT a.NAME FROM `LITERATURE` a JOIN `BOOK_AUTHRS` b ON a.Id=b.FID_BOOK JOIN `AUTHOR` c ON b.FID_AUTH=c.Id WHERE c.NAME=:author";

        $res1=$pdo->prepare($expr1);
        $res2=$pdo->prepare($expr2);
        $res3=$pdo->prepare($expr3);

        $res1->execute(['publ'=>$publ]);
        $res2->execute(['t1'=>$t1, 't2'=>$t2]);
        $res3->execute(['author'=>$author]);
    ?>



    <table>
        <tr>
            <th>Name</th>
            <th>ISBN</th>
            <th>Publisher</th>
            <th>Year</th>
            <th>Count</th>
        </tr>
        <?php
            while($row=$res1->fetch()){
                echo "<tr>";
                echo "<td>".$row['NAME']."</td>";
                echo "<td>".$row['ISBN']."</td>";
                echo "<td>".$row['PUBLISHER']."</td>";
                echo "<td>".$row['YEAR']."</td>";
                echo "<td>".$row['NUMBER']."</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <?php echo "<br><br><br>"?>

    <table>
        <tr>
            <th>Name</th>
            <th>Year</th>
            <th>Img</th>
        </tr>

        <?php
            while($row=$res2->fetch()){
                echo "<tr>";
                echo "<td>".$row['NAME']."</td>";
                echo "<td>".$row['YEAR']."</td>";
                echo '<td>' .'<img src = "data:image/png;base64,'.base64_encode($row['IMG']) .'"heigth = "1575px" width="100px" />'.'</td>';
                echo "</tr>";
            }
        ?>
    </table>
    <br><br>
    <p id="pr">Author:<?php echo $author;?></p>
    <table>
        <tr>
            <th>Name</th>
        </tr>

        <?php
            while($row=$res3->fetch()){
                echo "<tr>";
                echo "<td>".$row['NAME']."</td>";
                echo "</tr>";
            }
        ?>
    </table>

    <a href="index.php">Назад</a>
</body>
</html>