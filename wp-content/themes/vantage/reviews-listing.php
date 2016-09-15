<?php
$reviews = va_get_reviews( array(
	'post_id' => get_the_ID(),
	'status' => 'approve'
) );
$replies = array();
foreach( $reviews as $key=>$review ) {
	if( $review->comment_parent != 0 ) {
		$replies[$review->comment_parent] = $review;
		unset($reviews[$key]);
	}
}
foreach( $reviews as $review ) {
	$user = get_userdata( $review->user_id );

	$user_url = va_dashboard_url( 'reviews', $user->ID );
?>
	<div class="review" id="review-<?php echo $review->comment_ID; ?>" itemprop="review" itemscope itemtype="http://schema.org/Review">
		<meta itemprop="datePublished" content="<?php echo esc_attr( mysql2date( 'Y-m-d', $review->comment_date ) ); ?>" />
		<div class="review-meta">
			<div class="review-author">
				<?php echo html_link( $user_url, get_avatar( $user->ID, 45 ) ); ?>
				<ul class="review-author-meta">
					<li itemprop="author"><strong><?php echo html_link( $user_url, $user->display_name ); ?></strong></li>
					<li><?php echo esc_html( $user->location ); ?></li>
					<li><?php _e( 'Member Since:' , APP_TD ); ?> <?php echo mysql2date( get_option('date_format'), $user->user_registered ); ?></li>
				</ul>
				<div class="likedislikehome"><?php echo do_shortcode('[rating-system-posts counter="yes"]'); ?></div>	
				<?php $reply = !empty( $replies[$review->comment_ID] ) ? $replies[$review->comment_ID] : ''; ?>
				<?php if ( get_current_user_id()) { ?>
					<div class="review-author-reply"><a class="reply-link"><?php _e( 'Reply', APP_TD ); ?></a></div>
				<?php } ?>
			</div>
		</div>
		<div class="review-content">
			<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
				<div class="stars-cont">
					<div class="stars stars-<?php echo $rating = va_get_rating( $review->comment_ID ); ?>"></div>
				</div>
				<meta itemprop="ratingValue" content="<?php echo esc_attr( $rating ); ?>" />
				<meta itemprop="worstRating" content="1" />
				<meta itemprop="bestRating" content="5" />
			</div><!-- /.reviewRating -->
			<p class="review-date"><?php echo html_link( va_get_review_link( $review->comment_ID ), mysql2date( get_option('date_format'), $review->comment_date ) ); ?></p>
		              
					  <?php 
						global $wpdb; 
						$postID=get_the_ID() ;
						$netcheck = get_post_meta( get_the_ID(), 'networktypecheck', true );
                         $Offers = get_comment_meta($review->comment_ID, 'offerating', true );
                         $Payout = get_comment_meta($review->comment_ID, 'payrating', true );
					     $Tracking = get_comment_meta($review->comment_ID, 'trackingrating', true );
						 $Support = get_comment_meta($review->comment_ID, 'supportratnig', true );
						if($netcheck){ ?>
					<div class="s_comment_ratings_list">
					<span class="s_comment_ratings_list_label">Offers:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Offers; ?></span>
					<span class="s_comment_ratings_list_label">Payout:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Payout; ?></span>
					<span class="s_comment_ratings_list_label">Tracking:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Tracking; ?></span>
					<span class="s_comment_ratings_list_label">Support:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Support; ?></span>
					</div>
						<?php }?>
						
					<?php  		
                       global $wpdb; 
						$postID=get_the_ID() ;					
					$hostypecheck = get_post_meta( get_the_ID(), 'hosttypecheck', true );
					  $Reward = get_comment_meta($review->comment_ID, 'rewardrate', true );
                         $Payout1 = get_comment_meta($review->comment_ID, 'payrating', true );
					     $Commision = get_comment_meta($review->comment_ID, 'ratecommision', true );
						 $Support1 = get_comment_meta($review->comment_ID, 'supportratnig', true );
					if( !$hostypecheck == ''){ ?>
						<div class="s_comment_ratings_list">
					<span class="s_comment_ratings_list_label">Reward:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Reward; ?></span>
					<span class="s_comment_ratings_list_label">Payout:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Payout1; ?></span>
					<span class="s_comment_ratings_list_label"> Referral Commision:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Commision; ?></span>
					<span class="s_comment_ratings_list_label">Support:</span>
					<span class="s_comment_ratings_list_value"><?php echo $Support1; ?></span>
					</div>
					<?php } ?>
					<div class="clear"></div>
			
			<div class="review-body" itemprop="description"><?php echo apply_filters( 'comment_text', $review->comment_content, $review ); ?></div>
			<?php if ( !empty( $reply ) ) { ?>
			<?php $author = get_userdata( $reply->user_id ); ?>
				<div class="review-reply" id="review-<?php echo $reply->comment_ID; ?>">
					<?php $childcomments = va_get_reviews(array(
							'post_id'	=> get_the_ID(),
							'status' 	=> 'approve',
							'order'		=> 'DESC',
							'parent'	=> $review->comment_ID,
							)); 
							?>
					<?php foreach($childcomments as $childcomment){ ?>
					<?php $userchild = get_userdata( $childcomment->user_id );

	               $user_urlchild = va_dashboard_url( 'reviews', $userchild->ID );
				   ?>
					<div class="review-reply-author-rep">
					<div class="review-reply-inner">
			<div class="review-author">
				<?php echo html_link( $user_urlchild, get_avatar( $userchild->ID, 45 ) ); ?>
				<ul class="review-author-meta">
					<li itemprop="author"><strong><?php echo html_link( $user_urlchild, $userchild->display_name ); ?></strong></li>
				</ul>
			</div>
			
			
				<span class="rep-date"><?php printf(mysql2date( get_option('date_format'), $childcomment->comment_date ) ); ?></span>
							<div class="reply-body"><?php echo apply_filters( 'comment_text', $childcomment->comment_content, $childcomment ); ?></div>
						
                        <?php $reply = !empty( $replies[$review->comment_ID] ) ? $replies[$review->comment_ID] : ''; ?>
				<?php if ( get_current_user_id()) { ?>
					<div class="review-author-reply"><a class="reply-link"><?php _e( 'Reply', APP_TD ); ?></a></div>
				<?php } ?>						
					</div>
					</div>
					<?php }?>
					
				</div>
			<?php } ?>
			
		</div>
		
	</div>
<?php } ?>

<?php if ( get_current_user_id()) { ?>
	<?php appthemes_load_template( 'form-review-reply.php' ); ?>
<?php } ?>
