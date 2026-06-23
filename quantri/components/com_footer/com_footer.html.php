<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); ?>







<div id="footer">



	<p class="copyright">



		



		<a style="font-size:20px;font-family:Arial; color:#3366FF" target="_blank" href="."><strong><br></strong></a>



	</p>



</div>







<?php



    



    if (!empty($_SESSION['msg']))



    {



        ?>



            <script language="javascript">



                jQuery(document).ready(function() {



                    alert('<?php echo $_SESSION['msg']; ?>');



                });



            </script>



        <?php



        $_SESSION['msg'] = '';



    }