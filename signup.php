<?php 
    include 'header.php'
?>

    <main>
    	<section>
    		<div class="center-content-main">
    			<h1>SIGN-UP</h1>

    			<form action="includes/signup.inc.php" method="post" class="form-signup">
    				<input type="text" name="user_username" placeholder="Username...">
    				<input type="email" name="user_email" placeholder="E-mail...">
    				<input type="password" name="user_pass" placeholder="Password...">
    				<input type="password" name="re_pass" placeholder="Repeat Password...">
    				<button type="submit" name="signup-submit">Sign-Up</button>
    			</form>
    		</div>    		
    	</section>        
    </main>


<?php 
    include 'footer.php'
?>

