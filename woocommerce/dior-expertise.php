<div class="expertise-banner">

    <h1 class="expertise-header">DIOR EXPERTISE</h1>

</div>

<div class="expertise-path">

    <?php do_action('woo_custom_breadcrumb');?>

</div>

<div class="category-section fragrance-expertise-image-section">
    <?php 
    $term = get_term_by('slug', 'fragrance-expertise', 'diorexpertisecat'); 
    $banner_image = get_field('image', $term);
    $products = get_field('upsell', $term);
    $productsIdArray = array();

    foreach($products as $product){
        $productsIdArray[] = $product['product'];
    }
    ?>

    <img src="<?php echo $banner_image; ?>" class="cat-expertise-image">
</div>

<div class="dior-expertise-section fragrance-expertise">

    <a id=fragrance></a>

    <h2 class="dior-section-title">FRAGRANCE</h2>

    <div class="dior-expertise-content fragrance-expertise-content">

        <?php
        
        $fragrance_exp_args = array(
            'post_type' => 'dior-expertise',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post__not_in' => array($post_id),
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'diorexpertisecat',
                    'field'    => 'slug',
                    'terms'    => 'fragrance-expertise',
                ),
            ),
        );

        $fragrance_exp_query = new WP_Query($fragrance_exp_args);

        if($fragrance_exp_query->have_posts()){

            $sectionCounter = 1;

            while ($fragrance_exp_query->have_posts() ) : $fragrance_exp_query->the_post(); ?>

                <?php 
                $field = get_fields($post->ID);

                $gallery_images = get_field('dior_images');
                ?>

                <div class="dior-preview-item fragrance-section-<?php echo $sectionCounter; ?>">
                    <?php 
                    $title = get_the_title();
                    $title = str_replace("|", "<br />", $title);
                    ?>

                    <h3 class="preview-title"><?php echo $title; ?></h3>
                    
                    <div class="preview-content">

                        <?php the_content(); ?>

                    </div>

                    <div class="image-gallery">
                        <?php foreach($gallery_images as $g_img){

                            $img_url = wp_get_attachment_image_src($g_img);

                            ?>

                            <img src=<?php echo $g_img;?> class="expertise-image-gallery-item">

                        <?php } ?>
                    </div>

                    <div class="desktop-gallery" style="grid-template-columns:repeat(<?php echo $field['image_columns']; ?>, 1fr);">
                        <?php foreach($gallery_images as $g_img){
                            
                            $img_url = wp_get_attachment_image_src($g_img);

                            ?>

                            <img src=<?php echo $g_img;?> class="expertise-image-gallery-item">

                        <?php } ?>
                    </div>
                
                </div>
                
            <?php
            $sectionCounter++;
            endwhile;

        }
        
        ?>

        <div class="products-list">
            <h3 class="preview-title">The iconic fragrances</h3>

            <ul class="products dior-expertise-products">
                <?php

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'post__in'=> $productsIdArray
                );
                $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) : $loop->the_post();

                            wc_get_template_part( 'content', 'product' );

                        endwhile;
                    } else {
                        return false;
                    }
                ?>
            </ul>
        </div>

    </div>

</div>

<div class="category-section makeup-expertise-image-section">
    <?php 
    $term = get_term_by('slug', 'makeup-expertise', 'diorexpertisecat'); 
    $banner_image = get_field('image', $term);
    $products = get_field('upsell', $term);
    $productsIdArray = array();

    foreach($products as $product){
        $productsIdArray[] = $product['product'];
    }
    ?>

    <img src="<?php echo $banner_image; ?>" class="cat-expertise-image">
</div>

<div class="dior-expertise-section makeup-expertise">
    
    <a id=makeup></a>

    <h2 class="dior-section-title">MAKEUP</h2>

    <div class="dior-expertise-content makeup-expertise-content">
        
        <?php
        
        $makeup_exp_args = array(
            'post_type' => 'dior-expertise',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post__not_in' => array($post_id),
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'diorexpertisecat',
                    'field'    => 'slug',
                    'terms'    => 'makeup-expertise',
                ),
            ),
        );

        $makeup_exp_query = new WP_Query($makeup_exp_args);

        if($makeup_exp_query->have_posts()){

            $sectionCounter = 1;

            while ($makeup_exp_query->have_posts() ) : $makeup_exp_query->the_post();?>
                
            <?php 
            $field = get_fields($post->ID);

            $gallery_images = get_field('dior_images');
            ?>

            <div class="dior-preview-item makeup-section-<?php echo $sectionCounter; ?>">

                <?php 
                $title = get_the_title();
                $title = str_replace("|", "<br />", $title);
                ?>

                <h3 class="preview-title"><?php echo $title; ?></h3>
                
                <div class="preview-content">

                    <?php the_content(); ?>

                </div>
                
                <div class="image-gallery">
                    <?php foreach($gallery_images as $g_img){
                        
                        $img_url = wp_get_attachment_image_src($g_img);

                        ?>

                        <img src=<?php echo $g_img;?> class="expertise-image-gallery-item">

                    <?php } ?>
                </div>

                <div class="desktop-gallery" style="grid-template-columns:repeat(<?php echo $field['image_columns']; ?>, 1fr);">
                    <?php foreach($gallery_images as $g_img){
                        
                        $img_url = wp_get_attachment_image_src($g_img);

                        ?>

                        <img src=<?php echo $g_img;?> class="expertise-image-gallery-item">

                    <?php } ?>
                </div>

            </div>
            
            <?php
            $sectionCounter++;
            endwhile;

        }
        
        ?>

        <div class="products-list">
            <h3 class="preview-title">Make up essentials</h3>

            <ul class="products dior-expertise-products">
                <?php

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'post__in'=> $productsIdArray
                );
                $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) : $loop->the_post();

                            wc_get_template_part( 'content', 'product' );

                        endwhile;
                    } else {
                        return false;
                    }
                ?>
            </ul>
        </div>

    </div>

</div>

<div class="category-section skincare-expertise-image-section">
    <?php 
    $term = get_term_by('slug', 'skincare-expertise', 'diorexpertisecat'); 
    $banner_image = get_field('image', $term);
    $products = get_field('upsell', $term);
    $productsIdArray = array();

    foreach($products as $product){
        $productsIdArray[] = $product['product'];
    }
    ?>

    <img src="<?php echo $banner_image; ?>" class="cat-expertise-image">
</div>

<div class="dior-expertise-section skincare-expertise">
    
    <a id=skincare></a>

    <h2 class="dior-section-title">SKINCARE</h2>

    <div class="dior-expertise-content skincare-expertise-content">
        
        <?php
        
        $skincare_exp_args = array(
            'post_type' => 'dior-expertise',
            'posts_per_page' => 3,
            'post_status' => 'publish',
            'post__not_in' => array($post_id),
            'orderby' => 'date',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'diorexpertisecat',
                    'field'    => 'slug',
                    'terms'    => 'skincare-expertise',
                ),
            ),
        );

        $skincare_exp_query = new WP_Query($skincare_exp_args);

        if($skincare_exp_query->have_posts()){

            $sectionCounter = 1;

            while ($skincare_exp_query->have_posts() ) : $skincare_exp_query->the_post();?>
                
            <?php 
            $field = get_fields($post->ID);

            $gallery_images = get_field('dior_images');
            ?>
            
            <div class="dior-preview-item skincare-section-<?php echo $sectionCounter; ?>">

                <?php 
                $title = get_the_title();
                $title = str_replace("|", "<br />", $title);
                ?>

                <h3 class="preview-title"><?php echo $title; ?></h3>
                
                <div class="preview-content">

                    <?php the_content(); ?>

                </div>

                <div class="image-gallery">
                    <?php  ?>
                    <?php foreach($gallery_images as $g_img){
                        
                        $img_url = wp_get_attachment_image_src($g_img);

                        ?>

                        <img src=<?php echo $g_img;?> class="expertise-image-gallery-item">
                    <?php } ?>
                </div>

                <div class="desktop-gallery" style="grid-template-columns:repeat(<?php echo $field['image_columns']; ?>, 1fr);">
                    <?php foreach($gallery_images as $g_img){
                        
                        $img_url = wp_get_attachment_image_src($g_img);

                        ?>

                        <img src=<?php echo $g_img;?> class="expertise-image-gallery-item">

                    <?php } ?>
                </div>

            </div>
            
            <?php
            $sectionCounter++;
            endwhile;

        }
        
        ?>

        <div class="products-list">
            <h3 class="preview-title">The iconic skincare products</h3>

            <ul class="products dior-expertise-products">
                <?php

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'post__in'=> $productsIdArray
                );
                $loop = new WP_Query( $args );
                    if ( $loop->have_posts() ) {
                        while ( $loop->have_posts() ) : $loop->the_post();

                            wc_get_template_part( 'content', 'product' );

                        endwhile;
                    } else {
                        return false;
                    }
                ?>
            </ul>
        </div>

    </div>

</div>