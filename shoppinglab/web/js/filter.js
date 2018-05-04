
    $(function () {
    $("#searchProduct").autocomplete({
        source: "search.php",
        minLength: 2,
        select: function (event, ui) {
            window.location = "/Mobile.php?id=" + ui.item.value;
        }
    });
    
    
    $('#add').click(function () {
        window.location = "/addProduct.php"
    });
    

    });
    