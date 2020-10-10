<div id="fast-news">
    <h4>
    <a id="fast-news-title" href="#">Noticias:</a>
    </h4>
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
        $("#fast-news").fadeOut(()=>{
            let elapsed = `[consultado hace ${getTimeElapsed(data["epoch_time"])}]`;
            let alertInfo = `${data["source"]}: ${data["title"]} ${elapsed}`;
            $("#fast-news-title").text(alertInfo);
            $("#fast-news-title").attr("href", data["baseUrl"] + (data["url"] || ""));
            $("#fast-news").fadeIn();
        });

    };    
    let setFastNews = (data) => {
        console.log(data);
        let index = 0;
        let i = 0;
        let swapFastNews = () =>{
            if(++index > 10){
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
