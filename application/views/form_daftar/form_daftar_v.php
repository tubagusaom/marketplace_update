<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<div class="col-md-12" style="margin-bottom: 5px;" >
	<div class="form-group">
			<div class="row">
				<div class="col-xs-4">
					<label class="control-label labeled-form">FORM PENDAFTARAN</label>
				</div>
			</div>
		</div>
	<form name="myForm" action="<?php echo base_url();?>users/daftar" onsubmit="return validateForm();" method="post">
	<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label class="control-label labeled-form" for="inputUsername">Username</label>
				</div>
				<div class="col-xs-9 tooltip-wide">
					<div class="input-group merged">
					   <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user fa-xs"></i></span>
					   <input type="text" class="form-control" aria-describedby="basic-addon1" name="username" id="username" placeholder="Minimal 6 Digit tanpa spasi">
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-xs-3">
					<label class="control-label labeled-form" for="inputPassword">E-mail</label>
				</div>
				<div class="col-xs-9 tooltip-wide">
					<div class="input-group merged">
					  <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key fa-xs"></i></span>
					  <input placeholder="Email konfirmasi pendaftaran"  type="email" class="form-control" name="email" id="email" >
					</div>
				</div>
			</div>
		</div>
		
<div class="modal-footer">
		<button type="button" class="btn btn-primary" id="btn-daftar">Daftar</button>
	  </div>
	  </form>
</div>
<script>
function validateForm() {
    var x = document.forms["myForm"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
        return false;
    }
}
$(document).ready(function(){
	$('#btn-daftar').click(function(){
		$.ajax({
			  type:"post",
			  url:"<?php echo base_url('users/daftar');?>",
			  data:{
				  username : $('#username').val(),
				  email : $('#email').val()
			  },
			  dataType: 'json',
			  success:
			  function(response){
				  alert(response['results'][0]['message']);
			  },
			  error:
				function(){
					alert("Ajax Error. ");
				}
		  });
	});
});
</script>
