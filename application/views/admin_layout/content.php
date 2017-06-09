<div class="content-wrapper">

    <?php
    switch ($pageName) {
        case "Dashboard":
            include ("contents/dashboard.php");
            break;             
        case "Users":
            include ("contents/users.php");
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
        case "EditCountry":
            include ("contents/edit_country.php");
            break;
    }
    ?>
</div>