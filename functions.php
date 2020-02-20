<?php

/**
 * Incubator functions file
 *
 * @package incubator
 * by KeyDesign
 */

 require_once( get_template_directory() . '/core/init.php');

 // -------------------------------------
 // Edit below this line
 // -------------------------------------

 /*SP_Portfolio*/
function addScriptsForPortfolio(){
    //wp_enqueue_style("fancybox-style",get_template_directory_uri()."/core/assets/css/fancybox.css");
    wp_enqueue_style("portfolio-style",get_template_directory_uri()."/core/assets/css/portfolio-style.css");
    //wp_enqueue_style("aportfolio-style","https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
    wp_enqueue_style("cportfolio-style",get_template_directory_uri()."/core/assets/css/jquery.fancybox.css");
    wp_enqueue_script( 'jquery.fancybox.min', get_template_directory_uri() . '/core/assets/js/jquery.fancybox.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'isotope.pkgd.min', get_template_directory_uri() . '/core/assets/js/isotope.pkgd.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'asp-portfolio','https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'sp-portfolio', get_template_directory_uri() . '/core/assets/js/sp-portfolio.js', array(), '1.0.0', true ); 
}
function addLogixBuiltScript(){
    wp_enqueue_style("lb-portfolio-style",get_template_directory_uri()."/core/assets/css/lbPortfolio.css",array(),'1.0.0');
    wp_enqueue_script('lb-jquery','https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js', array(), '1.0.0');
    wp_enqueue_script( 'isotope.pkgd.min', get_template_directory_uri() . '/core/assets/js/isotope.pkgd.min.js', array(), '1.0.0', true );
    //
    //wp_enqueue_script('lb-isotopo','https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js', array(), '1.0.0', true );
    wp_enqueue_script('lb-isotopo-handle',get_template_directory_uri() . '/core/assets/js/lb-portfolio-handle.js', array(), '1.0.0', true );
}

//add_action( 'wp_enqueue_scripts', 'addLogixBuiltScript',100 );
add_action( 'wp_enqueue_scripts', 'addScriptsForPortfolio' );
 function acf_custom_repeater(){
    ob_start(); 
   $args = array(  
       'post_type' => 'portfolio',
       'post_status' => 'publish',
       'posts_per_page' => -1, 
);
$loop = new WP_Query( $args ); 
/*START*/
$portfolio = array();
    while ( $loop->have_posts() ) : $loop->the_post(); 
       if( have_rows('add_portfolio_images') ):
            ?>   <?php
          while ( have_rows('add_portfolio_images') ) : the_row();
              if(get_sub_field('thumbnail_image') && get_sub_field('full_width_image') ){
                  if(!(in_array(get_sub_field('technology'),$portfolio))){
                    array_push($portfolio,get_sub_field('technology'));
                  }
               }          
          endwhile;
        endif;
   endwhile;
   ?>
   <!-- button section -->
   <div class="portfolio-gallary logixbuilt-portfolio">
   <div class="button-group filters-button-group">
        <button class="button is-checked" data-filter="*">All</button><?php
   foreach($portfolio as $portfolioCategories){
      ?>
        <button class="button" data-filter=".<?= $portfolioCategories ?>"><?= $portfolioCategories ?></button>
      <?php
   }
   ?></div>
    <!-- button section END-->
    <!-- portfolio content start-->
    <div class="grid">
   <?php
   while ( $loop->have_posts() ) : $loop->the_post(); 
       if( have_rows('add_portfolio_images') ):
            while ( have_rows('add_portfolio_images') ) : the_row();
                if(get_sub_field('thumbnail_image') && get_sub_field('full_width_image') ){
                ?>
                <!-- section start -->
                <div class="element-item <?php echo get_sub_field('technology'); ?> col-sm-3 col-md-3 col-lg-3 lbportfoliobox">
						<div class="portfolio-snip">
							<div class="portfolio-img">
								<img class="img-responsive lbimage" src="<?php echo get_sub_field('thumbnail_image'); ?>" alt="">
							</div>
							<div class="snip-details text-center">
							<a data-fancybox data-type="iframe" data-src="<?php echo get_sub_field('full_width_image'); ?>" class="icon" href="javascript:;" data-fancybox="images"> <i class="fa fa-arrows-alt pclass"></i> </a>
							<a class="icon pclass" target="_blank" href="<?php echo get_sub_field('url'); ?>"> <i class="fa fa-link"></i> </a> 
							<h4 class="item-title"><a href="#" class="pclass"><?php echo get_sub_field('title'); ?></a></h4>
							<span class="category-text pclass"><?php echo implode(",",get_sub_field('label')); ?></span>
						</div>
					</div>
    			</div>
                <!-- section end -->
                <?php
               }          
          endwhile;
        endif;
    endwhile;
    ?>
    </div>
</div>
<?php
   /*template end*/
   wp_reset_postdata();

  return ob_get_clean();
}
add_shortcode( 'pop_portfolio', 'acf_custom_repeater' );





/*
while ( $loop->have_posts() ) : $loop->the_post(); 
       if( have_rows('add_portfolio_images') ):
            ?>   <?php
          while ( have_rows('add_portfolio_images') ) : the_row();
              if(get_sub_field('thumbnail_image') && get_sub_field('full_width_image') ){
                  ?>

                      <div class="my-masonry" id=<?php echo get_sub_field('technology') ?> >
                          <div class="my-item">
                           <a href="javascript:void(0)" data-img="<?php echo get_sub_field('full_width_image'); ?>" class="pop-img"><img src="<?php echo get_sub_field('thumbnail_image'); ?>"></a>
                        </div>
                      </div> 
                  <?php
               }          
          endwhile;

          endif;
   endwhile;




*/