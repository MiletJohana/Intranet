<div class="alert alert-danger" role="alert" id="alert-login" style="display: none"></div>
	<div class="caja">
		<form class="form-signin" action="" method="POST">
			<img class="mb-2" src="resources/img/Logo_Master.png" alt="Logotipo Master Quimica S.A" height="80">
				<div class="row mb-2">
					<label for="usuario" class=""><b>Usuario</b></label>
					<input type="text" class="form-control" id="usuario" pattern="[A-Za-z0-9_-]{1,20}" required="" name="usuario"  placeholder="Ingresa tu nombre de usuario">
				</div>
							
				<div class="row">
					<label for="contrasena" class=""><b>Contraseña</b></label>
						<div class="contenedorpass">
							<input type="password" class="form-control" id="contrasena" required="" name="contrasena"> 
							<img src="resources/img/showme.png" alt="Ocultar" onclick="mostrar();" height="40" class="eye" id="oculto" >
						</div>	
				</div> 

				<br>
								
				<button class="btn btn-danger btn-block" onclick="formsubmit();" type="submit">Acceder</button>
				<p><b>Accede con tu cuenta de Google</b></p>
				<a href="<?php echo $auth->getAuthUrl(); ?>" class="btn btn-block btn-dark"><img src="resources/img/google.png" style="width: 7%;"></a>
		</form>
	</div>
</div>
