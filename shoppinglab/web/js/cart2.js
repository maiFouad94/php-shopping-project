
$(function () {
$('.addCart').click(function () {
    this.innerHTML='added';
    this.disabled=true;
    var prodID=$(this).attr('id');
    $.ajax({
	url: '/addcart.php',
	type: 'post',
        data:{text: prodID},
	success: function (response) {
            console.log("mn l ajax");
            console.log(response);
            console.log(JSON.parse(response));
              
            }
   

        });
    


});

$('.removeCart').click(function () {

    $(this).parent().remove();
    var prodID=$(this).attr('id');
    var prodPrice=$(this).attr('price');
    $.ajax({
	url: '/removefromcart.php',
	type: 'post',
        data:{text: prodID,
        price: prodPrice},
	success: function (response) { 
            //if (response.success == true) {
            //console.log(response);
            $('#tot').text("Total="+JSON.parse(response)+"L.E");
            //}
   
   }
        });
    


});

    $('.deleted').click(function () {
         var prodID=$(this).attr('id');
        $(this).parent().remove();
        $.ajax({
	url: '/deleteItem.php',
	type: 'post',
        data:{text: prodID },
	success: function (response) {
           
            //if (response.success == true) {
            //console.log(response);
            //}
   
   }
        });
       
    });
    
    $('.comment').click(function () {
        var prodID=$(this).attr('id');
        $.ajax({
            url: '/addComment.php',
            type: 'post',
            data: {text: $('#addComment').val(),
            prodID: prodID},
            success: function (response) {
                console.log(response);
                if (response.success == true) {
                    var text = $('#addComment').val();
                    $('#comments').prepend('<div class="tweet"><h3>' + response.username + '</h3><h5>' + response.text + '</h5><h6>' + response.date + '</h6></<div>')
                }
            }
        });
    });
    $('.rating').click(function(){
        var rate=$("input[type='checkbox']:checked").val();
        var prodID=$(this).attr('id');
         $.ajax({
            url: '/Rate.php',
            type: 'post',
            data: {rate: rate,
            prodID: prodID},
            success: function (response) {
                console.log(response.rate);
                if (response.success == true) {
                    $('#rateDiv').text(response.rate);
                                }
            }
        });
        
        
        
        
    })

});
//}