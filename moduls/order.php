<!--$codeProductInfo=$_SESSION['codeProductInfo']=$_POST['code'];-->
<!--$nameProductInfo=$_SESSION['nameProductInfo']=$_POST['name'];-->
<!--$priceProductInfo=$_SESSION['priceProductInfo']=$_POST['price'];-->
<!--$quantityProductInfo=$_SESSION['quantityProductInfo']=$_POST['quantity'];-->
<script>
function termsAccept() {
    var button = document.getElementById('order');
    var terms = document.getElementById('terms');
    if(terms.checked){
        button.disabled = false;    
    }else{
        button.disabled = true;
    }
}
</script>
<div class="row justify-content-center">
    <div class="col-xl-5 col-lg-7 col-md-8 col-sm-10" style="margin-top: 30px; margin-bottom: 30px;">
        <div class="card">
            <div class="card-body">
        <form action="moduls/pdf.php" method="POST">
  <div class="form-row">
      <div class="form-group col-12">
    <label for="inputEmail4"><?php echo $terms['contactEmail']; ?></label>
    <input type="email" name="eMail" class="form-control" id="inputEmail4" placeholder="martin.sidorov@tptlive.ee" required>
  </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputName4"><?php echo $terms['orderName']; ?></label>
      <input type="text" name="userName" class="form-control" id="inputName4" placeholder="Martin" required>
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4"><?php echo $terms['orderFamilyName']; ?></label>
      <input type="text" name="userFamily" class="form-control" id="inputPassword4" placeholder="Sidorov" required>
    </div>
    </div>
  <div class="form-group">
    <label for="inputAddress"><?php echo $terms['contactAdress']; ?></label>
    <input type="text" name="adress" class="form-control" id="inputAddress" placeholder="Pärnu mnt 57" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity"><?php echo $terms['orderCity']; ?></label>
      <input type="text" name="city" class="form-control" id="inputCity" placeholder="Tallinn" required>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState"><?php echo $terms['orderCounty']; ?></label>
      <input type="text" name="uezd" class="form-control" id="inputState" placeholder="Harjumaa" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputZip"><?php echo $terms['orderPostIndex']; ?></label>
      <input type="number" name="postalCode" class="form-control" id="inputZip" placeholder="72627" required>
    </div>
    </div>
  <div class="form-group">
    <div class="form-check">
      <label class="form-check-label">
        <input class="form-check-input" id="terms" onchange="termsAccept()" name="terms" type="checkbox"> <?php echo $terms['orderTermsAccept']; ?>
      </label>
    </div>
  </div>
  <button type="submit" id="order" name="order" class="btn btn-primary" disabled><?php echo $terms['orderProduct']; ?></button>
</form>
    </div>
    </div>
</div>
