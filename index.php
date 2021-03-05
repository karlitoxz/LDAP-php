<?php 

if (isset($_POST["username"]) && $_POST["password"]) {
	$ldap_dn= "dominio\\".$_POST["username"];
	echo '<pre>'; print_r($ldap_dn); echo '</pre>';

	$ldap_password = $_POST["password"];

	$ldap_con = ldap_connect("dominio.bogota") or die ("Could not connect to LDAP server.");
	ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
	if ($ldap_con) {
	  if ($ldap_password=="") {
	             echo "LDAP bind failed1...";
	   }    
	   else {  
	         // realizando la autenticación
	         $ldapbind = ldap_bind($ldap_con, $ldap_dn, $ldap_password);
			 //añadir un @ si no queremos ver errores @ $ldapbind = @ldap_bind($lda..
	         // verificación del enlace
	         if ($ldapbind) {
	            echo "LDAP bind successful...".$ldap_dn;
	         } 
	         else {
	             echo "LDAP bind failed...";
	         }
	   }
	}
}else{
	echo "Faltan las credenciales";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login ldap</title>
</head>
<body>
	<form method="POST">
		  <div class="form-group row">
			<label for="username" class="col-4 col-form-label">Usuario</label> 
			<div class="col-8">
			  <input id="username" name="username" type="text" class="form-control">
			</div>
		  </div>
		  <div class="form-group row">
			<label for="password" class="col-4 col-form-label">Contraseña</label> 
			<div class="col-8">
			  <input id="password" name="password" type="text" class="form-control">
			</div>
		  </div> 
		  <div class="form-group row">
			<div class="offset-4 col-8">
			  <button name="submit" type="submit" class="btn btn-primary">Submit</button>
			</div>
		  </div>
	</form>
</body>
</html>