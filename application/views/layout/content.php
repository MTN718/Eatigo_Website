<div class="content-wrapper">

    <?php
    switch ($pageName) {
        case "USERMANAGE":
            include ("contents/usermanage.php");
            break;		
        case "WELCOMEMANAGE":
			include ("contents/welcomemanage.php");
			break;
		case "CATEGORYMANAGE":
			include ("contents/categorymanage.php");
			break;
		case "ITEMMANAGE":
			include ("contents/itemmanage.php");
			break;
		case "ADDITEM":
			include ("contents/additem.php");
			break;
		case "EDITITEM":
			include ("contents/edititem.php");
			break;
		case "ORDERMANAGE":
			include ("contents/ordermanage.php");
			break;
		case "BANNERMANAGE":
			include ("contents/bannermanage.php");
			break;
		case "COLORMANAGE":
			include ("contents/colormanage.php");
			break;
		case "SIZEMANAGE":
			include ("contents/sizemanage.php");
			break;
		case "EDITCATEGORY":
			include ("contents/editcategory.php");
			break;
        case "EDITWELCOME":
            include ("contents/editwelcome.php");
			break;
		case "EDITBATEGORY":
			include ("contents/editbategory.php");
			break;
		case "EDITCOUNTRY":
			include ("contents/editcountry.php");
			break;
		case "EDITDEPARTMENT":
			include ("contents/editdepart.php");
			break;
		case "BANNERLINKMANAGE":
			include ("contents/bannerlink.php");
			break;
    }
    ?>
</div>