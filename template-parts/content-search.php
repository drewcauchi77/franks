<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package franks
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></h2>

        <?php
            switch (get_post_type()) {
                case 'post':
                    echo "<span class='post-category'>News & Promotions</span>";
                break;
                case 'events':
                    echo "<span class='post-category'>Events</span>";
                break;
                case 'brands':
                    echo "<span class='post-category'>Brands</span>";
                break;
                case 'heritage':
                    echo "<span class='post-category'>Heritage</span>";
                break;
                case 'video':
                    echo "<span class='post-category'>Video</span>";
                break;
                case 'tips':
                    echo "<span class='post-category'>Tips & Tricks</span>";
                break;
                case 'top':
                    echo "<span class='post-category'>Top</span>";
                break;
                default:
                    echo get_post_type();
            }
        ?>
    </header><!-- .entry-header -->

    <div class="entry-summary">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>">Read More</a>
    </div><!-- .entry-summary -->

</article><!-- #post-## -->