<div class="form-container">
	<form action="index.php?c=Profile&m=handleLogin" id="login_form" method="POST" class="forms" method="POST">
		<fieldset>
			<?php if(isset($params["error"])){ echo '<p class="text-danger">'.$error.'</p>'; } ?>
			<ul>
				<li class="form-row text-input-row"><input type="text" name="login" pattern="^[a-zA-Z0-9-_.]{3,}$" class="text-input required" title=""  id="login" required="required" placeholder="Pseudo" autofocus=""/>
					<?php if(isset($errors) && isset($errors['login'])){ ?> <p class="text-danger"><?php echo $errors['login'] ?></p>	 <?php } ?>
				</li> 
				<li class="form-row text-input-row"><input type="password" name="password" pattern="^[a-zA-Z0-9-_.]{3,}$" class="text-input required" title=""  id="password" required="required" placeholder="Mot de passe" autofocus=""/>
					<?php if(isset($errors) && isset($errors['password'])){ ?> <p class="text-danger"><?php echo $errors['password'] ?></p>	 <?php } ?>
				</li> 
				<li class="button-row"><input type="submit" value="Connexion" name="submit" class="btn-submit" /></li>
			</ul>
		</fieldset>
	</form>
</div>