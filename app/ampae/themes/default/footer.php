  </main>


	<footer role="contentinfo" aria-label="footer contentinfo">
    <nav id="footerNav" role="navigation" aria-label="footer navigation">
    </nav>
    <section role="copyright">
		    <p>Copyright</p>
    </section>
	</footer>




<?php

//	echo '<script type="text/javascript" src="'.$model->appinfo['url'].DIRECTORY_SEPARATOR.DIR_LIBS.'/jquery/jquery-ui.min.js"></script>';

//    echo '<script type="text/javascript" src="'.$model->appinfo['url'].DIR_LIBS.'/jquery/jquery.form.min.js"></script>';
    echo '<script type="text/javascript" src="'.$model->appinfo['url'].DIR_LIBS.'/jquery/jquery.validate.min.js"></script>';

/*
if ($auth->is()){
    echo '<script type="text/javascript" src="'.$model->appinfo['theme_url'].'assets/js/modal-confirm.js"></script>';
}
*/

$view->renderScripts('FOOT'); //dash

?>

    </body>
</html>
