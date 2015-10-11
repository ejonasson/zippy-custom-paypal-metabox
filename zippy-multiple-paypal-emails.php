<?php
/*
    Plugin Name: [Zippy Courses] Add Multiple Paypal Emails
    Plugin URI: http://www.zippycourses.com
    Description: Add product-specific Paypal email addresses
    Author: Zippy Courses
    Version: 1.0.0
    Author URI: http://www.zippycourses.com
    Text Domain: zippy-courses
    License: None
 */

class ZippyCourses_MultiplePaypalEmails
{
    private static $instance;

    public $directory;

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        $this->directory = plugin_dir_path(__FILE__);

        add_filter('zippy_metaboxes', array($this, 'metaboxes'));
        add_filter('zippy_paypal_email_address', array($this, 'customPaypalEmail'), 10, 2);
    }

    public function metaboxes($metaboxes)
    {
        $dir = $this->directory . '/views/metaboxes/';
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $key => &$file) {
            if (!is_dir($dir . $file)) {
                $file = $dir . $file;
            } else {
                unset($files[$key]);
            }
        }
        return array_merge($metaboxes, $files);
    }

    public function customPaypalEmail($business, $product)
    {
        $product_id = $product->id;
        $paypal_email = get_post_meta($product_id, '_zippy_paypal_email', true);
        if ($paypal_email) {
            return $paypal_email;
        }
        return $business;
    }

}
ZippyCourses_MultiplePaypalEmails::instance();
