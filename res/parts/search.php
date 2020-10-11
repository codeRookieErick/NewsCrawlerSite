<?PHP
    $id = uniqid();
?>
<div id="search">
    <div class="col-12">
        <input 
            type="text" 
            id="searchText<?=$id?>" 
            name="searchText<?=$id?>"
        />
        <button
            id="searchButton<?=$id?>" 
        >
            Buscar
        </button>
    </div>
    <div
        id="searchResults<?=$id?>"
        class="col-12"
    >
    </div>
</div>

<script>

    let search<?=$id?> = ()=>{
        let token = $("#searchText<?=$id?>").val();
        getNewsByToken(token, (results)=>{
            $("#searchResults<?=$id?>").empty();
            if(results.length > 0){
                results.forEach(result => {
                    let resultId = result["id"] || "#";
                    let resultTitle = result["title"] || "";
                    let resultSource = result["source"] || "";
                    let resultBaseUrl = result["baseUrl"] || "";
                    $("#searchResults<?=$id?>").append($(`
                        <div> 
                            <a class="text-danger" href="${resultBaseUrl}">
                                <strong> ${resultSource} : </strong>
                            </a> 
                            <a target="_blank" href="read.php?id=${resultId}">
                                ${resultTitle}
                            </a>
                        </div>
                    `));
                });
            }else{
                $("#searchResults<?=$id?>").text("No hay resultados...");
            }
        });
    };

    
    $("#searchButton<?=$id?>").on("click", search<?=$id?>);
    
    $("#searchText<?=$id?>").on("keypress", (k) => {
        if(k.keyCode == 13){
            search<?=$id?>();
        }
    });
</script>