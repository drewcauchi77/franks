<?php
/**
 * The main template file
 * 
 * Template Name: Main Events Template	
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package franks
 */

get_header();
?>

	<main>

		<?php 
		$customLink = '/';
		$customMessage = 'Go back to <b>Home</b>';
		
		include 'back-to-home.php'; ?>

		<?php 
		$title = 'The art of living beautiful';
		include('title-divider.php'); ?>
	
		<div class="events-container">
			<div class="upcoming-events section-container">

				<div class="event-title">
					<h3>Upcoming Events</h3>
				</div>

				<div class="events-wrapper upcoming-events">
				<?php
				
				/* 	Array initialised for upcoming events
					Post type events for the WB Events by the slug events
					Show all upcoming published events underneath each other
					In ascending order according to their starting date 
					denoted by category which is being set from the WB Events
					'upcoming' irrespective of Gentlemen's Essentials*/

				$upcom_args = array(
					'post_type' => 'events',
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'post__not_in' => array($post_id),
					'meta_key' => 'wine_boutique_event_starting_date',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					// 'tax_query' => array(
					// 	array(
					// 		'taxonomy' => 'eventscat',
					// 		'field'    => 'slug',
					// 		'terms'    => 'upcoming',
					// 	),
					// ),
				);

				//Denoting a new WP_Query to loop within all posts obeying the above
				//args within array to obtain information from posts

				$upcom_query = new WP_Query($upcom_args);

				//Checking for posts within the above args set

				if($upcom_query->have_posts()){

					//Looping the post with a Wordpress loop
					while ($upcom_query->have_posts() ) : $upcom_query->the_post();
					
					$this_field = get_fields($post->ID);
					//var_dump($field);

					$date_from_value = $this_field['wine_boutique_event_starting_date'];
					$date_to_value = $this_field['wine_boutique_event_ending_date'];

					$integer_date_from = strtotime($date_from_value);
					$integer_date_to = strtotime($date_to_value);
					$today_date = strtotime(date("Y-m-d"));

					?>

					<!-- Getting the permalink of the current post which is being shown and
					enabling it around the whole div for clickable options -->
					
					<?php if($integer_date_from >= $today_date || $integer_date_to >= $today_date){ ?>

						<a class="related-link" href=<?php echo get_permalink(); ?>>

							<div class="event-box">

							<?php
							//Obtain the post featured image which will be the background image
							//spanning whole width and height, obtained from the post itself

							if(has_post_thumbnail()){
								$img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
							?>
							<!-- Showing the image -->

								<img class="event-featured-img" src=<?php echo $img_url;?>>

							<?php
							}
							?>

							<div class="event-info">
							
							<!-- Obtaining the title of the event name by the_title and enclosing
							within h1 tags for styling -->

							<?php the_title('<h1 class="event-name">', '</h1>'); ?>
							<?php 

							//Get all custom fields for specific event denoting by post ID

							$field = get_fields($post->ID);

							//Obtain the starting date for each event from ACF

							$date_from = $field['wine_boutique_event_starting_date'];
							$date_to = $field['wine_boutique_event_ending_date'];

							//Separation of the day from the month for styling

							$event_day = date('j', strtotime($date_from));
							$event_month = date('F', strtotime($date_from));

							$event_day_end = date('j', strtotime($date_to));
							$event_month_end = date('F', strtotime($date_to));

							//Obtaining the first three letters of the month January -> Jan

							$event_month = substr($event_month, 0, 3);
							$event_month_end = substr($event_month_end, 0, 3);

							//Conjunction of strings to denote date

							if($date_to == ""){
								echo '<h2 class="event-date">' . $event_day . " " . $event_month . '</h2>';
							}else{
								echo '<h2 class="event-date">' . $event_day . " " . $event_month . " - ". $event_day_end . " " . $event_month_end .'</h2>';
							}
							
							?>

							</div>

							</div>

							</a>

						<?php } ?>
					
					<?php
					
					endwhile;
				}

				?>
				</div>

			</div>
			<div class="past-events section-container">

				<div class="event-title">
					<h3>Past Events</h3>
				</div>

				<div class="events-wrapper past-events">
				<?php
				
				/* 	Array initialised for past events
					Post type events for the WB Events by the slug events
					Show up to 3 past published events underneath each other
					In ascending order according to their starting date 
					denoted by category which is being set from the WB Events
					'past' irrespective of Gentlemen's Essentials*/

					$past_args = array(
						'post_type' => 'events',
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'post__not_in' => array($post_id),
						'meta_key' => 'wine_boutique_event_starting_date',
						'orderby' => 'meta_value',
						'order' => 'DESC',
						// 'tax_query' => array(
						// 	array(
						// 		'taxonomy' => 'eventscat',
						// 		'field'    => 'slug',
						// 		'terms'    => 'past',
						// 	),
						// ),
					);

				//Denoting a new WP_Query to loop within all posts obeying the above
				//args within array to obtain information from posts

				$past_query = new WP_Query($past_args);
				$post_counter = 0;

				//Checking for posts within the above args set

				if($past_query->have_posts()){

					//Looping the post with a Wordpress loop

					while ($past_query->have_posts() ) : $past_query->the_post();
					
					$this_field = get_fields($post->ID);
					//var_dump($field);

					$date_from_value = $this_field['wine_boutique_event_starting_date'];
					$date_to_value = $this_field['wine_boutique_event_ending_date'];

					$integer_date_from = strtotime($date_from_value);
					// var_dump($integer_date_from);
					// echo '<br>';
					$integer_date_to = strtotime($date_to_value);
					// var_dump($integer_date_to);
					// echo '<br>';
					$today_date = strtotime(date("Y-m-d"));
					// var_dump($today_date);
					// echo '<br>';
					// echo '<br>';

					?>

					<?php if($integer_date_from < $today_date && $integer_date_to < $today_date && $post_counter < 3){ ?>

					<!-- Getting the permalink of the current post which is being shown and
					enabling it around the whole div for clickable options -->

					<a class="related-link" href=<?php echo get_permalink(); ?>>

					<div class="event-box">

					<?php

					//Obtain the post featured image which will be the background image
					//spanning whole width and height, obtained from the post itself


					if(has_post_thumbnail()){
						$img_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
					?>
					<!-- Showing the image -->


						<img class="event-featured-img" src=<?php echo $img_url;?>>

					<?php
					}
					?>

					<div class="event-info">

					<!-- Obtaining the title of the event name by the_title and enclosing
					within h1 tags for styling -->

						<?php the_title('<h1 class="event-name">', '</h1>'); ?>
						<?php 

						//Get all custom fields for specific event denoting by post ID

						$field = get_fields($post->ID);
						
						//Obtain the starting date for each event from ACF
						
						$date_from = $field['wine_boutique_event_starting_date'];
						
						//Separation of the day from the month for styling

						$event_day = date('j', strtotime($date_from));
						$event_month = date('F', strtotime($date_from));
						
						//Obtaining the first three letters of the month January -> Jan
						
						$event_month = substr($event_month, 0, 3);

						//Conjunction of strings to denote date

						echo '<h2 class="event-date">' . $event_day . " " . $event_month . '</h2>';

						$post_counter++;

						?>

					</div>

					</div>
					
					</a>

				<?php } ?>
				
					<?php
					
					endwhile;
				}else{
					
				}
				
				?>

				</div>

			</div>
		</div>
	</main>

<?php
get_footer();
