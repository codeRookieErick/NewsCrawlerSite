<header>
    Site header
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