<?PHP
    $id = uniqid("sources");
    $container= $id."Container";
?>
<script>
    $(document).ready(()=>{
        allSources((data)=>{
            $("#<?=$container?>").empty();
            let index = 0;
            data.forEach(sourceData => {
                let source = sourceData['source'];
                let count = sourceData['count'];
                let currentContainer = $(
                    `<div class="card">
                        <div class="card-header">
                            <strong><h4>${source}</h4></strong> [${count} art&iacute;culos]
                            <a href="categories.php?source=${source}">+Mas</a>
                        </div>
                        <div class="card-body">

                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info text-light btn-previous-news">&lt;&lt;</a>
                            <a class="btn btn-info text-light float-right btn-next-news">&gt;&gt;</a>
                        </div>
                    </div>`
                );
                let header = currentContainer.find(".card-header");
                let body = currentContainer.find(".card-body");
                let previous = currentContainer.find(".btn-previous-news");
                let next = currentContainer.find(".btn-next-news");
                body.slideUp();
                header.on("click", ()=>body.slideToggle());
                findNews({"source":source}, (news)=>{
                    body.slideDown();

                    let setCurrentCard = (d)=>{
                        body.fadeOut(()=>{
                            body.html(
                                `<div>
                                    <h6> en &quot;${d['category']}&quot;</h6>
                                    <a target="_blank" href="read.php?id=${d['id']}">${d['title']}</a>
                                </div>`
                            );
                            body.fadeIn();
                        });
                    };



                    let nextCard = () => {
                        news.push(news.shift());
                        setCurrentCard(news[0]);
                    };
                    let previousCard = () => {
                        news.unshift(news.pop());
                        setCurrentCard(news[0]);
                    };
                    next.on('click', nextCard);
                    previous.on('click', previousCard);
                    setCurrentCard(news[0]);
                });
                $("#<?=$container?>").append(currentContainer);
            });
        });
    });
</script>
<div class="container card">
        <div class="card-header"><h4>Fuentes</h4></div>
        <div id="<?=$container?>" class="card-body card-columns">
        
        </div>
</div>
