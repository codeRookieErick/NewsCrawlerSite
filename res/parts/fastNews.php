<?PHP

?>
<div class="container card">
    <div class="row">
            <div class="col-12">
                <a 
                    class="btn btn-success w-100 h-100"
                    href="#" 
                    id="fastNewsSource<?=$id?>">
                    Fuente
                </a>
            </div>
            <div class="col-12 text-center" id="fastNews<?=$id?>">
                <h5>
                    <a id="fastNewsTitle<?=$id?>" href="#">Noticias:</a>
                </h5>
            </div>
            
            <div class="col-12">
                <label
                    class="btn btn-success w-100 h-100"
                    href="#" 
                    id="fastNewsElapsed<?=$id?>">
                    Fuente
                </label>
            </div>
    </div>
</div>

<script>

    let getTimeElapsed = (epoch) => {
        let result = (Date.now() / 1000) - epoch;
        let intervalos = [
            {nombre:"segundo", divisor:60},
            {nombre:"minuto", divisor:60},
            {nombre:"hora", divisor:24},
            {nombre:"dia", divisor:365.25},
            {nombre:"anio", divisor:1000}
        ];
        let index = 0;
        while(index < intervalos.length-1 && result > intervalos[index].divisor){
            result /= intervalos[index++].divisor;
        }
        result = parseInt(result);
        let nombre = intervalos[index].nombre;
        if(result != 1) nombre += 's';
        return `${result} ${nombre}`; 
    };

    let resetNews = () =>{
        allNews(6, setFastNews);
    };
    let setCurrentNews = (data) => {
        $("#fastNews<?=$id?>").slideUp(()=>{
            let elapsed = getTimeElapsed(data["epoch_time"]);
            let alertInfo = `${data["title"]} ${elapsed}`;
            let id = data["id"] || "";
            $("#fastNewsElapsed<?=$id?>").text(elapsed);
            $("#fastNewsTitle<?=$id?>").text(data["title"]);
            $("#fastNewsTitle<?=$id?>").attr("href", `read.php?id=${id}`);
            $("#fastNewsTitle<?=$id?>").attr("target", `_blank`);
            $("#fastNews<?=$id?>").slideDown();
        });

        $("#fastNewsSource<?=$id?>").text(data["source"]);

    };    
    let setFastNews = (data) => {
        //console.log(data);
        let index = 0;
        let i = 0;
        let swapFastNews = () =>{
            if(++index > 100){
                setTimeout(resetNews, 1000);
                clearInterval(i);
            }else{
                let currentData = data[index%data.length];
                setCurrentNews(currentData);
            }
        }
        i = setInterval(swapFastNews, 5000);
        swapFastNews();
    };  


    $(document).ready(()=>{
        resetNews();
    });

</script>
