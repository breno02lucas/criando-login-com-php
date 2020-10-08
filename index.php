<?php 
    include 'header.php'
?>

    <main>
    	<section>
    		<div class="center-content-main">

				<?php
					if (isset($_SESSION['user_id']))
					{
						echo '<p>You are logged in!</p>';
					}

					else{
						echo '<p>You are logged out!</p>';
					}
				?>    			
       			
    		</div>    		
    	</section>        
    </main>


<?php 
    include 'footer.php'
?>

