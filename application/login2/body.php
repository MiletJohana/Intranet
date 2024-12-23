
			<div class="container-left">
				<form class="" action="" method="POST">
					<img class="mb-2" src="resources/img/mqblanco.png" alt="Logotipo Master Quimica S.A" height="80">
						<p class="text-danger" id="info-login"></p>
						<div class="container-input">
							<input type="text" class="input" id="usuario" pattern="[A-Za-z0-9_-]{1,20}" required="" name="usuario"  placeholder="Usuario">
							<i class="fa-solid fa-user"></i>
						</div>
									
						<div class="container-input">
							<input type="password" class="input" id="contrasena" required="" name="contrasena" placeholder="Contraseña">
							<i class="fa-solid fa-eye-slash" onclick="contra();" id="oculto" ></i>
							<!--<img src="resources/img/showme.png" alt="Ocultar"  height="40" class="eye" id="oculto" >-->
							
						</div> 

						<br>
										
						<button class="btn btn-secondary" onclick="formsubmit();" type="button" style="width:300px">Acceder</button>

						<p class="text-google"><b>Accede con su cuenta de Google</b></p>
						<a href="<?php echo $auth->getAuthUrl(); ?>" class="btn btn-google btn-light"><img src="resources/img/google.png" style="width: 13%;"></a>
				</form>
			</div>
		
			<div class="container-right">
				<img src="resources/img/logo1.png" alt="">
			</div>
			
			
		

