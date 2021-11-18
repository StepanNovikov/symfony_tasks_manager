$("#new_edit_user").on("submit",function(){
    if($("#new_edit_user").val() != $("#verify-password").val()) {
        alert("Password mismatch");
        return false;
    }
})

//confirm user role in admin panel
$(".confirm").click(function(){
    let id = $(this).attr("id");
    let href = window.location.href
    let checked = $(this).prop('checked');
    $.ajax({
        url: href + 'confirm/' + id,
        method: 'post',
        dataType: 'json',
        data: {"id": id,'checked':checked},
        success: function(data){
            if(data.status==="true") {
                $("h5").after("<div class=\"message-confirm alert alert-success col-4\" role=\"alert\">\n" +
                    "                Role " + data.fullname + " was confirmed\n" +
                    "            </div>");
            } else {
                $("h5").after("<div class=\"message-confirm alert alert-danger col-4\" role=\"alert\">\n" +
                    "                Role " + data.fullname  + " wasn`t confirmed\n" +
                    "            </div>");
            }
            setTimeout(function() {
                $(".message-confirm").fadeOut(1000).empty();
            }, 3000);
        }
    });

})