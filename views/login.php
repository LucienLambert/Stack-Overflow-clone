
<section class="desclogin">
    <h1>
        Login to ClassNotFound
    </h1>
    <p>if you want have access at more options, you need to login. if you don't have the account, please sign up before.
    <a href="index.php?action=signup.php"> cliquez ici.</a></p>
    <section div id="contenu">
			<h2>Login from member Zone</h2>
			<div id="notification"><?php echo $notification; ?></div>
			<div class="formulaire">
				<form action="?action=login" method="post">
					<p>Login : <input type="text" name="login" /></p>
					<p>Mot de passe : <input type="password" name="password" /></p>
					<p><input type="submit" name="form_login" value="Log In"></p>
				</form>
			</div>
		</section>

