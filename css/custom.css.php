<?php
header( 'Content-type: text/css; charset: UTF-8' ) ;
header( 'Cache-control: must-revalidate' ) ;
?>
@charset "utf-8";
<?php
if( $shrunk_logo_h = get_theme_mod( 'theme_shrunk_logo_height' ) ) { ?>

.fwf-shrink .site-logo img { max-height: <?php echo $shrunk_logo_h; ?>px; }

<?php }

echo hybrid_get_setting('misc_custom_css');

?>
