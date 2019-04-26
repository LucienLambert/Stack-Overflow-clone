<h1>You can register you here.</h1>
<section class="desclogin">
    <h2>Sign up to ClassNotFound</h2>
    <p>If you want research and put the question you need register on this site. complet the form</p>
    <section id="contenu">
        <div id="notification"><?php echo $notification; ?></div>
        <div class="form">
            <form action="index.php?action=signup" method="post">
                <p>name : <input type="text" name="name" /></p>
                <p>last name : <input type="text" name="last_name" /></p>
                <p>Email : <input type="email" name="email" /></p>
                <p>password : <input type="password" name="password" /></p>
                <p>confirmed the password : <input type="password" name="cpassword" /></p>
                <p><input type="submit" name="form_add" value="Register"></p>
            </form>
        </div>
    </section>
</section>

