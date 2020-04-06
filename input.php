<?php 

$message = '';
$error = '';

if(isset($_POST["submit"])){
    if(empty($_POST["titel"])) {
        $error = "<label class='text-danger'>Kein Titel</label>";
    } 
    else if(empty($_POST["erklaerung"])){
        $error = "<label class='text-danger'>Keine Erklärung</label>";
    }
    else if(empty($_POST["link"])){
        $error = "<label class='text-danger'>Kein Link</label>";
    }
    else if(empty($_POST["befehl"])){
        $error = "<label class='text-danger'>Kein Befehl</label>";
    }
    else if(empty($_POST["imScript"])){
        $error = "<label class='text-danger'>Kein Ja/Nein</label>";
    }
    else if(empty($_POST["tags"])){
        $error = "<label class='text-danger'>Keine Tags</label>";
    }
    else {
        if(file_exists('dba.json')) {
            $current_data = file_get_contents('dba.json');
            $array_data = json_decode($current_data, true);
            $extra = array(
                'titel' => $_POST['titel'],
                'erklaerung' => $_POST['erklaerung'],
                'link' => $_POST['link'],
                'befehl' => $_POST['befehl'],
                'imScript' => $_POST['imScript'],
                'tags' => $_POST['tags']
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data);
            if(file_put_contents('dba.json', $final_data)) 
            {
                $message = "<label class='text-success'>Erfolgreich eingebunden!</label>";
            }
        }
        else {
            $error = "JSON fehlt!";
        }
    }
}

?>


<!doctype html>
<html lang="de">

<head>
<!-- 
  /$$$$$$  /$$           /$$                 /$$          
 /$$__  $$|__/          | $$                | $$          
| $$  \__/ /$$  /$$$$$$ | $$$$$$$   /$$$$$$ | $$  /$$$$$$$
|  $$$$$$ | $$ /$$__  $$| $$__  $$ /$$__  $$| $$ /$$_____/
 \____  $$| $$| $$$$$$$$| $$  \ $$| $$$$$$$$| $$|  $$$$$$ 
 /$$  \ $$| $$| $$_____/| $$  | $$| $$_____/| $$ \____  $$
|  $$$$$$/| $$|  $$$$$$$| $$$$$$$/|  $$$$$$$| $$ /$$$$$$$/
 \______/ |__/ \_______/|_______/  \_______/|__/|_______/
-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Fabian Siebels">
    <link rel="icon" href="">
    
    <title></title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="wdb.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="db.json"></script>
    
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <br>
                <a class="btn btn-block btn-primary" href="index.html">Zurück</a>
                <hr>
                <form method="post">
                    <br>
                    <label>Titel</label>
                    <input type="text" class="form-control" name="titel">
                    <label>Erklärung (br für Zeilenumbruch)</label>
                    <input type="text" class="form-control" name="erklaerung">
                    <label>Link</label>
                    <input type="text" class="form-control" name="link">
                    <label>Befehl</label>
                    <input type="text" class="form-control" name="befehl">
                    <label>Im Script enthalten</label>
                    <input type="text" class="form-control" name="imScript">
                    <label>Such Tags (Mit Komma separieren)</label>
                    <input type="text" class="form-control" name="tags" style="text-transform: lowercase">
                    <hr>
                    <input type="submit" name="submit" class="btn btn-block btn-success">
                    <hr>
                    <?php
                    if(isset($message))
                    {
                        echo $message;
                    }
                    if(isset($error))
                    {
                        echo $error;
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
