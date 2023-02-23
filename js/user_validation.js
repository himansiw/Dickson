$(document).ready(function (){
    
    $("#user_role").change(function(){
        var url="../controller/usercontroller.php?status=getfunctions";
       
        var x= $("#user_role").val();
     $.post(url,{role_id:x},function(data){
            $("#myfunctions").html(data).show();
        });
    });
    
   $("#addUser").submit(function (){
   //Assigning values from input boxes to variables
        var fname=$("#fname").val();
        var lname=$("#lname").val();
        var user_email=$("#user_email").val();
        var dob=$("#dob").val();
        var nic=$("#nic").val();
        var ucno1=$("#ucno1").val();
        var ucno2=$("#ucno2").val();
        var user_role=$("#user_role").val();
        var user_img =$("#user_img").val();
    //Validate the first name
      if(fname=="")
      {
          $("#alertDiv").html("First Name Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#fname").focus();
          return false;
      }
       //Check the first name accept only letters
       var alphaFir = /^[a-zA-Z]+$/;
       if(!fname.match(alphaFir))
       {
           $("#alertDiv").html("First Name is Invalid");
           $("#alertDiv").addClass("alert alert-danger");
           $("#alertDiv").show();
           setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
           $("#fname").focus();
           return false;
       }
       //Validate the Last name
      if(lname=="")
      {
          $("#alertDiv").html("Last Name Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#lname").focus();
          return false;
      }

       //Check the last name accept only letters
       var alphaLast = /^[a-zA-Z]+$/;
       if(!lname.match(alphaLast))
       {
           $("#alertDiv").html("Last Name is Invalid");
           $("#alertDiv").addClass("alert alert-danger");
           $("#alertDiv").show();
           setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
           $("#lname").focus();
           return false;
       }
      if(user_email=="")
      {
          $("#alertDiv").html("Email Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#user_email").focus();
          return false;
      }
      if(dob=="")
      {
          $("#alertDiv").html("Date of Birth Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#dob").focus();
          return false;
      }
      if(nic=="")
      {
          $("#alertDiv").html("NIC Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
          $("#nic").focus();
          return false;
      }
       if(ucno1=="")
       {
           $("#alertDiv").html("Contact Number 1(Land) Cannot be Empty!!!");
           $("#alertDiv").addClass("alert alert-danger");
           $("#alertDiv").show();
           setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
           $("#ucno1").focus();
           return false;
       }
       if(ucno2=="")
       {
           $("#alertDiv").html("Contact Number 2(Mobile) Cannot be Empty!!!");
           $("#alertDiv").addClass("alert alert-danger");
           $("#alertDiv").show();
           setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
           $("#ucno2").focus();
           return false;
       }
      if(user_role=="")
      {
          $("#alertDiv").html("User Role Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
          $("#user_role").focus();
          return false;
      }

    //Validation match the email pattern
       var patemail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
       if(!user_email.match(patemail))
       {
           $("#alertDiv").html("Email is Invalid");
           $("#alertDiv").addClass("alert alert-danger");
           $("#alertDiv").show();
           setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
           $("#user_email").focus();
           return false;
       }
   //Validation match the old and new nic pattern
       var patnic=/^([0-9]{9}[vVxX]|[0-9]{12})$/;
      if(!nic.match(patnic))
      {
          $("#alertDiv").html("NIC is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#nic").focus();
          return false;
      }
   //Validation match the land phone number pattern
       var patcno=/^\+94[0-9]{9}$/;
       if(!ucno1.match(patcno))
      {
          $("#alertDiv").html("Contact Number 1(Land) is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#ucno1").focus();
          return false;
      }
   //Validation match the mobile phone number pattern
       var patmob=/^\+947[0-9]{8}$/;
       if(!ucno2.match(patmob))
      {
          $("#alertDiv").html("Contact Number 2(Mobile) is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
          $("#ucno2").focus();
          return false;
      }
   //Check the user role empty or not
      var selectCount=0;
      $(".chkbx").each(function(index){
          
          if($(this).is(":checked"))
          {
             selectCount++; 
          }
      });
      if(selectCount==0)
      {
          $("#alertDiv").html("At Least One Of The Function Should be Selected!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          return false; 
      }
       //Check the user image jpg/jpeg/png or not
       var user_img =$("#user_img").val();
       var idxDot = user_img.lastIndexOf(".") + 1;
       var extFile = user_img.substr(idxDot, user_img.length).toLowerCase();
       if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
           //TO do
       }else{
           $("#alertDiv").html("Only jpg/jpeg and png files are allowed!!!");
           $("#alertDiv").addClass("alert alert-danger");
           $("#alertDiv").show();
           setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
           $("#user_img").focus();
           return false;
       }
   });
   
    $("#editUser").submit(function (){
        var fname=$("#fname").val();
        var lname=$("#lname").val();
        var user_email=$("#user_email").val();
        var dob=$("#dob").val();
        var nic=$("#nic").val();
        var cno1=$("#cno1").val();
        var cno2=$("#cno2").val();
        var user_role=$("#user_role").val();
        var user_img =$("#user_img").val();
      if(fname=="")
      {
          $("#alertDiv").html("First Name Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#fname").focus();
          return false;
      }
      if(lname=="")
      {
          $("#alertDiv").html("Last Name Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#lname").focus();
          return false;
      }
      if(user_email=="")
      {
          $("#alertDiv").html("Email Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#user_email").focus();
          return false;
      }
      if(dob=="")
      {
          $("#alertDiv").html("Date of Birth Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#dob").focus();
          return false;
      }
      if(nic=="")
      {
          $("#alertDiv").html("NIC Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#nic").focus();
          return false;
      }
      if(user_role=="")
      {
          $("#alertDiv").html("User Role Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#user_role").focus();
          return false;
      }
       if(cno1=="")
      {
          $("#alertDiv").html("Contact Number 1(Land) Cannot be Empty!!!");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#cno1").focus();
          return false;
      }
        //Check the first name accept only letters
        var alphaFir = /^[a-zA-Z]+$/;
        if(!fname.match(alphaFir))
        {
            $("#alertDiv").html("First Name is Invalid");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#fname").focus();
            return false;
        }
        //Check the last name accept only letters
        var alphaLast = /^[a-zA-Z]+$/;
        if(!fname.match(alphaLast))
        {
            $("#alertDiv").html("Last Name is Invalid");
            $("#alertDiv").addClass("alert alert-danger");
            $("#alertDiv").show();
            setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
            $("#lname").focus();
            return false;
        }
    //Validation match the email pattern
    var patemail=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z]{2,6})+$/;
      if(!user_email.match(patemail))
      {
        $("#alertDiv").html("Email is Invalid");
        $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
        $("#user_email").focus();
        return false;

      }
    //Validation match the old and new nic pattern
      var patnic=/^([0-9]{9}[vVxX]|[0-9]{12})$/;
      if(!nic.match(patnic))
      {
          $("#alertDiv").html("NIC is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 5000);
          $("#nic").focus();
          return false;
      }
    //Validation match the land phone number pattern
      var patcno=/^\+94[0-9]{9}$/;
       if(!cno1.match(patcno))
      {
          $("#alertDiv").html("Contact Number 1(Land) is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#cno1").focus();
          return false;
      }
    //Validation match the mobile phone number pattern
      var patmob=/^\+947[0-9]{8}$/;
       if((cno2!="")&&(!cno2.match(patmob)))
      {
          $("#alertDiv").html("Contact Number 2(Mobile) is Invalid");
          $("#alertDiv").addClass("alert alert-danger");
          $("#alertDiv").show();
          setTimeout(function () {$("#alertDiv").slideUp(500, function () {$("#alertDiv").hide();});}, 8000);
          $("#cno2").focus();
          return false;
      }
   });
});
