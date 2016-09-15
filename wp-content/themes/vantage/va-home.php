<?php
// Template Name: Listings and Events
?>	
<div class="list">
<?php/*
	<div class="silde-main-content">
	<div class="sider-slide-menu">
	<?php $args = array(
	'posts_per_page'   => 5,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'listing',
	'post_status'      => 'publish'
);
$posts_array = get_posts( $args ); ?>

<div class="top-content-spon">
<ul>

<?php $j=0; foreach ($posts_array as $post ) : 
 setup_postdata( $post ); ?>
 <li class="post_title_<?php echo $j;?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php $j++; endforeach; wp_reset_postdata(); ?>
</ul>

<?php $i=0; foreach ($posts_array as $post ) : 
 setup_postdata( $post ); ?>
<div class="top-content-spon-con spoan_<?php echo $i;?>" style="display: none;">
<div class="spon-logo">
<a href="<?php the_permalink() ?>">
<?php 
  $post_thumbnail_id = get_post_thumbnail_id( $post->ID ); 
  if($post_thumbnail_id !=''){
       echo get_the_post_thumbnail( $post->ID,'news-thumb' ); 
    }else{
       echo '<img class="attachment-news-thumb wp-post-image" title="no image" alt="no image" src="';bloginfo('template_url');echo '/images/no-thumb-sm.jpg" />';
           }
?></a></div>
</div>
<?php $i++;  endforeach; wp_reset_postdata(); ?>
</div>

<script>
jQuery('.top-content-spon ul li:last').addClass('last ');
jQuery('.spoan_0').show();
jQuery('.top-content-spon ul li').hover(function(){
jQuery(this).siblings().removeClass('current').end().addClass('current');
var index=jQuery('.top-content-spon ul li').index(jQuery(this));
jQuery('.top-content-spon .top-content-spon-con').eq(index).siblings('.top-content-spon-con').hide().end().show();
})
</script>
			</div>
     <div class="slider-show"><?php echo do_shortcode('[URIS id=76]'); ?></div>
	 </div> */?>
	<?php/* <div class="section-head">
		<?php if ( is_tax( VA_LISTING_CATEGORY ) || is_tax( VA_LISTING_TAG ) ) { ?>
			<h1><?php printf( __( 'CPA Networks - %s', APP_TD ), single_term_title( '', false )); ?></h1>
		<?php } else { ?>
			<h1><?php _e( 'CPA Networks', APP_TD ); ?></h1>
		<?php } ?>
	</div> */?>
   <div class="sorting-top">
	<div class="sorting">
		<div class="list-sort-dropdown"><?php echo va_list_sort_dropdown( VA_LISTING_PTYPE, va_listings_base_url(), $va_options->default_listing_home_sort ); ?></div>
		<div class="list-sort-dropdown"><?php echo va_list_sort_dropdown_content( VA_LISTING_PTYPE, va_listings_base_url() ); ?></div>
			<div class="list-sort-dropdown"><?php echo va_list_sort_dropdown_content1( VA_LISTING_PTYPE, va_listings_base_url() ); ?></div>
		
	</div>
	</div>

<?php
$listings = va_get_home_listings();
if ( $listings->post_count > 0 ) :
?>
<?php appthemes_before_loop( VA_LISTING_PTYPE ); ?>
<?php while ( $listings->have_posts() ) : $listings->the_post(); ?>
	<?php appthemes_before_post( VA_LISTING_PTYPE ); ?>
	<?php if ( va_is_listing_featured( get_the_ID() ) ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'featured' ); ?> <?php echo va_post_coords_attr(); ?> itemscope itemtype="http://schema.org/Organization">
		<div class="featured-head">
			<h3><?php _e( 'Featured', APP_TD ); ?></h3>
		</div>
	<?php else: ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php echo va_post_coords_attr(); ?> itemscope itemtype="http://schema.org/Organization">
	<?php endif; ?>
			<?php get_template_part( 'content-listing' ); ?>
	</article>
	<?php appthemes_after_post( VA_LISTING_PTYPE ); ?>
<?php endwhile; ?>

<?php else : ?>
	<article class="listing">
		<h2><?php __( 'Sorry there are no listings yet', APP_TD ); ?></h2>
	</article>
<?php endif; ?>

<?php if ( $listings->max_num_pages > 1 ) : ?>
	<nav class="pagination">
		<?php  appthemes_pagenavi( $listings, 'paged', array( 'home_listings' => 1 ) ); ?>
	</nav>
<?php endif; ?>

<?php wp_reset_query(); ?>

	<div class="advert">
		<?php appthemes_before_sidebar_widgets( 'va-listings-ad' ); ?>

		<?php dynamic_sidebar( 'va-listings-ad' ); ?>

		<?php appthemes_after_sidebar_widgets( 'va-listings-ad' ); ?>
	</div>
<?php
if ( $va_options->events_enabled ) {
	get_template_part('home-events-loop');
}
?>
</div>

<div id="sidebar">
	<?php get_sidebar( app_template_base() ); ?>
</div>

<?php 
/* global $wpdb;
$querystr = $wpdb->get_col( $wpdb->prepare( "SELECT exashare_posts.* FROM exashare_posts, exashare_postmeta WHERE exashare_posts.ID = exashare_postmeta.post_id  AND exashare_postmeta.meta_key = 'networkpayfrequency' AND exashare_postmeta.meta_value = 'Net 15' AND exashare_posts.post_status = 'publish' AND exashare_posts.post_type = 'listing' AND exashare_posts.post_date < NOW() ORDER BY exashare_posts.post_date DESC",VA_LISTING_PTYPE) );
 
$query1 =  $wpdb->get_col( $wpdb->prepare( "SELECT DISTINCT p.ID FROM $wpdb->posts p INNER JOIN $wpdb->comments c ON p.ID = c.`comment_post_ID` WHERE p.`post_type` = '%s' AND p.`post_status` = 'publish' ORDER BY c.`comment_ID` DESC LIMIT 100", VA_LISTING_PTYPE ) );
//$query = $wpdb->get_var('SELECT * FROM $wpdb->postmeta where ($wpdb->postmeta.meta_key LIKE "networkpayfrequency" AND meta_value LIKE "net-30")');

//$star_5= $wpdb->get_var('SELECT * FROM exashare_postmeta WHERE meta_value LIKE "net-30" and meta_key LIKE "networkpayfrequency"');

print_r($querystr); */

?>