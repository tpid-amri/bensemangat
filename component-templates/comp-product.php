<?php 
    $products = get_field('products');
?>
<div class="section-product">
<div class="subheadline">
        <?php esc_html_e( $products['subtitle'], 'bensemangat' ); ?>
    </div>
    <div class="headline">
        <?php esc_html_e($products['title'], 'bensemangat'); ?>

    </div>
    <div class="caption">
        <?php esc_html_e($products['caption'], 'bensemangat'); ?>
    </div>
    
    <div class="product-list">
        <div class="container">
            <?php if( $products['products'] ): 
            // echo  '<pre>';
            // print_r($products);die();?>
                <div class="row">
                    <?php foreach( $products['products'] as $product ): 
                        $detail = wc_get_product( $product->ID );
                        // echo  '<pre>';
                        //     print_r($detail);die();
                        ?>
                        <div class="col-md-3">
                            <div class="product-box">
                                <div class="product-element-top">
                                    <a href="<?php the_permalink($product->ID); ?>">
                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->ID ), 'single-post-thumbnail' );?>
                                    <?php if($image) : ?>
                                        <img class="img-responsive" src="<?php  echo $image[0]; ?>" data-id="<?php echo $product->ID; ?>">
                                    <?php else: ?>
                                        <img class="img-responsive" src="https://dummyimage.com/263x335" />
                                    <?php endif; ?>
                                    </a>
                                </div>
                                <h3 class="product-title">
                                    <a href="<?php the_permalink($product->ID); ?>"><?php echo get_the_title( $product->ID ); ?></a>
                                </h3>
                                <div class="wrap-price">
                                    <div class="wrapp-swap">
                                        <div class="swap-elements">
                                            <span class="price">
                                                <?php echo $detail->get_price_html();
                                                ?>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>


</div>