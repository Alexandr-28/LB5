<?php
    require_once 'db.php';
    session_start();
    $publishers=array();
    $years=array();
    $authors=array();
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
      
        $expr2="SELECT `PUBLISHER` FROM `LITERATURE`";
        $expr3="SELECT `YEAR` FROM `LITERATURE`";
        $expr4="SELECT `NAME` FROM `AUTHOR`"; 

        $res2=$pdo->query($expr2);
        $res3=$pdo->query($expr3);
        $res4=$pdo->query($expr4);
        
        while($row=$res2->fetch()){
           array_push($publishers, $row['PUBLISHER']);
        }
        
        while($row=$res3->fetch()){
            array_push($years, $row['YEAR']);
        }

        while($row=$res4->fetch()){
            array_push($authors, $row['NAME']);
        }

        $publishers2=array_unique($publishers);
        $years2=array_unique($years);

    ?>

    <form action="result.php" method="POST">
        <p>
            <label for="publ">Выберите название: </label>
            <select name="publ" id="publ">
            <?php
                for($i=0;$i<count($publishers2);$i++){
                    if($publishers2[$i]==""){continue;}
                    echo "<option value='".$publishers2[$i]."'>".$publishers2[$i]."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <label for="yr">Введите времменой период: </label>
            <span>С</span>
            <select name="yr" id="yr">
            <?php
                sort($years2);
                for($i=0;$i<count($years2);$i++){
                    echo "<option value='".$years2[$i]."'>".$years2[$i]."</option>";
                }
            ?>
            </select>
            <span>&nbsp;По</span>
            <select name="yr2" id="yr2">
            <?php
                rsort($years2);
                for($i=0;$i<count($years2);$i++){
                    echo "<option value='".$years2[$i]."'>".$years2[$i]."</option>";
                }
            ?>
            </select>
        </p>
        <p>
            <label for="auth">Выберите автора: </label>
            <select name="auth" id="auth">
            <?php
                for($i=0;$i<count($authors);$i++){
                    echo "<option value='".$authors[$i]."'>".$authors[$i]."</option>";
                }
            ?>
            </select>
        </p>

        <p>
            <input type="submit" value="Показать результаты">
        </p>
    </form>
</body>
</html>
