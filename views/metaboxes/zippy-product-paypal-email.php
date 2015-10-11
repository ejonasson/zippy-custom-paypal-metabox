<?php
/*
Id: zippy-product-paypal-email
Name: Paypal Email Address
Post Types: product
Fields: _zippy_paypal_email
Context: zippy_product_advanced_main
Priority: default
Version: 1.1.0
*/

$zippy = Zippy::instance();
?>
<p class="description">
    <?php _e('Add a custom Paypal email for this product. Payments for this product will use this email address. Works only with Paypal.', ZippyCourses::TEXTDOMAIN); ?>
</p>
<input type="text" name="_zippy_paypal_email" class="zippy-paypal-email" value = "
<?php echo $_zippy_paypal_email; ?>"
>