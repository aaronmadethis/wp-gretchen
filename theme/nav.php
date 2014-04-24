<?php
	global $post;
	/* ----- Navigation Template ----- */
	$theme_dir_path = get_stylesheet_directory_uri();
?>

<section id="nav-wrapper">
	<div id="nav-container" class="clearfix">
		
		<div id="logo" >
			<a href="<?php echo home_url(); ?>" alt="Gretchen Smelter Portfolio Home Link">
				<img src="<?php echo $theme_dir_path; ?>/images/logo.png" alt="Gretchen Smelter Logo">
			</a>
		</div>
		
		<nav>
			<?php wp_nav_menu( array( 'theme_location' => 'main', 'depth' => 2, 'container' => false ) ); ?>
		</nav>

		<?php if( get_post_type( $post->ID ) == 'amt_projects') : ?>
			<div id="page-title"><?php echo $post->post_title; ?></div>
		<?php endif; /*is_home*/ ?>

	</div>
</section>