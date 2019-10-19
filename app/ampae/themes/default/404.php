<?php
global $htmlrender;
$tmpMsg2 = $local->translate('404_error_msg');
    $htmlrender->open();
?>
    <div class="container">
    <div class="well">
    <?php
    echo '<h1 style="text-align:center;">'.$local->translate('404_error').'</h1>';
    echo '<p><center>'.$tmpMsg2.'<center></p>';
    echo '<a href="'.$model->appinfo['url'].'" class="btn btn-welcome btn-lg btn-block">'.$local->translate('continue').'</a>';
    echo '<br /><br /><br />';
    echo '<p><small><a class="align-center" href="./">'.$local->translate('home').' </a>';
    ?>
    </div>
    </div>

<?php
    $htmlrender->close();
