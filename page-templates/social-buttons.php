<?php 
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<div class="social-container wishlist">

    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $actual_link; ?>" target="_blank">

        <?php include(dirname(__FILE__).'/../images/facebook.svg');?>

    </a>
    
    <a href="https://twitter.com/intent/tweet?text=My Franks Wishlist&url=<?php echo $actual_link; ?>" target="_blank">

        <?php include(dirname(__FILE__).'/../images/twitter.svg');?>

    </a>

    <a href="mailto:?subject=Franks: News&body=Coffee Cupping session! : <?php echo $actual_link; ?>" target="_blank">

        <?php include(dirname(__FILE__).'/../images/mail-to.svg');?>

    </a>

    <a href="https://plus.google.com/share?url=<?php echo $actual_link; ?>" target="_blank">

        <?php include(dirname(__FILE__).'/../images/google-plus.svg');?>

    </a>

    <a href="https://pinterest.com/pin/create/button/?url=<?php echo $actual_link; ?>" target="_blank">

        <?php include(dirname(__FILE__).'/../images/pinterest.svg');?>

    </a>

</div>