<?php 
        global $wpdb; 
		$postID=get_the_ID() ;
		$netcheck = get_post_meta( get_the_ID(), 'networktypecheck', true );
		echo $newworktypecheck ;
		         if($netcheck){ ?>
		         <div id="main">

<?php the_post(); ?>

<?php do_action( 'appthemes_notices' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/LocalBusiness">
	<?php the_listing_image_gallery(); ?>

	<?php appthemes_before_post_title( VA_LISTING_PTYPE ); ?>
	<h1 class="entry-title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<p class="vcard author"><?php printf( __( 'Added by %s', APP_TD ), '<span class="fn" itemprop="employee">'. va_get_the_author_listings_link() .'</span>' ); ?></p>

	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<?php the_listing_star_rating(); ?>
		<?php 
        global $wpdb; $postID=get_the_ID() ;
					
		$sum = $wpdb->get_var( 'SELECT meta_value FROM exashare_postmeta WHERE meta_key="rating_avg" and post_id='.$postID);

//echo $sum.' ';
if($sum==0)$sum='No rating';
else $sum=$sum.'/5 &nbsp;&nbsp;&nbsp ';

?>


		<p class="reviews"><strong style="color: #ff3600;"><?php echo $sum;?></strong>
		<a href="#reviews" class="click-able-review"><?php
			the_review_count();

			//if ( va_user_can_add_reviews() ) {
				//echo ', ' . html_link( '#add-review', __( 'Write a Review', APP_TD ) );
			//}
		?>
		</a>
		</p>
		
	</div><!-- /.aggregateRating -->

<!-------------------------------------->
<?php 
      global $wpdb;  $postID=get_the_ID() ;
			//$userID=get_current_user_id();	
	
	 $arr1 = $wpdb->get_results( 'SELECT comment_ID FROM exashare_comments WHERE comment_post_ID='.$postID.' and comment_approved=1'  ,ARRAY_A);
	


if(count($arr1)>0){
foreach($arr1 as $arr2){
	 foreach($arr2 as $com)
		$comment[]=$com;
}
 $wherein= implode(',',$comment);
}else {
	$comment[]='';
	$wherein='';
   }
   $star_5=$star_4=$star_3=$star_2=$star_1=0;
   if($wherein!=''){
	
   $star_5= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="5" and meta_key="rating" ');
   $star_4= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="4"  and meta_key="rating"');
   $star_3= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="3"  and meta_key="rating"');
   $star_2= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="2"  and meta_key="rating"');
   $star_1= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="1"  and meta_key="rating"');
}
//echo "aaaaa ".$wherein." aaaaaa";
$offerrating=$payrating=$trackingrating=$supportratnig=0;

 
$b1= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="offerating" ',ARRAY_A);

if($b1[0]['rows']>0){
  $offerrating=$b1[0]['sum']/$b1[0]['rows']; 
  $offerrating=number_format($offerrating,2);
 }
 
$b2= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="payrating" ',ARRAY_A);
if($b2[0]['rows']>0){
		 $payrating=$b2[0]['sum']/$b2[0]['rows'];
		 $payrating=number_format($payrating,2); 
 }
 
$b3= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="trackingrating" ',ARRAY_A);
if($b3[0]['rows']>0){
		 $trackingrating=$b3[0]['sum']/$b3[0]['rows']; 
		 $trackingrating=number_format($trackingrating,2);
}

$b4= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="supportratnig" ',ARRAY_A);
if($b4[0]['rows']>0){
		 $supportratnig=$b4[0]['sum']/$b4[0]['rows']; 
		 $supportratnig=number_format($supportratnig,2);
}


?>

<div class="s_other_ratings_list">
	<span class="s_comment_ratings_list_label">Offers:</span>
	<span class="s_comment_ratings_list_value"><?php echo $offerrating;?></span>
	<span class="s_comment_ratings_list_label">Payout:</span>
	<span class="s_comment_ratings_list_value"><?php echo $payrating;?></span>
	<span class="s_comment_ratings_list_label">Tracking:</span>
	<span class="s_comment_ratings_list_value"><?php echo $trackingrating;?></span>
	<span class="s_comment_ratings_list_label">Support:</span>
	<span class="s_comment_ratings_list_value"><?php echo $supportratnig;?></span>
</div>

<span class="write"><?php
	if ( va_user_can_add_reviews() ) {
				echo '' . html_link( '#add-review', __( 'Write a Review', APP_TD ) );
			}
		?></p>
		</span>


<!------------------------------------>


	<p><?php the_listing_categories(); ?></p>
	<?php appthemes_after_post_title( VA_LISTING_PTYPE ); ?>


	<?php $website = get_post_meta( get_the_ID(), 'website', true ); ?>
	<?php $email = get_post_meta( get_the_ID(), 'email', true ); ?>

	<div itemprop="location" itemscope itemtype="http://schema.org/Place">
		<?php /*<ul>
			<li class="address" itemprop="address"><?php the_listing_address(); ?></li>
			<li class="phone" itemprop="telephone"><strong><?php echo esc_html( get_post_meta( get_the_ID(), 'phone', true ) ); ?></strong></li>
		<?php if ( $website ) { ?>
			<li id="listing-website"><a href="<?php echo esc_url( $website ); ?>" title="<?php _e( 'Website', APP_TD ); ?>" target="_blank" itemprop="url"><?php echo esc_html( $website ); ?></a></li>
		<?php } ?>
		<?php if ( $email ) { ?>
			<li id="listing-email"><a href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php _e( 'Email', APP_TD ); ?>" target="_blank"><?php echo esc_html( $email ); ?></a></li>
		<?php } ?>

		<?php do_action( 'va_display_listing_contact_fields', get_the_ID() ); ?>
		</ul>*/?>

		<?php
		$coord = appthemes_get_coordinates( $post->ID );
		if ( 0 < $coord->lat ) {
		?>
			<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="latitude" content="<?php echo esc_attr( $coord->lat ); ?>" />
				<meta itemprop="longitude" content="<?php echo esc_attr( $coord->lng ); ?>" />
			</div>
		<?php } ?>
	</div><!-- /.Place -->

	<?php/*
	$social_networks = va_get_available_listing_networks( get_the_ID() );
	if ( ! empty( $social_networks ) ) { ?>
		<div id="listing-follow">
			<p><?php _e( 'Follow:', APP_TD ); ?></p>
			<?php foreach ( $social_networks as $social_network => $account ) { ?>
				<a href="<?php echo va_get_social_account_url( $social_network, $account ); ?>" title="<?php echo esc_attr( va_get_social_network_title( $social_network ) ); ?>" target="_blank">
					<span class="<?php echo esc_attr( $social_network ); ?>-icon social-icon"><?php echo va_get_social_network_title( $social_network ); ?></span>
					<?php if ( 'twitter' === $social_network ) { ?>
						<span class="twitter-handle"> @<?php echo esc_html( $account ); ?></span>
					<?php } ?>
				</a>
			<?php } ?>
		</div>
	<?php } */?>

	<div class="listing-fields">
		<?php the_listing_fields(); ?>
	</div>
	<a class="join-now" href="<?php echo esc_html( get_post_meta( get_the_ID(), 'networkurl', true ) ); ?>">Join Now</a>
	<div class="single-listing listing-faves">
		<?php the_listing_faves_link(); ?>
	</div>

	<div class="listing-actions">
		<?php the_listing_edit_link(); ?>
		<?php the_listing_claimable_link(); ?>
		<?php the_listing_purchase_link(); ?>
		<?php the_contact_listing_owner_button(); ?>
	</div>

	<div class="listing-share">
		<?php if ( function_exists( 'sharethis_button' ) ) sharethis_button(); ?>
	</div>

	<?php /*********************************************table start***************************************************************************/?>
	      <div id="s_network_detail">
  <div id="s_network_detail_title">
   <h2 class="s_left s_white s_bold">Affiliate Network Details</h2>
     <div class="s_right">
	 <span class="s_grey"><strong>Phone: </strong>
	 	<?php $Phone = get_post_meta( get_the_ID(), 'networphone', true );
		         if( $Phone == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Phone;		  
		}?>
	 </span>
	 <span class="s_grey"><strong>Email: </strong>
	 	<?php $Email = get_post_meta( get_the_ID(), 'networkemail', true );
		         if( $Email == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Email;		  
		}?>
	 </span>
	 </div>
   </div>
		<div id="s_network_detail_con">
		<p>
		<span class="fixed-title-filed">Number of Offers</span>
		<span class="u_network_data"><a class="offernum" href="" target="_blank" rel="nofollow">
		
		<?php $offers = get_post_meta( get_the_ID(), 'networkmanyoffers', true );
		         if( $offers == ''){ 
		         echo "N/A";
			  }else{
                  		echo $offers ;		  
		}?>
		
		
		</a></span></p>
		<p class="u_alt">
		<span class="fixed-title-filed">Commission Type</span>
		<span class="u_network_data">
		<?php $Commission = get_post_meta( get_the_ID(), 'networkcommission', true );
		         if( $Commission == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Commission ;		  
		}?>
		
		</span><br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Minimum Payment</span>
		<span class="u_network_data">
		<?php $Payment = get_post_meta( get_the_ID(), 'networkpayment', true );
		         if( $Payment == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Payment ;		  
		}?>
		</span><br style="clear:both"></p>
		<p class="u_alt">
		<span class="fixed-title-filed">Payment Frequency</span>
		<span class="u_network_data">
		<?php $PaymentFrequency = get_post_meta( get_the_ID(), 'networkpayfrequency', true );
		         if( $PaymentFrequency == ''){ 
		         echo "N/A";
			  }else{
                  		echo $PaymentFrequency ;		  
		}?>
		</span>
		<br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Payment Method</span>
		<span class="u_network_data">
		<?php $PaymentMethod = get_post_meta( get_the_ID(), 'networkpaymethod', true );
		         if( $PaymentMethod == ''){ 
		         echo "N/A";
			  }else{
                  		echo $PaymentMethod;		  
		}?>
		</span>
		<br style="clear:both">
		</p>
		
		<p class="u_alt">
		<span class="fixed-title-filed">Referral Commission</span>
		<span class="u_network_data">
		<?php $ReferralCommission = get_post_meta( get_the_ID(), 'networkrefcommission', true );
		         if( $ReferralCommission == ''){ 
		         echo "N/A";
			  }else{
                  		echo $ReferralCommission;		  
		}?>
		
		</span><br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Tracking Software</span>
		<span class="u_network_data">
		<?php $TrackingSoftware = get_post_meta( get_the_ID(), 'networktracking', true );
		         if( $TrackingSoftware == ''){ 
		         echo "N/A";
			  }else{
                  		echo $TrackingSoftware;		  
		}?>
		</span>
		<br style="clear:both">
		</p>
		
		<p class="u_alt">
		<span class="fixed-title-filed">Tracking Link</span>
		<span class="u_network_data">
			<?php $TrackingLink = get_post_meta( get_the_ID(), 'networktrackinglink', true );
		         if( $TrackingLink == ''){ 
		         echo "N/A";
			  }else{
                  		echo $TrackingLink;		  
		}?>
		</span><br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Twitter</span>
		<span class="u_network_data">
		<?php $nettwitter = get_post_meta( get_the_ID(), 'networktwitter', true );
		if( $nettwitter == ''){ ?> N/A <?php } else {?> <a href="<?php echo $nettwitter ;?>" target="_blank"><?php echo $nettwitter ;?></a> <?php }?>
		</span><br style="clear:both">
		</p>
		<p class="u_alt">
		<span class="fixed-title-filed">Facebook</span>
		<span class="u_network_data">
		<?php $netfacebook = get_post_meta( get_the_ID(), 'networkfacebook', true );
		 if( $netfacebook == ''){ ?> N/A <?php } else {?> <a href="<?php echo $netfacebook ;?>" target="_blank"><?php echo $netfacebook ; ?></a> <?php }?>
		</span>
		<br style="clear:both">
		</p>
		<p class="u_last">
		<span class="fixed-title-filed">Affiliate Manager</span>
		<span class="u_network_data"> <?php echo va_get_the_author_listings_link(); ?></span>
		 <span class="s_em"><span class="s_tip"><span class="s_tip_left"></span><span class="s_tip_mid">
		      	Email:<?php $emailshow = get_post_meta( get_the_ID(), 'networkemail', true );
		         if( $emailshow == ''){ 
		         echo "N/A";
			  }else{
                  		echo $emailshow;		  
		}?>
		
		
		   </span>
									<span class="s_tip_right"></span>
								</span>
							</span>
							<span class="s_aim">
								<span class="s_tip">
									<span class="s_tip_left"></span>
			<span class="s_tip_mid">AIM: <?php $AIM = get_post_meta( get_the_ID(), 'networkaimname', true );
		         if( $AIM == ''){ 
		         echo "N/A";
			  }else{
                  		echo $AIM;		  
		}?></span>
									<span class="s_tip_right"></span>
								</span>
							</span>
							<span class="s_ph">
								<span class="s_tip">
									<span class="s_tip_left"></span>
									<span class="s_tip_mid">Phone: <?php $Phone_show = get_post_meta( get_the_ID(), 'networphone', true );
		         if( $Phone_show  == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Phone_show;		  
		}?></span>
									<span class="s_tip_right"></span>
								</span>
							</span>
							<span class="s_sp">
								<span class="s_tip">
									<span class="s_tip_left"></span>
									<span class="s_tip_mid">Skype: <?php $Skype = get_post_meta( get_the_ID(), 'networkskype', true );
		         if( $Skype  == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Skype;		  
		}?></span>
									<span class="s_tip_right"></span>
								</span>
							</span> 
														<br style="clear:both">
						</p>
					</div>
					<div id="s_network_detail_rate">
						<div class="s_network_detail_rate_title">Rating Distribution</div>
				
<?php /*
      global $wpdb; $postID=get_the_ID() ;
			$userID=get_current_user_id();	
	  $a1 = $wpdb->get_results( 'SELECT comment_ID FROM exashare_comments WHERE comment_post_ID='.$postID.' and user_id='.$userID,ARRAY_A);

if(count($a1)>0){
foreach($a1[0] as $com)$comment[]=$com;
$wherein= implode(',',$comment);
}else {
	$comment[]='';
	$wherein='';
   }
   $star_5=$star_4=$star_3=$star_2=$star_1=0;
   if($wherein!=''){
   $star_5= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=5 and meta_key="rating" ');
   $star_4= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=4  and meta_key="rating"');
   $star_3= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=3  and meta_key="rating"');
   $star_2= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=2  and meta_key="rating"');
   $star_1= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=1  and meta_key="rating"');
}*/

if($star_5==0 && $star_4==0  &&  $star_3==0  && $star_2==0  &&  $star_1==0)$star_width='0px';else $star_width='76px';
?>
						
						  <div id="s_showrating"><div id="s_rating_overall_wrap">
							  
							  <div class="s_rating_overall"><div class="s_rating_overall_name"><span>5</span> stars</div>
							  <div class="s_rating_overall_value_wrap">
							  <div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div>
							  </div><div class="s_overall_num"><?php echo $star_5;?></div>
						      </div>
						      <br>
						  <div class="s_rating_overall"><div class="s_rating_overall_name"><span>4</span> stars</div>
						  <div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						   <div class="s_overall_num"><?php echo $star_4;?></div></div>
						  <br>
						   
						   <div class="s_rating_overall"><div class="s_rating_overall_name"><span>3</span> stars</div><div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						   <div class="s_overall_num"><?php echo $star_3;?></div></div>
						    <br>
						    
						   <div class="s_rating_overall"><div class="s_rating_overall_name"><span>2</span> stars</div><div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						    <div class="s_overall_num"><?php echo $star_2;?></div></div>
						     <br>
						     
						    <div class="s_rating_overall"><div class="s_rating_overall_name"><span>1</span> star</div><div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						    <div class="s_overall_num"><?php echo $star_1;?></div></div>
						    
						    </div>
						    <br><br> <br><br>
						    <?php 
						    //~ if($offerrating==0 && $payrating==0  && $trackingrating==0 && $supportratnig==0){
								//~ $offerrating_width=$payrating_width=$trackingrating_width=$supportratnig_width=0;
							//~ }else{    
							/*total width=5====66px;*/
						     $offerrating_width		=($offerrating*66)/5;
						     $payrating_width		=($payrating*66)/5;
						     $trackingrating_width	=($trackingrating*66)/5;
						     $supportratnig_width	=($supportratnig*66)/5;
						    
						    
								//~ }
								?>
						    <div id="s_rating_long_wrap">
							    <div class="s_rating_long"><div class="s_rating_long_name">Offers</div><div class="s_rating_long_value_wrap">
								<div class="s_rating_long_value" style="width:<?php echo $offerrating_width;?>px" title="4.88"></div></div>
								</div>
								
								
								<div class="s_rating_long"><div class="s_rating_long_name">Payout</div><div class="s_rating_long_value_wrap"><div class="s_rating_long_value" style="width:<?php echo $payrating_width;?>px" title="4.97"></div></div>
								</div>
								
								
								<div class="s_rating_long"><div class="s_rating_long_name">Tracking</div><div class="s_rating_long_value_wrap"><div class="s_rating_long_value" style="width:<?php echo $trackingrating_width;?>px" title="4.97"></div></div>
								</div>
								
								
								<div class="s_rating_long"><div class="s_rating_long_name">Support</div><div class="s_rating_long_value_wrap"><div class="s_rating_long_value" style="width:<?php echo $supportratnig_width;?>px" title="4.97"></div></div></div></div>
								</div> 	
											
						</div>
				</div>
	
	<?php /*********************************************table end***************************************************************************/?>
	
	<div class="tags"><?php the_listing_tags( '<span>' . __( 'Tags:', APP_TD ) . '</span> ' ); ?></div>
	<div class="added" style="display:none;"><?php _e( 'Updated:', APP_TD ); ?> <span class="date updated"><?php the_modified_time('M j, Y'); ?></span></div>

	<?php va_the_files_list(); ?>

	<div id="listing-tabs">
		<div class="tabs">
			<a id="overview-tab" class="active-tab rounded-t first" href="#overview"><?php _e( 'Description', APP_TD ); ?></a>
			<a id="reviews-tab" class="rounded-t" href="#reviews"><?php _e( 'Affiliate Reviews', APP_TD ); ?></a>
			<a id="paymentproof-tab" class="rounded-t" href="#paymentproof"><?php _e( 'Payment Proofs', APP_TD ); ?></a>
			<a id="questions-tab" class="rounded-t" href="#questions"><?php _e( 'Questions & suggestions', APP_TD ); ?></a>

			<br class="clear" />
		</div>

		<section id="overview" itemprop="description">
			<?php appthemes_before_post_content( VA_LISTING_PTYPE ); ?>
			<?php the_content(); ?>
			<?php appthemes_after_post_content( VA_LISTING_PTYPE ); ?>
		</section>

		<section id="reviews">
			<?php get_template_part( 'reviews', 'listing' ); ?>
		</section>
		
		<section id="paymentproof">
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
<?php  
		     $paymentprooof = get_comment_meta($review->comment_ID,'payproofimage', true);
			 	$url = $paymentprooof;
					@ $file = file_get_contents($url); // to get file
					$name1 = basename($url); // to get file name
					$ext = pathinfo($url, PATHINFO_EXTENSION); // to get extension
					$name2 = pathinfo($url, PATHINFO_FILENAME); //file name without extension
		  ?>
		      <?php if($ext){ ?>
			  
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
				<?php  
		     $paymentprooof = get_comment_meta($review->comment_ID,'payproofimage', true);
					$url = $paymentprooof;
					@ $file = file_get_contents($url); // to get file
					$name1 = basename($url); // to get file name
					$ext = pathinfo($url, PATHINFO_EXTENSION); // to get extension
					$name2 =pathinfo($url, PATHINFO_FILENAME); //file name without extension
		  ?>
		      <?php if($ext){ ?>
		      <div class="payproof-image"><img src="<?php echo $paymentprooof; ?>" ></div>
			  <?php } ?>
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
<?php } ?>
<?php if ( get_current_user_id()) { ?>
	<?php appthemes_load_template( 'form-review-reply.php' ); ?>
<?php } ?>



		</section>
		
		<section id="questions">
          <?php comments_template(); ?>
		</section>
	</div>

	<div class="clear"></div>

	<div class="section-head head-tab-show-1">
		<a id="add-review" name="add-review"></a>
		<h2 id="left-hanger-add-review"><?php _e( 'Add Your Review', APP_TD ); ?></h2>
	</div>
   <div class="form_tab_show-1">

	<?php if ( $review = va_get_user_review( get_current_user_id(), get_the_ID() ) ) : ?>

		<?php if ( '1' !== $review->comment_approved ) { ?>
			<p>
				<?php _e( 'Your review is awaiting moderation.', APP_TD ); ?>
			</p>
		<?php } else { ?>
			<p>
				<?php _e( 'You have already reviewed this listing.', APP_TD ); ?>
			</p>
		<?php } ?>

	<?php elseif ( va_user_can_add_reviews() ) : ?>
		<?php appthemes_load_template( 'form-review.php' ); ?>
	<?php elseif ( get_current_user_id() == get_the_author_meta('ID') ) : ?>
		<p>
			<?php _e( "You can't review your own listing.", APP_TD ); ?>
		</p>
	<?php elseif ( !is_user_logged_in() ) : ?>
		<p>
			<?php
				$login_url = wp_login_url( get_permalink() );
				$register_url = add_query_arg( 'redirect_to', urlencode( get_permalink() ), appthemes_get_registration_url() );
				printf( __( 'Please <a href="%1$s">login</a> or <a href="%2$s">register</a> to add your review.', APP_TD ), $login_url, $register_url );
			?>
		</p>
	<?php else : ?>
		<p>
			<?php _e( 'Reviews are closed.', APP_TD ); ?>
		</p>
	<?php endif; ?>
	</div>
		<div class="clear"></div>
	<?php/* <div class="section-head head-tab-show-2">
		<a id="add-query" name="addquery"></a>
		<h2 id="left-hanger-add-review"><?php _e( 'Questions & Suggestions', APP_TD ); ?></h2>
	</div> */?>
     <?php /*  <div class="form_tab_show-2">
	    <?php if ( $review = va_get_user_review( get_current_user_id(), get_the_ID() ) ) : ?>
	<?php elseif ( !is_user_logged_in() ) : ?>
		<p>
			<?php
				$login_url = wp_login_url( get_permalink() );
				$register_url = add_query_arg( 'redirect_to', urlencode( get_permalink() ), appthemes_get_registration_url() );
				printf( __( 'Please <a href="%1$s">login</a> or <a href="%2$s">register</a> to add your Questions.', APP_TD ), $login_url, $register_url );
			?>
		</p>
	<?php else : ?>
		<p>
						<form action="" method="post" class="question-form">
			<div ><textarea name="" style="height: 150px;" id=""></textarea></div>
	<div ><input name="submit" type="submit" id="s_submit" tabindex="5" value="Submit" style="margin-top: 10px;"></div>
    </form>
		</p>
	<?php endif; ?>
	   </div> */?>
</article>

</div><!-- /#main -->
<?php } 			 
$hostypecheck = get_post_meta( get_the_ID(), 'hosttypecheck', true );
if( !$hostypecheck == ''){ ?>
<div id="main">

<?php the_post(); ?>

<?php do_action( 'appthemes_notices' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/LocalBusiness">
	<?php the_listing_image_gallery(); ?>

	<?php appthemes_before_post_title( VA_LISTING_PTYPE ); ?>
	<h1 class="entry-title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	<p class="vcard author"><?php printf( __( 'Added by %s', APP_TD ), '<span class="fn" itemprop="employee">'. va_get_the_author_listings_link() .'</span>' ); ?></p>

	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
		<?php the_listing_star_rating(); ?>
		<?php 
        global $wpdb; $postID=get_the_ID() ;
					
		$sum = $wpdb->get_var( 'SELECT meta_value FROM exashare_postmeta WHERE meta_key="rating_avg" and post_id='.$postID);

//echo $sum.' ';
if($sum==0)$sum='No rating';
else $sum=$sum.'/5 &nbsp;&nbsp;&nbsp ';

?>


		<p class="reviews"><strong style="color: #ff3600;"><?php echo $sum;?></strong>
		<a href="#reviews" class="click-able-review"><?php
			the_review_count();

			//if ( va_user_can_add_reviews() ) {
				//echo ', ' . html_link( '#add-review', __( 'Write a Review', APP_TD ) );
			//}
		?>
		</a>
		</p>
		
	</div><!-- /.aggregateRating -->

<!-------------------------------------->
<?php 
      global $wpdb;  $postID=get_the_ID() ;
			//$userID=get_current_user_id();	
	
	 $arr1 = $wpdb->get_results( 'SELECT comment_ID FROM exashare_comments WHERE comment_post_ID='.$postID.' and comment_approved=1'  ,ARRAY_A);
	


if(count($arr1)>0){
foreach($arr1 as $arr2){
	 foreach($arr2 as $com)
		$comment[]=$com;
}
 $wherein= implode(',',$comment);
}else {
	$comment[]='';
	$wherein='';
   }
   $star_5=$star_4=$star_3=$star_2=$star_1=0;
   if($wherein!=''){
	
   $star_5= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="5" and meta_key="rating" ');
   $star_4= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="4"  and meta_key="rating"');
   $star_3= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="3"  and meta_key="rating"');
   $star_2= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="2"  and meta_key="rating"');
   $star_1= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value="1"  and meta_key="rating"');
}
//echo "aaaaa ".$wherein." aaaaaa";
$rewardrates=$payrating=$ratecommisionss=$supportratnig=0;

 
$b1= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="rewardrate" ',ARRAY_A);

if($b1[0]['rows']>0){
  $rewardrates=$b1[0]['sum']/$b1[0]['rows']; 
  $rewardrates=number_format($rewardrates,2);
 }
 
$b2= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="payrating" ',ARRAY_A);
if($b2[0]['rows']>0){
		 $payrating=$b2[0]['sum']/$b2[0]['rows'];
		 $payrating=number_format($payrating,2); 
 }
 
$b3= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="ratecommision" ',ARRAY_A);
if($b3[0]['rows']>0){
		 $ratecommisionss=$b3[0]['sum']/$b3[0]['rows']; 
		 $ratecommisionss=number_format($ratecommisionss);
}

$b4= $wpdb->get_results( 'SELECT sum(meta_value)as sum ,count(*) as rows FROM exashare_commentmeta WHERE comment_id in('.$wherein.')  and meta_key="supportratnig" ',ARRAY_A);
if($b4[0]['rows']>0){
		 $supportratnig=$b4[0]['sum']/$b4[0]['rows']; 
		 $supportratnig=number_format($supportratnig,2);
}


?>

<div class="s_other_ratings_list">
	<span class="s_comment_ratings_list_label">Reward:</span>
	<span class="s_comment_ratings_list_value"><?php echo $rewardrates;?></span>
	<span class="s_comment_ratings_list_label">Payout:</span>
	<span class="s_comment_ratings_list_value"><?php echo $payrating;?></span>
	<span class="s_comment_ratings_list_label">Referral Commision:</span>
	<span class="s_comment_ratings_list_value"><?php echo $ratecommisionss;?></span>
	<span class="s_comment_ratings_list_label">Support:</span>
	<span class="s_comment_ratings_list_value"><?php echo $supportratnig;?></span>
</div>

<span class="write"><?php
	if ( va_user_can_add_reviews() ) {
				echo '' . html_link( '#add-review', __( 'Write a Review', APP_TD ) );
			}
		?></p>
		</span>
<!------------------------------------>

	<p><?php the_listing_categories(); ?></p>
	<?php appthemes_after_post_title( VA_LISTING_PTYPE ); ?>


	<?php $website = get_post_meta( get_the_ID(), 'website', true ); ?>
	<?php $email = get_post_meta( get_the_ID(), 'email', true ); ?>

	<div itemprop="location" itemscope itemtype="http://schema.org/Place">
		<?php /*<ul>
			<li class="address" itemprop="address"><?php the_listing_address(); ?></li>
			<li class="phone" itemprop="telephone"><strong><?php echo esc_html( get_post_meta( get_the_ID(), 'phone', true ) ); ?></strong></li>
		<?php if ( $website ) { ?>
			<li id="listing-website"><a href="<?php echo esc_url( $website ); ?>" title="<?php _e( 'Website', APP_TD ); ?>" target="_blank" itemprop="url"><?php echo esc_html( $website ); ?></a></li>
		<?php } ?>
		<?php if ( $email ) { ?>
			<li id="listing-email"><a href="mailto:<?php echo esc_attr( $email ); ?>" title="<?php _e( 'Email', APP_TD ); ?>" target="_blank"><?php echo esc_html( $email ); ?></a></li>
		<?php } ?>

		<?php do_action( 'va_display_listing_contact_fields', get_the_ID() ); ?>
		</ul>*/?>

		<?php
		$coord = appthemes_get_coordinates( $post->ID );
		if ( 0 < $coord->lat ) {
		?>
			<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
				<meta itemprop="latitude" content="<?php echo esc_attr( $coord->lat ); ?>" />
				<meta itemprop="longitude" content="<?php echo esc_attr( $coord->lng ); ?>" />
			</div>
		<?php } ?>
	</div><!-- /.Place -->

	<?php/*
	$social_networks = va_get_available_listing_networks( get_the_ID() );
	if ( ! empty( $social_networks ) ) { ?>
		<div id="listing-follow">
			<p><?php _e( 'Follow:', APP_TD ); ?></p>
			<?php foreach ( $social_networks as $social_network => $account ) { ?>
				<a href="<?php echo va_get_social_account_url( $social_network, $account ); ?>" title="<?php echo esc_attr( va_get_social_network_title( $social_network ) ); ?>" target="_blank">
					<span class="<?php echo esc_attr( $social_network ); ?>-icon social-icon"><?php echo va_get_social_network_title( $social_network ); ?></span>
					<?php if ( 'twitter' === $social_network ) { ?>
						<span class="twitter-handle"> @<?php echo esc_html( $account ); ?></span>
					<?php } ?>
				</a>
			<?php } ?>
		</div>
	<?php } */?>

	<div class="listing-fields">
		<?php the_listing_fields(); ?>
	</div>
	<a class="join-now" href="<?php echo esc_html( get_post_meta( get_the_ID(), 'networkurl', true ) ); ?>">Join Now</a>
	<div class="single-listing listing-faves">
		<?php the_listing_faves_link(); ?>
	</div>

	<div class="listing-actions">
		<?php the_listing_edit_link(); ?>
		<?php the_listing_claimable_link(); ?>
		<?php the_listing_purchase_link(); ?>
		<?php the_contact_listing_owner_button(); ?>
	</div>

	<div class="listing-share">
		<?php if ( function_exists( 'sharethis_button' ) ) sharethis_button(); ?>
	</div>

	<?php /*********************************************table start***************************************************************************/?>
	      <div id="s_network_detail">
  <div id="s_network_detail_title">
   <h2 class="s_left s_white s_bold">Affiliate Network Details</h2>
     <div class="s_right">
	 <span class="s_grey"><strong>Phone: </strong>
	 	<?php $Phone = get_post_meta( get_the_ID(), 'networphone', true );
		         if( $Phone == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Phone;		  
		}?>
	 </span>
	 <span class="s_grey"><strong>Email: </strong>
	 	<?php $Email = get_post_meta( get_the_ID(), 'networkemail', true );
		         if( $Email == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Email;		  
		}?>
	 </span>
	 </div>
   </div>
		<div id="s_network_detail_con">
		<p>
		<span class="fixed-title-filed">Maximum File size</span>
		<span class="u_network_data"><a class="offernum" href="" target="_blank" rel="nofollow">
		
		<?php $Maximumsize = get_post_meta( get_the_ID(), 'maxsizefile', true );
		         if( $Maximumsize == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Maximumsize ;		  
		}?>
		
		
		</a></span></p>
		<p class="u_alt">
		<span class="fixed-title-filed">Storage Size</span>
		<span class="u_network_data">
		<?php $Storage = get_post_meta( get_the_ID(), 'storagesizes', true );
		         if( $Storage == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Storage ;		  
		}?>
		
		</span><br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Minimum Payment</span>
		<span class="u_network_data">
		<?php $Payment = get_post_meta( get_the_ID(), 'networkpayment', true );
		         if( $Payment == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Payment ;		  
		}?>
		</span><br style="clear:both"></p>
		<p class="u_alt">
		<span class="fixed-title-filed">Payment Frequency</span>
		<span class="u_network_data">
		<?php $PaymentFrequency = get_post_meta( get_the_ID(), 'networkpayfrequency', true );
		         if( $PaymentFrequency == ''){ 
		         echo "N/A";
			  }else{
                  		echo $PaymentFrequency ;		  
		}?>
		</span>
		<br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Payment Method</span>
		<span class="u_network_data">
		<?php $PaymentMethod = get_post_meta( get_the_ID(), 'networkpaymethod', true );
		         if( $PaymentMethod == ''){ 
		         echo "N/A";
			  }else{
                  		echo $PaymentMethod;		  
		}?>
		</span>
		<br style="clear:both">
		</p>
		
		<p class="u_alt">
		<span class="fixed-title-filed">Referral Commission</span>
		<span class="u_network_data">
		<?php $ReferralCommission = get_post_meta( get_the_ID(), 'networkrefcommission', true );
		         if( $ReferralCommission == ''){ 
		         echo "N/A";
			  }else{
                  		echo $ReferralCommission;		  
		}?>
		
		</span><br style="clear:both">
		</p>
		
		<p>
		<span class="fixed-title-filed">Uploading speed</span>
		<span class="u_network_data">
		<?php $Uploading = get_post_meta( get_the_ID(), 'uploadspeed', true );
		         if( $Uploading == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Uploading;		  
		}?>
		</span>
		<br style="clear:both">
		</p>
		
		<p class="u_alt">
		<span class="fixed-title-filed">Downloading speed</span>
		<span class="u_network_data">
			<?php $Downloading = get_post_meta( get_the_ID(), 'downloadspeed', true );
		         if( $Downloading == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Downloading;		  
		}?>
		</span><br style="clear:both">
		</p>
		<p class="u_alt">
		<span class="fixed-title-filed">File Types Supported</span>
		<span class="u_network_data">
			<?php $Supported = get_post_meta( get_the_ID(), 'filesupport', true );
		         if( $Supported == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Supported;		  
		}?>
		</span><br style="clear:both">
		</p>
		
		<p class="u_alt">
		<span class="fixed-title-filed">Reward Program</span>
		<span class="u_network_data">
			<?php $Reward = get_post_meta( get_the_ID(), 'reward', true );
		         if( $Reward == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Reward;		  
		}?>
		</span><br style="clear:both">
		</p>
		<p class="u_alt">
		<span class="fixed-title-filed">Uploading Methods</span>
		<span class="u_network_data">
			<?php $UploadingMethods = get_post_meta( get_the_ID(), 'uploadingmethods', true );
		         if( $UploadingMethods == ''){ 
		         echo "N/A";
			  }else{
                  		echo $UploadingMethods;		  
		}?>
		</span><br style="clear:both">
		</p>
		
		
		<p class="u_alt">
		<span class="fixed-title-filed">views/downloads</span>
		<span class="u_network_data">
			<?php $peradownload = get_post_meta( get_the_ID(), 'perdownload', true );
		         if( $peradownload == ''){ 
		         echo "N/A";
			  }else{
                  		echo $peradownload;		  
		}?>
		</span><br style="clear:both">
		</p>
		<p>
		<span class="fixed-title-filed">Twitter</span>
		<span class="u_network_data">
		<?php $nettwitter = get_post_meta( get_the_ID(), 'networktwitter', true );
		if( $nettwitter == ''){ ?> N/A <?php } else {?> <a href="<?php echo $nettwitter ;?>" target="_blank"><?php echo $nettwitter ;?></a> <?php }?>
		</span><br style="clear:both">
		</p>
		<p class="u_alt">
		<span class="fixed-title-filed">Facebook</span>
		<span class="u_network_data">
		<?php $netfacebook = get_post_meta( get_the_ID(), 'networkfacebook', true );
		 if( $netfacebook == ''){ ?> N/A <?php } else {?> <a href="<?php echo $netfacebook ;?>" target="_blank"><?php echo $netfacebook ; ?></a> <?php }?>
		</span>
		<br style="clear:both">
		</p>
		<p class="u_last">
		<span class="fixed-title-filed">Affiliate Manager</span>
		<span class="u_network_data"> <?php echo va_get_the_author_listings_link(); ?></span>
		 <span class="s_em"><span class="s_tip"><span class="s_tip_left"></span><span class="s_tip_mid">
		      	Email:<?php $emailshow = get_post_meta( get_the_ID(), 'networkemail', true );
		         if( $emailshow == ''){ 
		         echo "N/A";
			  }else{
                  		echo $emailshow;		  
		}?>
		
		
		   </span>
									<span class="s_tip_right"></span>
								</span>
							</span>
							<span class="s_aim">
								<span class="s_tip">
									<span class="s_tip_left"></span>
			<span class="s_tip_mid">AIM: <?php $AIM = get_post_meta( get_the_ID(), 'networkaimname', true );
		         if( $AIM == ''){ 
		         echo "N/A";
			  }else{
                  		echo $AIM;		  
		}?></span>
									<span class="s_tip_right"></span>
								</span>
							</span>
							<span class="s_ph">
								<span class="s_tip">
									<span class="s_tip_left"></span>
									<span class="s_tip_mid">Phone: <?php $Phone_show = get_post_meta( get_the_ID(), 'networphone', true );
		         if( $Phone_show  == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Phone_show;		  
		}?></span>
									<span class="s_tip_right"></span>
								</span>
							</span>
							<span class="s_sp">
								<span class="s_tip">
									<span class="s_tip_left"></span>
									<span class="s_tip_mid">Skype: <?php $Skype = get_post_meta( get_the_ID(), 'networkskype', true );
		         if( $Skype  == ''){ 
		         echo "N/A";
			  }else{
                  		echo $Skype;		  
		}?></span>
									<span class="s_tip_right"></span>
								</span>
							</span> 
														<br style="clear:both">
						</p>
					</div>
					<div id="s_network_detail_rate">
						<div class="s_network_detail_rate_title">Rating Distribution</div>
				
<?php /*
      global $wpdb; $postID=get_the_ID() ;
			$userID=get_current_user_id();	
	  $a1 = $wpdb->get_results( 'SELECT comment_ID FROM exashare_comments WHERE comment_post_ID='.$postID.' and user_id='.$userID,ARRAY_A);

if(count($a1)>0){
foreach($a1[0] as $com)$comment[]=$com;
$wherein= implode(',',$comment);
}else {
	$comment[]='';
	$wherein='';
   }
   $star_5=$star_4=$star_3=$star_2=$star_1=0;
   if($wherein!=''){
   $star_5= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=5 and meta_key="rating" ');
   $star_4= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=4  and meta_key="rating"');
   $star_3= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=3  and meta_key="rating"');
   $star_2= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=2  and meta_key="rating"');
   $star_1= $wpdb->get_var( 'SELECT count(*) FROM exashare_commentmeta WHERE comment_id in('.$wherein.') and meta_value=1  and meta_key="rating"');
}*/

if($star_5==0 && $star_4==0  &&  $star_3==0  && $star_2==0  &&  $star_1==0)$star_width='0px';else $star_width='76px';
?>
						
						  <div id="s_showrating_host"><div id="s_rating_overall_wrap">
							  
							  <div class="s_rating_overall"><div class="s_rating_overall_name"><span>5</span> stars</div>
							  <div class="s_rating_overall_value_wrap">
							  <div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div>
							  </div><div class="s_overall_num"><?php echo $star_5;?></div>
						      </div>
						      <br>
						  <div class="s_rating_overall"><div class="s_rating_overall_name"><span>4</span> stars</div>
						  <div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						   <div class="s_overall_num"><?php echo $star_4;?></div></div>
						  <br>
						   
						   <div class="s_rating_overall"><div class="s_rating_overall_name"><span>3</span> stars</div><div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						   <div class="s_overall_num"><?php echo $star_3;?></div></div>
						    <br>
						    
						   <div class="s_rating_overall"><div class="s_rating_overall_name"><span>2</span> stars</div><div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						    <div class="s_overall_num"><?php echo $star_2;?></div></div>
						     <br>
						     
						    <div class="s_rating_overall"><div class="s_rating_overall_name"><span>1</span> star</div><div class="s_rating_overall_value_wrap"><div class="s_rating_overall_value" style="width:<?php echo $star_width;?>"></div></div>
						    <div class="s_overall_num"><?php echo $star_1;?></div></div>
						    
						    </div>
						    <br><br> <br><br>
						    <?php 
						    //~ if($offerrating==0 && $payrating==0  && $trackingrating==0 && $supportratnig==0){
								//~ $offerrating_width=$payrating_width=$trackingrating_width=$supportratnig_width=0;
							//~ }else{    
							/*total width=5====66px;*/
						     $rewardrates_width		=($rewardrates*66)/5;
						     $payrating_width		=($payrating*66)/5;
						     $ratecommisionss_width	=($ratecommisionss*66)/5;
						     $supportratnig_width	=($supportratnig*66)/5;
						    
						    
								//~ }
								?>
						    <div id="s_rating_long_wrap_host">
							    <div class="s_rating_long"><div class="s_rating_long_name_host">Reward Program</div><div class="s_rating_long_value_wrap">
								<div class="s_rating_long_value" style="width:<?php echo $rewardrates_width;?>px" title="4.88"></div></div>
								</div>
								
								
								<div class="s_rating_long"><div class="s_rating_long_name_host">Payout</div><div class="s_rating_long_value_wrap"><div class="s_rating_long_value" style="width:<?php echo $payrating_width;?>px" title="4.97"></div></div>
								</div>
								
								
								<div class="s_rating_long"><div class="s_rating_long_name_host">Referral Commision</div><div class="s_rating_long_value_wrap"><div class="s_rating_long_value" style="width:<?php echo $ratecommisionss_width;?>px" title="4.97"></div></div>
								</div>
								
								
								<div class="s_rating_long"><div class="s_rating_long_name_host">Support</div><div class="s_rating_long_value_wrap"><div class="s_rating_long_value" style="width:<?php echo $supportratnig_width;?>px" title="4.97"></div></div></div></div>
								</div> 	
											
						</div>
				</div>
	
	<?php /*********************************************table end***************************************************************************/?>
	
	<div class="tags"><?php the_listing_tags( '<span>' . __( 'Tags:', APP_TD ) . '</span> ' ); ?></div>
	<div class="added" style="display:none;"><?php _e( 'Updated:', APP_TD ); ?> <span class="date updated"><?php the_modified_time('M j, Y'); ?></span></div>

	<?php va_the_files_list(); ?>

	<div id="listing-tabs">
		<div class="tabs">
			<a id="overview-tab" class="active-tab rounded-t first" href="#overview"><?php _e( 'Description', APP_TD ); ?></a>
			<a id="reviews-tab" class="rounded-t" href="#reviews"><?php _e( 'Affiliate Reviews', APP_TD ); ?></a>
			<a id="paymentproof-tab" class="rounded-t" href="#paymentproof"><?php _e( 'Payment Proofs', APP_TD ); ?></a>
			<a id="questions-tab" class="rounded-t" href="#questions"><?php _e( 'Questions & suggestions', APP_TD ); ?></a>

			<br class="clear" />
		</div>

		<section id="overview" itemprop="description">
			<?php appthemes_before_post_content( VA_LISTING_PTYPE ); ?>
			<?php the_content(); ?>
			<?php appthemes_after_post_content( VA_LISTING_PTYPE ); ?>
		</section>

		<section id="reviews">
			<?php get_template_part( 'reviews', 'listing' ); ?>
		</section>
		
		<section id="paymentproof">
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
<?php  
		     $paymentprooof = get_comment_meta($review->comment_ID,'payproofimage', true);
					$url = $paymentprooof;
					@ $file = file_get_contents($url); // to get file
					$name1 = basename($url); // to get file name
					$ext = pathinfo($url, PATHINFO_EXTENSION); // to get extension
					$name2 =pathinfo($url, PATHINFO_FILENAME); //file name without extension
		  ?>
		      <?php if($ext){ ?>
			  
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
				<?php  
		     $paymentprooof = get_comment_meta($review->comment_ID,'payproofimage', true);
			        $url = $paymentprooof;
					@ $file = file_get_contents($url); // to get file
					$name1 = basename($url); // to get file name
					$ext = pathinfo($url, PATHINFO_EXTENSION); // to get extension
					$name2 =pathinfo($url, PATHINFO_FILENAME); //file name without extension
		  ?>
		      <?php if($ext){ ?>
		      <div class="payproof-image"><img src="<?php echo $paymentprooof; ?>" ></div>
			  <?php } ?>
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
<?php } ?>
<?php if ( get_current_user_id()) { ?>
	<?php appthemes_load_template( 'form-review-reply.php' ); ?>
<?php } ?>


		</section>
		
		<section id="questions">
		<?php comments_template(); ?>
		</section>
	</div>

	<div class="clear"></div>

	<div class="section-head head-tab-show-1">
		<a id="add-review" name="add-review"></a>
		<h2 id="left-hanger-add-review"><?php _e( 'Add Your Review', APP_TD ); ?></h2>
	</div>
   <div class="form_tab_show-1">

	<?php if ( $review = va_get_user_review( get_current_user_id(), get_the_ID() ) ) : ?>

		<?php if ( '1' !== $review->comment_approved ) { ?>
			<p>
				<?php _e( 'Your review is awaiting moderation.', APP_TD ); ?>
			</p>
		<?php } else { ?>
			<p>
				<?php _e( 'You have already reviewed this listing.', APP_TD ); ?>
			</p>
		<?php } ?>

	<?php elseif ( va_user_can_add_reviews() ) : ?>
		<?php appthemes_load_template( 'form-review.php' ); ?>
	<?php elseif ( get_current_user_id() == get_the_author_meta('ID') ) : ?>
		<p>
			<?php _e( "You can't review your own listing.", APP_TD ); ?>
		</p>
	<?php elseif ( !is_user_logged_in() ) : ?>
		<p>
			<?php
				$login_url = wp_login_url( get_permalink() );
				$register_url = add_query_arg( 'redirect_to', urlencode( get_permalink() ), appthemes_get_registration_url() );
				printf( __( 'Please <a href="%1$s">login</a> or <a href="%2$s">register</a> to add your review.', APP_TD ), $login_url, $register_url );
			?>
		</p>
	<?php else : ?>
		<p>
			<?php _e( 'Reviews are closed.', APP_TD ); ?>
		</p>
	<?php endif; ?>
	</div>
		<div class="clear"></div>
	<?php /* <div class="section-head head-tab-show-2">
		<a id="add-query" name="addquery"></a>
		<h2 id="left-hanger-add-review"><?php _e( 'Questions & Suggestions', APP_TD ); ?></h2>
	</div> */?>
     <?php/*  <div class="form_tab_show-2">
	    <?php if ( $review = va_get_user_review( get_current_user_id(), get_the_ID() ) ) : ?>
	<?php elseif ( !is_user_logged_in() ) : ?>
		<p>
			<?php
				$login_url = wp_login_url( get_permalink() );
				$register_url = add_query_arg( 'redirect_to', urlencode( get_permalink() ), appthemes_get_registration_url() );
				printf( __( 'Please <a href="%1$s">login</a> or <a href="%2$s">register</a> to add your Questions.', APP_TD ), $login_url, $register_url );
			?>
		</p>
	<?php else : ?>
		<p>
	
						<form action="" method="post" class="question-form">
			<div ><textarea name="" style="height: 150px;" id=""></textarea></div>
			<div ><input name="submit" type="submit" id="s_submit" tabindex="5" value="Submit" style="margin-top: 10px;"></div>
    </form>
		</p>
	<?php endif; ?>
         	   
	   
	   
	   
	   
	   
	   </div>*/?>
</article>

</div><!-- /#main -->
<?php } ?>
<?php //$users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
//echo $users." members so far"; ?>
<div id="sidebar">
<?php get_sidebar( 'single-listing' ); ?>
</div>
<style>
.section-head{
cursor: pointer;	
}
.section-head{
margin: 0 0 10px 0 !important;	
}
.form_tab_show-1,.form_tab_show-2{
    margin: 0 0 15px 0;	
}
</style>
<script>
jQuery( document ).ready(function() {
jQuery('.form_tab_show-1').hide();
jQuery( ".head-tab-show-1" ).click(function() {	
jQuery('.form_tab_show-1').toggle("slow");
});
jQuery('#wc-comment-header').text("Questions & suggestions");
});
</script>
<style>
.wc-toggle,.wc-comment-link,.wc-comment-title{
display:none !important;	
}
.s_rating_long_name {
    float: left;
    width: 53px;
}
.s_rating_long_value_wrap {
    float: left;
    width: 66px;
    height: 9px;
    border: 1px solid #7ac7ff;
    margin-top: 3px;
}
.s_rating_long_value {
    float: left;
    height: 9px;
    background: #7ac7ff;
}
.s_rating_long {
    overflow: hidden;
    margin: 5px 0;
}
#s_rating_long_wrap {
    margin-bottom: 20px;
}
#s_showrating {
    margin-left: 12px;
}
#s_rating_overall_wrap {
    margin-bottom: 20px;
}
.s_rating_overall_name {
    float: left;
    width: 43px;
}
.s_rating_overall_value_wrap {
    float: left;
    width: 76px;
    height: 9px;
    border: 1px solid #7ac7ff;
    margin-top: 3px;
}
.s_rating_overall_value {
    float: left;
    height: 9px;
    background: #7ac7ff;
}
.s_overall_num {
    color: #ff3600;
    float: left;
    margin-left: 5px;
}
.s_rating_overall_name span {
    color: #ff3600;
    font-weight: bold;.s_rating_overall
}
.s_comment_ratings_list_label {
    /*float: left;*/
    color: #999;
    margin-right: 5px;
    font-weight: bold;
	    font-size: 13px;
}
.s_other_ratings_list {
    margin-top: 10px;
}
#s_rating_overall_wrap,#s_rating_long_wrap {
    width: 70%;
    margin: auto;
}
.click-able-review{
font-style: normal;
text-transform: capitalize;
color: #787878;
text-decoration: none;
font-weight: bold;
}
#s_showrating_host{
width:100%;	
}
.s_rating_long_name_host{
width:120px;	
    float: left;
}
#s_rating_long_wrap_host{
margin: 0 15px 0 15px;	
}
.wc-comment-label{
display:none !important;	
}
#wpcomm .wc-blog-subscriber > .wc-comment-right .wc-comment-author, #wpcomm .wc-blog-subscriber > .wc-comment-right .wc-comment-author a {
    color: #3caae0 !important;
}
#wpcomm .wc-blog-contributor > .wc-comment-right .wc-comment-author, #wpcomm .wc-blog-contributor > .wc-comment-right .wc-comment-author a {
    color: #3caae0 !important;
}
</style>

<script>
jQuery( document ).ready(function() {
jQuery( ".click-able-review" ).click(function() {		
jQuery('#reviews-tab').addClass('active-tab');
jQuery('#reviews').show();	
jQuery('#overview-tab').removeClass('active-tab');
jQuery('#overview').hide();
});
});

</script>