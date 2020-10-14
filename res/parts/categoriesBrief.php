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
                let currentContainer = $('<div class="card col-12 col-md-6"></div>');
                let containerBody = '<div class="alert alert-success">'+
                '<strong> <h4>' + category + '</h4> </strong>'+
                ' [' + count + ' artículos]'+
                '<a href="categories.php?category='+ category +'">+Mas</a>'+
                '</div>';
                let categoriesToggler = $(containerBody);
                let categoriesNews = $('<div></div>');
                currentContainer.append(categoriesToggler);
                currentContainer.append(categoriesNews);
                categoriesNews.slideUp();
                categoriesToggler.on("click", ()=>categoriesNews.slideToggle());
                findNews({"category":category}, (news)=>{
                    news.forEach((newsData) =>{
                        categoriesNews.append($('<div><strong>'+
                        newsData["source"] +
                        '</strong> <a href="' +
                        newsData["url"] + 
                        '">'+ newsData["title"] + "</a>" +
                        '</div>'));
                    });
                });
                $("#<?=$container?>").append(currentContainer);
            });
        });
    });
</script>
<div class="container card">
    <div class="row">
        <div class="col-12"><h4>Categorias</h4></div>
        <div id="<?=$container?>" class="col-12">
        
        </div>
    </div>
</div>
