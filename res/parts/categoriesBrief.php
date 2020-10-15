<?PHP
    $id = uniqid("sections");
    $container= $id."Container";
?>
<script>
    $(document).ready(()=>{
        allCategories((data)=>{
            $("#<?=$container?>").empty();
            data.forEach(categoryData => {
                let category = categoryData['category'];
                let count = categoryData['count'];
                let currentContainer = $(
                    `<div class="card">
                        <div class="card-header">
                            <strong><h5>${category}</h5></strong> [${count} art&iacute;culos]
                            <a href="categories.php?category=${category}">+Mas</a>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>`
                );
                let header = currentContainer.find(".card-header");
                let body = currentContainer.find(".card-body");
                body.slideUp();
                header.on("click", ()=>body.slideToggle());
                findNews({"category":category}, (news)=>{
                    let index = 0;
                    news.forEach((newsData) =>{
                        let source = newsData["source"];
                        let id = newsData["id"];
                        let title = newsData["title"];
                        let newsBody = $(`
                            <div class="alert alert-info">
                                <strong>${source}</strong><br/>
                                <a target="_blank" href="read.php?id=${id}">
                                    ${title}
                                </a>
                            </div>
                        `);
                        if(++index > 3){
                            newsBody.addClass("d-none");
                        }
                        body.append(newsBody);
                    });
                    if(index > 3){
                        let showAll = $('<button class="btn btn-info col-12 align-center">Mostrar todo</button>');
                        showAll.on("click", ()=>{
                            body.find(".alert").removeClass("d-none");
                            showAll.remove();
                        });
                        body.append(showAll);
                    }
                });
                $("#<?=$container?>").append(currentContainer);
            });
        });
    });
</script>
<div class="container card">
        <div class="card-header"><h4>Categor&iacute;as</h4></div>
        <div id="<?=$container?>" class="card-body card-deck">
        
        </div>
    </div>
</div>
