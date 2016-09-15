<?php 
        global $wpdb; 
		$postID=get_the_ID() ;
		$netcheck = get_post_meta( get_the_ID(), 'networktypecheck', true );
		$hostypecheck = get_post_meta( get_the_ID(), 'hosttypecheck', true );
?>		

<form id="add-review-form" action="<?php echo site_url( 'wp-comments-post.php' ); ?>" method="post" enctype="multipart/form-data">
<div class="s_comment_margin">
<?php if($netcheck){ ?>
<div class="s_rating_sel">
<span class="s_rating_sel_label">Offers <span class="s_red_req">*</span></span>
<div class="s_rating_sel_value">
<select name="offers_rating">
						<option value="select">Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select></div></div>
<?php } ?>
<?php if($hostypecheck){ ?>
					<div class="s_rating_sel">
                   <span class="s_rating_sel_label">Reward<span class="s_red_req">*</span></span>
                  <div class="s_rating_sel_value">
                  <select name="reward">
						<option value="select">Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select></div></div>
					  
		<?php } ?>			  
					  
					  
					  
					  <div class="s_rating_sel">
					  <span class="s_rating_sel_label">Payout <span class="s_red_req">*</span></span>
					  <div class="s_rating_sel_value">
					  <select name="payout_rating">
						<option value="select" >Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select></div></div>
					  
					  <?php if($hostypecheck){ ?>
					  <div class="s_rating_sel"><span class="s_rating_sel_label">Commision <span class="s_red_req">*</span></span><div class="s_rating_sel_value"><select name="referral_commision">
						<option value="select" >Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select></div></div>
					  <?php } ?>
					  
					  
					  
					  
					    <?php if($netcheck){ ?>
					  <div class="s_rating_sel"><span class="s_rating_sel_label">Tracking <span class="s_red_req">*</span></span><div class="s_rating_sel_value"><select name="tracking_rating">
						<option value="select" >Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select></div></div>
					  <?php } ?>
					  
					  
					  
					  <div class="s_rating_sel"><span class="s_rating_sel_label">Support <span class="s_red_req">*</span></span><div class="s_rating_sel_value"><select name="support_rating">
						<option value="select">Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					  </select></div></div></div>
	<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
	<?php wp_comment_form_unfiltered_html_nonce(); ?>
	<input type="hidden" name="comment_type" value="<?php echo VA_REVIEWS_CTYPE; ?>" />
	<label>
		<?php _e( 'Rating', APP_TD ); ?> <span class="label-helper">(<?php _e( 'required', APP_TD ); ?>)</span>
        <div id="review-rating"></div>
	</label>
    
    <label>
		<?php _e( 'Review', APP_TD ); ?> <span class="label-helper">(<?php _e( 'required', APP_TD ); ?>)</span>
        <textarea name="comment" id="review_body" class="required"></textarea>
	</label>
    
	    <label>
		<span class="label-helper payproof">Upload your payment screenshot!</span>
          <input type="file" name="payproof" value="" />
	</label>
    <input type="submit" value="<?php esc_attr_e( 'Submit Review', APP_TD ); ?>" />
</form>
