<?php 
$images = get_field('slider');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
// echo '<pre>';
// print_r($images);die();
if( $images ): ?>
<!-- Slider main container -->
<div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
    <?php foreach( $images as $image_id ): ?>
        <!-- Slides -->
        <div class="swiper-slide" style="background: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('<?php echo $image_id['url']; ?>');">
            <div class="box-content-slider">
                <div class="title"><?php echo $image_id['title']; ?></div>
                <div class="description"><?php echo $image_id['description']; ?></div>
                <div class="caption"><?php echo $image_id['caption']; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>

    <!-- If we need scrollbar -->
    <div class="swiper-scrollbar"></div>
</div>
<?php endif; ?>
