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
    <?PHP if(isset($_GET["id"]) && is_numeric($_GET["id"])):?>
    <script>

        $(document).ready(()=>{
            getNews(<?PHP echo $_GET["id"];?>, (d)=>{
                if(d.length > 0){
                    let fullUrl = `${d[0].baseUrl}${d[0].url}`;
                    window.location.replace(fullUrl);
                }else{
                    alert('not found');
                }
            });
            setTimeout(()=> window.close(), 6000);    
        });
    </script>
    <?PHP
        print($_GET["id"]);    
    ?>
    <?PHP else:?>
        <div>Sin noticia</div>
    <?PHP endif;?>
</body>
</html>