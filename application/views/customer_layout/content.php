<?php

switch ($pageName) {
    case "Home":
        include ("contents/home.php");
        break;
    case "LOGIN":
        include ("contents/login-page.php");
        break;
    case "REGISTER":
        include ("contents/signup-couple.php");
        break;
    case "PROFILE":
        include ("contents/customer-profile.php");
        break;
    case "CONTACTUS":
        include ("contents/contact-us.php");
        break;           
    case "RESTAURANTS":
        include ("contents/restaurant.php");
        break;
    case 'SEARCHRESTAURANTS':
        include ("contents/restaurant.php");
        break;                
    case "ABOUT":
        include ("contents/about-us.php");
        break;
    case "ABOUTUS":
        include ("contents/aboutus.php");
        break;
    case "TERMS":
        include ("contents/terms.php");
        break;
    case "RESTAURANTLIST":
        include ("contents/restaurant-list.php");
        break;   
    case "RESTAURANTDETAILS":
        include ("contents/restaurant-details.php");
        break;
    case "FAQ":
        include ("contents/faq.php");
        break;
    case "PRICINGPLAN":
        include ("contents/pricing-plan.php");
        break;
    case "SIGNUPVENDOR":
        include ("contents/signup-vendor.php");
        break;
    case "SHOPCHECKOUT":
        include ("contents/shop-checkout.php");
        break;
    case "VENDORPROFILE":
        include ("contents/vendor-profile.php");
        break;   
    case "CONFIRMPAYMENTPAGE":
        include ("contents/payment.php");
        break;    
}
?>