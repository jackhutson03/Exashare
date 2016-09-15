<?php global $va_options; ?>
<div id="main">

<?php do_action( 'appthemes_notices' ); ?>


<div class="section-head">
	<h1>Add Your Affiliate Network/Program</h1>
</div>
<div id="submit-status"></div>
<div class="add-net-line">Thank you for your interest in adding your affiliate network/program to Affpaying.com. Please fill out the following form and submit it, someone will be in touch with you shortly</div>


<div class="form-shoe">
<form id="create-listing" enctype="multipart/form-data" method="post" action="">

<fieldset id="essential-fields">
	<div class="form-field">
	<div class="form-field-1">
		<label>
			Affiliate Network Name
			<input id="networkname" name="post_title" type="text" value="" class="required" required />
		</label>
	</div>
	<span class="and-form">& </span>
	<div class="form-field-1">
		<label>
			Affiliate Network URL
			<input id="networkurl" name="networkurl" type="text" value="" class="required" required />
		</label>
	</div>
	</div>
	
	<div class="form-field">
		<label>
			Email
			<input id="Email" name="email" type="text" value="" class="required" required />
		</label>
	</div>
	
	<div class="form-field">
		<label>
			Message
			<textarea id="message" name="post_content" type="text" value="" class="required" required></textarea>
		</label>
	</div>
	
	
	<div class="form-field">
	<div class="form-field-1">
		<label>
			Phone number
			<input id="phone-number" name="phonenumber" type="text" value="" class="" required />
		</label>
	</div>
	<span class="and-form">& </span>
	<div class="form-field-1">
		<label>
			AIM screen name
			<input id="aimname" name="aimname" type="text" value="" class="" required />
		</label>
	</div>
	</div>
	
<div class="form-field">
		<label>
			Facebook
			<input id="facebook-offers" name="facebook" type="text" value="" class="required" required />
		</label>
	</div>
	
	<div class="form-field">
		<label>
			Twitter
			<input id="twitter-offers" name="twitter" type="text" value="" class="required" required />
		</label>
	</div>
	<div class="form-field">
		<label>
			Skype
			<input id="Skype-offers" name="skype" type="text" value="" class="required" required />
		</label>
	</div>
</fieldset>


 <fieldset id="category-fields">
	<div class="featured-head"><h3><?php printf( _n( 'Network Category', 'Network Categories', $included_categories, APP_TD ), $included_categories ); ?></h3></div>

	<div class="form-field" id="categories" <?php echo isset( $included_categories ) ? 'data-category-limit="' . esc_attr( $included_categories ) .'"' : '' ; ?>>
		<?php

		if ( !isset( $included_categories ) || $categories_locked ) {
			$label = __( 'Categories', APP_TD );
		} else if ( $included_categories == 0 ) {
			$label = __( 'Categories (choose unlimited categories)', APP_TD);
		} else {
			$label = sprintf( _n( 'Category (choose %d category)', 'Categories (choose %d categories)', $included_categories, APP_TD ), $included_categories );
		}

		va_get_edit_categories( $listing, $label, VA_LISTING_CATEGORY, $categories_locked );
		?>
	</div>

	<div id="custom-fields">
	<?php
	if ( !empty( $listing->categories ) ) {
		the_files_editor( $listing->ID, __( 'Listing Files', APP_TD ) );

		va_listing_render_form( $listing->ID, $listing->categories );
	}
	?>
	</div>
</fieldset> 
	<div class="form-field">
	<div class="form-field-1">
		<label>
			
			<input id="check-cpa" name="type-cpa" type="checkbox" value="1" class="hoat-ima"  />
			Network Type CPA
		</label>
	</div>
	<div class="form-field-1">
		<label>
		
			<input id="check-hosting" name="type-host" type="checkbox" value="2" class="hoat-ima"  />
			video,Image hosting
		</label>
	</div>
	</div>
	
	<div class="form-cpa">
	<div class="form-field">
		<label>
			How many offers in your network? (50+, 100+, etc)
			<input id="how-offers" name="manyoffers" type="text" value="" class="required" />
		</label>
	</div>
	
	<div class="form-field">
		<label>
			Commission Type (CPA, CPL, CPI, CPS ...)
			<input id="Commission-types" name="commission" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Minimum Payment ($50, $100, etc)
			<input id="minimum-payment" name="minimumpayment" type="text" value="" class="required"  />
		</label>
	</div>
	<div class="form-field">
		<label>
			Payment Frequency (net-30, net-15, weekly, etc)
			<input id="payment-frequency" name="paymentfrequency" type="text" value="" class="required"  />
		</label>
	</div>
	<div class="form-field">
		<label>
			Payment Method (check, paypal, wire, etc)
			<input id="payment-method" name="paymentmethod" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Referral Commission (2%, 5%, etc)
			<input id="referral-commission" name="referralcommission" type="text" value="" class="required"  />
		</label>
	</div>
		<div class="form-field">
		<label>
			Affiliate Tracking Software (HasOffers, CAKE, In-house ...)
			<input id="affiliate-tracking" name="affiliatetracking" type="text" value="" class="required" />
		</label>
	</div>
	
	<div class="form-field">
		<label>
			Tracking Link
			<input id="Tracking-Link" name="trackinglink" type="text" value="" class="required"  />
		</label>
	</div>
	</div>
	
	<div class="hosting-show">
	  <div class="form-field">
		<label>
			Maximum File size 
			<input id="maximum-file-size " name="filesize" type="text" value="" class="required" />
		</label>
	</div>
	
	<div class="form-field">
		<label>
			Storage Size 
			<input id="storage-size " name="storagesize" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Uploading speed 
			<input id="uploading-speed" name="uploadingspeed" type="text" value="" class="required"  />
		</label>
	</div>
	<div class="form-field">
		<label>
			Downloading speed
			<input id="downloading-speed" name="downspeed" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			File Types Supported 
			<input id="file-supported " name="filesupported" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Reward Program
			<input id="reward-program" name="reward" type="text" value="" class="required" />
		</label>
	</div>
		<div class="form-field">
		<label>
			Uploading Methods
			<input id="Uploading-Methods" name="up-methods" type="text" value="" class="required" />
		</label>
	</div>
	
	<div class="form-field">
		<label>
			payment per 1000 view/downloads
			<input id="viewper-down" name="viewperdown" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Minimum Payment ($50, $100, etc)
			<input id="minimum-payment" name="hostminimumpayment" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Payment Frequency (net-30, net-15, weekly, etc)
			<input id="payment-frequency" name="hostpaymentfrequency" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Payment Method (check, paypal, wire, etc)
			<input id="payment-method" name="hostpaymentmethod" type="text" value="" class="required" />
		</label>
	</div>
	<div class="form-field">
		<label>
			Referral Commission (2%, 5%, etc)
			<input id="referral-commission" name="hostreferralcommission" type="text" value="" class="required" />
		</label>
	</div>
	
	
	</div>	
	
<fieldset>
<div class="form-field">
		<label>
		    Upload Affiliate Network Image
			 <input type="file" name="file" /> 
		</label>
	</div>
</fieldset> 
<fieldset>
	<div class="form-field"><input type="submit" name="submit" value="Submit"></div>
</fieldset>
</form>
</div>
</div><!-- #content -->
<script>
 jQuery( document ).ready(function() {
	aftersubmit();


 });

function  aftersubmit() {
  jQuery(".hosting-show").hide(); 
  jQuery(".form-cpa").hide(); 
jQuery( "#check-hosting" ).click(function() {
  if(jQuery("#check-hosting").is(':checked')){
	 jQuery(".form-cpa").hide();
    jQuery(".hosting-show").show();  // checked
	//jQuery('#check-hosting').prop('checked', true);
    jQuery('#check-cpa').prop('checked', false);
}else{
	jQuery(".hosting-show").hide(); 
	jQuery(".form-cpa").hide();
	
}
});
jQuery( "#check-cpa" ).click(function() {
  if(jQuery("#check-cpa").is(':checked')){
	 jQuery(".form-cpa").show();
    jQuery(".hosting-show").hide();  // checked
	jQuery('#check-hosting').prop('checked', false);
}else{
	jQuery(".hosting-show").hide(); 
	jQuery(".form-cpa").hide();
	
}

});
};

 
  jQuery("#create-listing").on('submit',(function(e){
    e.preventDefault();
    jQuery('#loader-icon').show();
    jQuery.ajax({
     url: "http://webappsample.com/demo/exashare/wp-content/themes/vantage/create_listing_submit_form.php",
     type: "POST",
     data:  new FormData(this),
     contentType: false,
     cache: false,
     processData:false,
       success: function(data){
       jQuery("#submit-status").show();
       jQuery("#submit-status").html("Network/Program Added Succesfully");
	   jQuery('#loader-icon').hide();
	    document.getElementById("create-listing").reset();
	    aftersubmit();
			setTimeout(function(){
			jQuery("#submit-status").html("");
			}, 2000);

	     
       },
     });
  })); 

 
 
</script>
<style>
#submit-status{
border: 1px solid #38C838;
background: #CFC url(images/icon-tick.png) no-repeat 12px 50%;
padding-left: 20px;
padding-right: 20px;
display:none; 
margin: 0 0 20px 0;
}
</style>