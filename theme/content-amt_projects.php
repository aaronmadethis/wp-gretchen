<?php
	/* ----- Page Template ----- */
	$theme_dir_path = get_stylesheet_directory_uri();
?>

<section id="project-wrapper">
	<section id="project-container">

			<section id="project-template-wrapper" class="">
				<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php $images = get_field('images'); ?>
							<?php if( $images ): ?>

							<article id="lrg-image-container" class="thumb-hidden transition-2">
								
								<a id="left-half" class="transition-2" href="#">
									<div id="left-arrow" class="arrow">
										<!-- Generator: Adobe Illustrator 17.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
										<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 viewBox="0 0 30.009 87.993" enable-background="new 0 0 30.009 87.993" xml:space="preserve">
										<path fill="#939598" d="M28.339,87.993L0,43.996L28.339,0l1.67,1.092L2.374,43.996L30.009,86.9L28.339,87.993z"/>
										</svg>
									</div>
								</a>

								<a id="right-half" class="transition-2" href="#">
									<div id="right-arrow" class="arrow">
										<!-- Generator: Adobe Illustrator 17.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
										<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
											 viewBox="0 0 30.009 87.993" enable-background="new 0 0 30.009 87.993" xml:space="preserve">
										<path fill="#939598" d="M1.67,0l28.339,43.997L1.67,87.993L0,86.901l27.635-42.904L0,1.094L1.67,0z"/>
										</svg>
									</div>
								</a>

								<a id="mobile-next" href="#"></a>

								<ul id="lrg-images">
									<?php $loop_counter = 1; ?>

									<?php foreach( $images as $image ): ?>
										<?php $size = wp_get_attachment_image_src($image['id'], 'full'); ?>
										<li class="myhide">
											<img class="horz" src="<?php echo $image['url']; ?>" data-width="<?php echo $size[1]; ?>" data-height="<?php echo $size[2]; ?>" >
											<div class="caption"><?php echo $image['description']; ?></div>
										</li>
										<?php ++$loop_counter ?>
									<?php endforeach; ?>
								</ul>

							</article>

							<article id="thumb-image-container" class="closed transition-2">
								
								<div id="thumb-btn-show"><a href="#">SHOW THUMBNAILS</a></div>

								<div id="thumb-wrapper" class="closed">
									<ul id="thumb-images">
										<?php $loop_counter = 1; ?>

										<?php foreach( $images as $image ): ?>
											<li class="thumb">
												<a href="">
													<div>
														<span class="transition-2"></span><img class="transition-2" src="<?php echo $image['sizes']['portfolio-thumb']; ?>" >
													</div>
												</a>
											</li>
											<?php ++$loop_counter ?>
										<?php endforeach; ?>
									</ul>
								</div>

								<div id="thumb-btn-controls" class="myinvisible">
									<a class="prev" href="#">PREV</a><span> | </span><a class="myclose" href="#">HIDE THUMBNAILS</a><span> | </span><a class="next" href="#">NEXT</a>
								</div>

							</article>

						<?php endif; /*$images*/ ?>

						<?php endwhile; ?>
					<?php endif; /*have_posts*/ ?>
			</section>

	</section>
</section><!-- end of page-wrapper -->