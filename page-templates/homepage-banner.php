<?php
if (have_rows('banners')): ?>
<div class="home-banner-cont feat-banner-cont franks-main-banner home-banner">
<?php
    while (have_rows('banners')) : the_row();
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $type = get_sub_field('link_type');
        $url = get_sub_field($type);
        $banner_class = ($cnt == 1) ? 'banner-container show' : 'banner-container';
?>
    <div class="<?php echo $banner_class; ?>" data-index="<?php echo $cnt; ?>">
    <?php if ($type !== 'none'): ?>
        <a href="<?php echo $url; ?>">
    <?php endif; ?>
            <img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
    <?php if ($type !== 'none'): ?>
        </a>
    <?php endif; ?>
    </div>
<?php
    endwhile;
?>
</div> 
<?php endif; ?>