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

    <?PHP
        $newsInfo = new Session("newsInfo");
        $history = $newsInfo->history ?? array();
        $id = $_GET["id"];
        while(count($history) > 3){
            $history = array_slice($history, 1);
        }
        if(!in_array($id, $history)){
            array_push($history, $id);
        }
        $newsInfo->history = $history;
        //print_r($history);
    ?>

    <script>

        let secondsToRedirect = 3;
        let closeInterval = undefined;
        $(document).ready(()=>{
            getNews(<?PHP echo $_GET["id"];?>, (d)=>{
                if(d.length > 0){
                    let newsData = d[0];
                    $("#newsSource")
                        .text(newsData["source"] || "...")
                        .attr("href", newsData["baseUrl"] || "#");
                        //.attr("target", "_blank");

                    $("#newsTitle").text(newsData["title"] || "");
                    //$("#newsData").removeClass("hidden");
                    $("#newsData").fadeIn();
                    try{
                        let extraData = JSON.parse(newsData["json_extras"]);
                        let keys = Object.keys(extraData);
                        
                        keys.forEach(k => {
                            try{
                                if((extraData[k] || '').length > 0){
                                    $("#newsExtra").append($(`
                                        <tr>    
                                            <td>${extraData[k]}</td>
                                        </tr>
                                    `));
                                }
                            }catch(err){
                                alert(err);
                            }
                        });
                        //alert(extraData);
                    }catch(err){
                        alert(err);
                    }
                    $("#newsLink").attr("href", newsData["url"] || "#");
                    <?PHP if(isset($_GET["redirect"])):?>
                    let c = setInterval(()=>{
                        if(--secondsToRedirect > 0){
                            $("#redirectInfo").text(
                                `En ${secondsToRedirect} te llevaremos a la noticia...`
                            );
                        }else{
                            clearInterval(c);
                            window.location.replace(newsData["url"] || "#");
                        }
                        }, 1000);
                    <?PHP endif;?>
                }else{
                    alert('not found');
                }
            });
            <?PHP if(isset($_GET["redirect"])):?>
            closeInterval = setTimeout(()=> window.close(), (secondsToRedirect * 2) * 1000);    
            <?PHP endif;?>
        });
    </script>
    <?PHP else:?>
        <div>Sin noticia</div>
    <?PHP endif;?>
    <div id="mainContent">
        <div class="container card p-3" id="newsData">
            <div class="row">
                <div class="col-12">
                    <a class="btn btn-primary btn-danger" id="newsSource" href="#"></a>
                    <h5>
                        <span id="newsTitle"></span>
                    </h5>
                </div>
                <div class="col-12">
                    <table id="newsExtra" class="hidden">

                    </table>
                </div>
                <div class="col-12">
                    <div id="redirectInfo" class="alert-success"></div>
                </div>
                <div class="col-12">
                    <a class="btn btn-primary btn-success" id="newsLink" href="#">Leer ahora</a>
                </div>
            </div>
        </div>
        <div id="moreFromSource">

        </div>
        <div id="relatedNews">

        </div>
    </div>
    <?PHP
        require("./res/parts/recentNews.php");
    ?>
</body>
</html>