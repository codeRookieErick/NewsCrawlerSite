<?PHP
    $id = uniqid();
?>
<div class="card container p-3" id="search<?=$id?>">
    <div class="row">
        <div class="col-12 col-md-10">
            <input 
                class="w-100"
                type="text" 
                id="searchText<?=$id?>" 
                name="searchText<?=$id?>"
            />
        </div>
        <div class="col-12 col-md-2">
            <button
                class="btn btn-info w-100"
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
                        <div class="p-1"> 
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