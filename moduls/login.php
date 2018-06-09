<script>
function validate(){
  var userPass1 = document.forms["myForm"]["inputPassword"].value;

  if(userPass1==""){
    document.getElementById('errorPass1').innerHTML = "Пароль должен быть введен";
    document.getElementById('errorPass1').style.color = "red";
    document.forms["myForm"]["btnSubmit"].disabled = true;
    return false;
  }else{
    document.getElementById('errorPass1').innerHTML = "";
  }
  
  if(userPass1!=""){
      document.forms["myForm"]["btnSubmit"].disabled = false;
  }

}
</script>
<body>
  <div class="container card" style="padding: 30px;">
  <h1><?php echo $terms['login']; ?></h1>
  <form name="myForm" action="<?php echo "?ln=".$ln."";?>" method="post" onsubmit="return validate()">
  <div class="form-group">
    <label for="inputEmail">Email address</label>
    <input type="email" name="userEmail" class="form-control" onchange="return validate();" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
    <p id="errorEmail"></p>
  </div>
  <div class="form-group">
    <label for="inputPassword">Password</label>
    <input type="password" name="userPass1" class="form-control" onchange="return validate();" onkeyup="return validate();" id="inputPassword" placeholder="Password">
    <p id="errorPass1"></p>
  </div>
  <input type="submit" id="btnSubmit" name="userRegister" value="<?php echo $terms['send']; ?>" class="btn btn-primary" onclick="return validate();" onkeyup="return validate();">
</form>
</div>

</body>