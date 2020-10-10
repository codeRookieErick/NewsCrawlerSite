<!DOCTYPE html>
<html lang="en">
<head>
    <?PHP
        require("./res/parts/head.php");
    ?>
    <title>Document</title>
</head>
<body>
    <?PHP require("./res/parts/header.php");?>
    <?PHP if(isset($_GET["category"])):?>
    <?PHP else:?>
        <div>Sin categoria</div>
    <?PHP endif;?>
</body>
</html>