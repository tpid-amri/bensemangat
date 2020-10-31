<?php 
    $featured = get_field('featured');
?>
<div class="section-featured">
    <div class="subheadline">
        <?php esc_html_e( $featured['subtitle'], 'bensemangat' ); ?>
    </div>
    <div class="headline">
        <?php esc_html_e($featured['title'], 'bensemangat'); ?>
    </div>
    <div class="caption">
        <?php esc_html_e($featured['caption'], 'bensemangat'); ?>
    </div>

    <div class="featured-list">
        <div class="container">
            <?php if( $featured['featured'] ): ?>
                <div class="row">
                    <?php foreach( $featured['featured'] as $term ):  ?>
                        <div class="col-md-4">
                            <div class="featured-box">
                                <?php 
                                    $thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                                    $image = wp_get_attachment_url( $thumbnail_id );
                                    if ( $image ) {
                                        echo '<img class="img-responsive" src="' . $image . '" alt="' . $term->name . '" />';
                                        // echo wp_get_attachment_image( $term->term_id, 'medium' );
                                    } else {
                                        echo '<img class="img-responsive" src="https://dummyimage.com/950x480" />';
                                    }
                                ?>
                                <div class="hover-mask">
                                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="category-link-overlay"></a>
                                    <h3> <?php echo esc_html( $term->name ); ?></h3>
                                    <a href="<?php echo esc_url( get_term_link( $term ) ); ?>">View products</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>


</div>