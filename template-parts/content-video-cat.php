<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package franks
 */
?>

<div id="post-<?php the_ID(); ?>" class="video-item">

	<?php
		$fields = get_fields();

		if (has_post_thumbnail()):
			$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
	?>


		<div class="video-image-container">
			<img src="<?php echo $url; ?>" alt="<?php echo get_the_title(); ?>" />
		</div>

	<?php endif; ?>

	<a href="<?php echo get_permalink(); ?>" style="text-decoration:none;color:#2f3030;">
		<h2 class="entry-title">
			<?php echo get_the_title(); ?>
		</h2>
	</a>

	<!-- <div class="description">
		<p><?php //echo $fields['description']; ?></p>
	</div> -->
	<!-- .entry-content -->
	
	<?php
		// $temp = parse_url($fields['youtube_video'],PHP_URL_QUERY);
		// parse_str($temp);
		// $vid_id = $v;
		// $embed_code = 'https://www.youtube.com/embed/' . $vid_id . '?autoplay=1&showinfo=0&controls=0&modestbranding=1&rel=0';
	?>

	<!-- <div class="show-video watch-button" data-link="<?php echo $embed_code; ?>">
		<span>Watch</span>
	</div> -->

</div><!-- #post-## -->