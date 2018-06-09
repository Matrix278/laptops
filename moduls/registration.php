<script>
function validate(){
  var userPass1 = document.forms["myForm"]["inputPassword"].value;
  var userPass2 = document.forms["myForm"]["inputRePassword"].value;

  if(userPass2!==userPass1){
    document.getElementById('errorPass2').innerHTML = "Passwords do not match";
    document.getElementById('errorPass2').style.color = "red";
    document.forms["myForm"]["btnSubmit"].disabled = true;
    return false;
  }else{
    document.getElementById('errorPass2').innerHTML = "";
  }

  if(userPass1==""){
    document.getElementById('errorPass1').innerHTML = "Password must be entered";
    document.getElementById('errorPass1').style.color = "red";
    document.forms["myForm"]["btnSubmit"].disabled = true;
    return false;
  }else{
    document.getElementById('errorPass1').innerHTML = "";
  }

  if(userPass2==""){
    document.getElementById('errorPass2').innerHTML = "Repeat password must be entered";
    document.getElementById('errorPass2').style.color = "red";
    document.forms["myForm"]["btnSubmit"].disabled = true;
    return false;
  }else{
    document.getElementById('errorPass2').innerHTML = "";
  }

  if (document.forms["myForm"]["checkTerms"].checked == true){
    document.forms["myForm"]["btnSubmit"].disabled = false;
  }else{
    document.forms["myForm"]["btnSubmit"].disabled = true;
  }

}
</script>
<body>
  <div class="container card" style="padding: 30px;">
  <h1><?php echo $terms['registerNewAccount']; ?></h1>
  <form name="myForm" action="<?php echo "?ln=".$ln."&page=mailUser";?>" method="post" onsubmit="return validate()">
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" name="userEmail" class="form-control" onchange="return validate();" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
    <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
    <p id="errorEmail"></p>
  </div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" name="userPass1" class="form-control" onchange="return validate();" onkeyup="return validate();" id="inputPassword" placeholder="Password">
    <p id="errorPass1"></p>
  </div>
  <div class="form-group">
    <label for="inputRePassword">Re-Password</label>
    <input type="password" name="userPass2" class="form-control" onchange="return validate();" onkeyup="return validate();" id="inputRePassword" placeholder="Re-Password">
    <p id="errorPass2"></p>
  </div>
  <div class="form-group form-check">
    <input type="checkbox" name="terms" class="form-check-input" onchange="return validate();" id="checkTerms">
    <label class="form-check-label" for="checkTerms"><?php echo $terms['orderTermsAccept']; ?></label>
  </div>
  <input type="submit" id="btnSubmit" name="userRegister" value="<?php echo $terms['send']; ?>" class="btn btn-primary" onclick="return validate();" onkeyup="return validate();" disabled="true">
</form>
</div>

</body>
