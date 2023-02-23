$(document).ready(function (){
    
    $("#loginform").submit(function (){
        
        var username=$("#username").val();
        var password=$("#password").val();
        
        
        if((username=="")&&(password==""))
        {
            $("#alertmsg").html("<h6>Username and Password Cannot be Empty!!!</h6>");
            $("#alertmsg").addClass("alert alert-danger");
            return false;
        }
        else
        {
            if(username=="")
            {
                $("#alertmsg").html("<h6>Username Cannot be Empty!!!</h6>");
                $("#alertmsg").addClass("alert alert-danger");
                $("#username").focus();
                return false;
            }   
            if(password==""){
                $("#alertmsg").html("<h6>Password Cannot be Empty!!!</h6>");
                $("#alertmsg").addClass("alert alert-danger");
                $("#password").focus();
               
                return false;
            }
            else{
                return true;
            }
          }
        
    
        
    });
    
    
});

