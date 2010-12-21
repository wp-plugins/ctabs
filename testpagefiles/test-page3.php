<?php
/**
 * Template Name: Test Page Template Three
 *
 * 
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 */

 /***Functions Go Here ***************************/
function ctabs_addcss() {
?>
<link href="<?php bloginfo( 'stylesheet_directory' ) ?>/testpagefiles/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ) ?>/testpagefiles/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ) ?>/testpagefiles/jquery-ui-personalized-1.5.2.packed.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ) ?>/testpagefiles/sprinkle.js"></script>
<?php ;	
}
add_action ( 'wp_head', 'ctabs_addcss' );
 
 
 /***********************************************/
 
get_header(); ?>
		<div id="container" class="one-column">
			<div id="content" role="main">
				<div id="post-test">
					<h1 class="entry-title">Test Page</h1>
					<div class="entry-content" style="min-height:500px;">
<!-- Start Jquery Tabs -->
    <div id="tabvanilla" class="widget">

    <ul class="tabnav">
    <li><a href="#popular">Popular</a></li>
    <li><a href="#recent">Recent</a></li>
    <li><a href="#featured">Featured</a></li>
    </ul>

    <div id="popular" class="tabdiv">
    <ul>
    <li><a href="#">Welsh Zombie Sheep Invasion</a></li>
    <li><a href="#">Sheep Rising From The Dead</a></li>
    <li><a href="#">Blogosphere Daily Released!</a></li>
    <li><a href="#">Aliens Infiltrate Army Base In UK Town</a></li>
    <li><a href="#">U2 Rocks New York's Central Park</a></li>
    <li><a href="#">TA Soldiers Wear Uniforms To Work</a></li>
    <li><a href="#">13 People Rescued From Flat Fire</a></li>
    <li><a href="#">US Troops Abandon Afghan Outpost</a></li>
    <li><a href="#">Are We Alone? A Look Into Space</a></li>
    <li><a href="#">Apple iPhone 3G Released</a></li>
    </ul>
    </div><!--/popular-->

    <div id="recent" class="tabdiv">
    <p>Lorem ipsum dolor sit amet.</p>
    </div><!--/recent-->

    <div id="featured" class="tabdiv">
    <ul>
    <li><a href="#">Aliens Infiltrate Army Base In UK Town</a></li>
    <li><a href="#">Are We Alone? A Look Into Space</a></li>
    <li><a href="#">U2 Rocks New York's Central Park</a></li>
    <li><a href="#">TA Soldiers Wear Uniforms To Work</a></li>
    <li><a href="#">13 People Rescued From Flat Fire</a></li>
    <li><a href="#">US Troops Abandon Afghan Outpost</a></li>
    <li><a href="#">Sheep Rising From The Dead</a></li>
    <li><a href="#">Blogosphere Daily Released!</a></li>
    <li><a href="#">Apple iPhone 3G Released</a></li>
    <li><a href="#">Welsh Zombie Sheep Invasion</a></li>
    </ul>
    </div><!--featured-->

    </div><!--/widget-->
<!-- End Jqyery Tabs -->
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
			</div><!-- #content -->
		</div><!-- #container -->
<?php get_footer(); ?>
