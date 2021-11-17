$("#new_edit_user").on("submit",function(){
    if($("#new_edit_user").val() != $("#verify-password").val()) {
        alert("Пароли не совпадают");
        return false;
    }
})