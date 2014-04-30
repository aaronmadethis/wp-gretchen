<?php
	/* ----- Home Template ----- */
	$theme_dir_path = get_stylesheet_directory_uri();
	global $post;
?>

<section id="home-wrapper">
	<section id="home-container">
		<?php
			$image_id = get_field('home_image', $post->ID);
			$image = wp_get_attachment_image_src( $image_id, 'full' );
		?>
		<img src="<?php echo $image[0]; ?>" title="Introduction Image" data-width="<?php echo $image[1]; ?>" data-height="<?php echo $image[2]; ?>">
	</section>
</section>

<div id="stage-wrapper">
	<div id="stage-container">
		<div id="Stage" class="EDGE-1151878"></div>
	</div>
	<div id="enter" class="myhide"><span>CLICK TO ENTER</span></div>
</div>