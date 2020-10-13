<?PHP
    $history = (new Session("newsInfo"))->history ?? array();
?>

<?PHP if(count($history) > 0):?>
    <?PHP
        $news = array_reduce($history, function ($a, $b){ return $a.",".$b;}, 0);
        $id = uniqid("recentNews");
    ?>
    <script>
        let setRecent = (data) => {
            $("#<?=$id?>").empty();
            console.log(data);
            data.forEach(d => {
                $("#<?=$id?>").append($(`
                    <li>
                        <a href="read.php?id=${d['id']}">${d['title'] || ''}</a>
                    </li>
                `));
            });
        };
        
        $(document).ready(()=>{
            getNews('<?=$news?>', setRecent);
        });
    </script>
    <div class="card container mt-2">
        <div class="row">
            <div class="col-12">
                <h4> Recientes </h4>
            </div> 
            <div class="col-12">
                <ul id="<?=$id?>">
                    Sin elementos...
                </ul>
            </div>
        </div>
    </div>
<?PHP endif;?>
