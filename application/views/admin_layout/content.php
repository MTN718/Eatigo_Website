<div class="content-wrapper">

    <?php
    switch ($pageName) {
        case "Dashboard":
            include ("contents/dashboard.php");
            break;             
        case "Users":
            include ("contents/users.php");
            break;
        case "Restaurants":
            include ("contents/restaurants.php");
            break;
        case "Discounts":
            include ("contents/discounts.php");
            break;
        case "Countrys":
            include ("contents/countrys.php");
            break;
        case "Facilitys":
            include ("contents/facilitys.php");
            break;
        case "Languages":
            include ("contents/languages.php");
            break;
        case "Atmospheres":
            include ("contents/atmospheres.php");
            break;
        case "Categorys":
            include ("contents/categorys.php");
            break;
        case "Citys":
            include ("contents/citys.php");
            break;
        case "Currencys":
            include ("contents/currency.php");
            break;
        case "Subcategorys":
            include ("contents/subcategorys.php");
            break;
        case "Faq":
            include ("contents/faq.php");
            break;
        case "Terms":
            include ("contents/terms.php");
            break;
        case "Contactus":
            include ("contents/contactus.php");
            break;
        case "Memberships":
            include ("contents/memberships.php");
            break;
        case "Transactions":
            include ("contents/transaction.php");
            break;
        case "Requests":
            include ("contents/reports.php");
            break;
        case "EditCountry":
            include ("contents/edit_country.php");
            break;
        case "EditFacility":
            include ("contents/edit_facility.php");
            break;
        case "EditLanguage":
            include ("contents/edit_language.php");
            break;
        case "EditAtom":
            include ("contents/edit_atom.php");
            break;
        case "EditCategory":
            include ("contents/edit_category.php");
            break;
        case "EditCurrency":
            include ("contents/edit_currency.php");
            break;
        case "EditSubCategory":
            include ("contents/edit_subcategory.php");
            break;
        case "EditCity":
            include ("contents/edit_city.php");
            break;
    }
    ?>
</div>