<header>
    <?PHP
        $url = $_SERVER['SCRIPT_NAME'] == '/index.php' ? "#" : "index.php";
    ?>
    <h3>
       <a href="<?=$url?>"> News <span>Core<span> </a>
    </h3>
</header>
<nav id="siteNav">
</nav>
<script>
    let setCategories = (d) => {
        $("#siteNav").empty();
        d.forEach(c => {
            $("#siteNav").append($(
                `<a href="categories.php?category=${c['category']}">${c["category"]}</a>`
            ));
        });
    };
    $(document).ready(()=>{
        allCategories(setCategories);
    });
</script>