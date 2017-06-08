<?php

header('Content-Type: application/json');
defined('BASEPATH') OR exit('No direct script access allowed');

class WebserviceController extends CI_Controller {

    public function connectDB() {
        $this->database = $this->load->database();
    }

    function makeFailResponse() {
        $channel = array();
        $channel["response"] = 400;
        echo json_encode($channel);
    }

    function makeSuccessResponse() {
        $channel = array();
        $channel["response"] = 200;
        echo json_encode($channel);
    }

    function makeExpireResponse() {
        $channel = array();
        $channel["response"] = 401;
        echo json_encode($channel);
    }

    function sendUserData($data) {
        $profile = array();
        $profile["no"] = $data->no;
        $profile["firstname"] = $data->firstname;
        $profile["lastname"] = $data->lastname;
        $profile["email"] = $data->email;
        $profile["password"] = $data->password;
        $profile["pop"] = $data->pop;
        $profile["image"] = $data->image;

        $profile["response"] = 200;
        echo json_encode($profile);
    }
    
    public function onRegister() {
        if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['username']) && isset($_POST['password'])) {
            $password = $_POST['password'];
            $email = $_POST['username'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $imageFile = "";
            if (isset($_FILES['uploads']))
                $imageFile = $this->uploadImage($_FILES['uploads'], 7, 150, 150);
            $sql = " select * from users where email='" . $email . "'";
            $this->connectDB();
            $resultArray2 = $this->db->query($sql)->result();
            $num = count($resultArray2);
            if ($num > 0) {
                $this->makeFailResponse();
                return;
            } else {
                $sql = "INSERT INTO users(firstname,lastname,email,password,pop,image,type)
				VALUES (
					'" . $fname . "',"
                        . "'" . $lname . "',"
                        . "'" . $email . "','" . $password . "','25','" . $imageFile . "','0')";
                $resultArray2 = $this->db->query($sql);
                $id = $this->db->insert_id();
                $sql1 = "select * from users where no='" . $id . "'";
                $dataArray = $this->db->query($sql1)->result();
                $data = $dataArray[0];
                $this->sendUserData($data);
            }
        } else {
            $this->makeFailResponse();
        }
    }

    public function onLogin() {
        if (isset($_REQUEST['user']) && isset($_REQUEST['password'])) {
            $user = $_REQUEST['user'];
            $pw = $_REQUEST['password'];

            $sql = " select * from users where password='" . $pw . "' and email='" . $user . "'";
            $this->connectDB();
            $resultArray2 = $this->db->query($sql)->result();

            $num = count($resultArray2);
            if ($num > 0) {
                $data = $resultArray2[0];
                $this->sendUserData($data);
            } else
                $this->makeFailResponse();
        }
        else {
            $this->makeFailResponse();
        }
    }

    public function onFacebookLogin() {
        if (isset($_REQUEST['user']) && isset($_REQUEST['password'])) {
            $user = $_REQUEST['user'];
            $pw = $_REQUEST['password'];
            $name = $_REQUEST['name'];

            $sql = " select * from users where pw='" . $pw . "' and email='" . $user . "' and type=1";
            $this->connectDB();
            $resultArray2 = $this->db->query($sql)->result();

            $num = count($resultArray2);
            if ($num > 0) {
                $data = $resultArray2[0];
                $this->sendUserData($data);
            } else {
                $sql = "INSERT INTO users(user,pw,email,type)
				VALUES (
					'" . $name . "',"
                        . "'" . $pw . "',"
                        . "'" . $user . "','1')";
                $resultArray2 = $this->db->query($sql);
                $id = $this->db->insert_id();
                $sql1 = "select * from users where no='" . $id . "'";
                $dataArray = $this->db->query($sql1)->result();
                $data = $dataArray[0];
                $this->sendUserData($data);
            }
        } else {
            $this->makeFailResponse();
        }
    }

    public function onLoadWelcome()
    {
        $sql = "select * from welcome";

        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();        
        $jsonResult['welcome'] = $result;
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);        
    }
    public function onLoadCategory() {
        $sql = "select * from category";

        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();        
        $jsonResult['category'] = $result;
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onSendCode() {
        $email = $_REQUEST['email'];
        $sql = "select * from users where email='" . $email . "'";
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        if (count($result) > 0) {
            $digits = 4;
            $code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            mail($email, 'Verificaton Code', $code);
            $jsonOut = array();
            $jsonOut['code'] = $code;
            $jsonOut['response'] = 200;
            echo json_encode($jsonOut);
        } else {
            $this->makeFailResponse();
        }
    }

    public function onUpdatePassword() {
        $password = $_REQUEST['password'];
        $email = $_REQUEST['email'];
        $this->connectDB();
        $sql = "update users set pw='" . $password . "' where email='" . $email . "'";
        $resultArray2 = $this->db->query($sql);
        $jsonOut = array();
        $jsonOut['response'] = 200;
        echo json_encode($jsonOut);
    }

    public function onLoadFilter() {
        $category = $_REQUEST['category'];
        $this->connectDB();
        /*
          $sql = "select A.*,B.department as depart from category as A left join branch as B on A.depart=B.no where order by A.category asc";
          $resultCategory = $this->db->query($sql)->result();
          $catArray = array();
          for ($j = 0;$j < count($resultCategory);$j++)
          {
          $dataItemCategory = $resultCategory[$j];
          $dataCategory = array();
          $dataCategory['no'] = $dataItemCategory->no;
          $dataCategory['name'] = $dataItemCategory->category;
          $dataCategory['image'] = $dataItemCategory->image;
          $dataCategory['depart'] = $dataItemCategory->depart;
          $catArray[$j] = $dataCategory;
          }
          $data['category'] = $catArray; */

        $sql = "select brand from items where category='" . $category . "' and brand !='' group by brand";
        $resultCategory = $this->db->query($sql)->result();
        $data['brands'] = $resultCategory;


        $sql = "select color from items where category='" . $category . "' and color !='' group by brand";
        $resultCategory = $this->db->query($sql)->result();
        $j = 0;
        $catArray = array();
        foreach ($resultCategory as $color) {
            $colorArray = explode(",", $color->color);
            foreach ($colorArray as $colorNo) {
                $sql = "select * from colors where no='" . $colorNo . "'";
                $result = $this->db->query($sql)->result();
                if (count($result) > 0) {
                    $dataItemCategory = $result[0];
                    $dataCategory = array();
                    $isAdded = 0;
                    for ($k = 0; $k < $j; $k++) {
                        $dt = $catArray[$k];
                        if ($dt['no'] == $dataItemCategory->no) {
                            $isAdded = 1;
                        }
                    }
                    if ($isAdded == 0) {
                        $dataCategory['no'] = $dataItemCategory->no;
                        $dataCategory['name'] = $dataItemCategory->name;
                        $catArray[$j] = $dataCategory;
                        $j++;
                    }
                }
            }
        }
        $data['colors'] = $catArray;
        $data['response'] = 200;
        echo json_encode($data);
    }

    public function onLoadPopular() {
        $sql = "select A.*,B.category as cname from items as A left join category as B on A.category=B.no order by A.createdate desc limit 0,10";

        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['news'] = $this->makeJsonItems($result);

        $sql = "select * from branch order by department asc";
        $result = $this->db->query($sql)->result();

        $outArray = array();
        for ($i = 0; $i < count($result); $i++) {
            $dataItem = $result[$i];
            $data = array();
            $data['no'] = $dataItem->no;
            $data['name'] = $dataItem->department;

            $sql = "select * from bategory where depart='" . $dataItem->no . "'";
            $resultBategory = $this->db->query($sql)->result();
            $batData = array();
            for ($k = 0; $k < count($resultBategory); $k++) {
                $batArray = array();
                $batArray['no'] = $resultBategory[$k]->no;
                $batArray['bategory'] = $resultBategory[$k]->bategory;
                $batArray['image'] = $resultBategory[$k]->image;
                $sql = "select A.*,B.bategory as depart from category as A left join bategory as B on A.depart=B.no where A.depart='" . $resultBategory[$k]->no . "' order by A.category asc";
                $resultCategory = $this->db->query($sql)->result();
                $catArray = array();
                for ($j = 0; $j < count($resultCategory); $j++) {
                    $dataItemCategory = $resultCategory[$j];
                    $dataCategory = array();
                    $dataCategory['no'] = $dataItemCategory->no;
                    $dataCategory['name'] = $dataItemCategory->category;
                    $dataCategory['image'] = $dataItemCategory->image;
                    $dataCategory['depart'] = $dataItemCategory->depart;
                    $catArray[$j] = $dataCategory;
                }
                $batArray['category'] = $catArray;
                $batData[$k] = $batArray;
            }
            $data['bategory'] = $batData;
            $outArray[$i] = $data;
        }

        $jsonResult['departs'] = $outArray;

        //Featured Category

        $sql = "select A.*,B.bategory as depart from category as A left join bategory as B on A.depart=B.no where A.feature='1' order by A.category asc";
        $resultCategory = $this->db->query($sql)->result();

        $catArray = array();
        for ($j = 0; $j < count($resultCategory); $j++) {
            $dataItemCategory = $resultCategory[$j];
            $dataCategory = array();
            $dataCategory['no'] = $dataItemCategory->no;
            $dataCategory['name'] = $dataItemCategory->category;
            $dataCategory['image'] = $dataItemCategory->image;
            $dataCategory['depart'] = $dataItemCategory->depart;
            $catArray[$j] = $dataCategory;
        }

        $jsonResult['featurecategory'] = $catArray;


        //Load Featured Items
        $sql = "SELECT t.*,c.category as cname FROM items as t 
				left join category as c on t.category=c.no where t.feature='1'";
        $result = $this->db->query($sql)->result();
        $jsonResult['featureitems'] = $this->makeJsonItems($result);


        //Load Weekly Top
        $sql = "SELECT COUNT(m.iid) as `buyitems`, t.*,c.category as cname FROM sellproduct as m LEFT JOIN items as t ON m.iid = t.no 
				left join category as c on t.category=c.no GROUP BY m.iid 	ORDER BY buyitems DESC LIMIT 10";
        $result = $this->db->query($sql)->result();
        $jsonResult['topseller'] = $this->makeJsonItems($result);
        //
        //Load Recommend

        $jsonResult['recommend'] = $this->makeJsonItems($result);

        $sql = "select * from banners";
        $result = $this->db->query($sql)->result();

        $jsonResult['banner1'] = $result[0]->banner1;
        $jsonResult['banner2'] = $result[0]->banner2;
        $jsonResult['banner3'] = $result[0]->banner3;
        $jsonResult['banner4'] = $result[0]->banner4;
        $jsonResult['banner5'] = $result[0]->banner5;
        $jsonResult['banner6'] = $result[0]->banner6;
        $jsonResult['banner7'] = $result[0]->banner7;
        $jsonResult['banner8'] = $result[0]->banner8;
        $jsonResult['banner9'] = $result[0]->banner9;
        $jsonResult['banner10'] = $result[0]->banner10;
        $jsonResult['banner11'] = $result[0]->banner11;
        $jsonResult['banner12'] = $result[0]->banner12;
        $jsonResult['banner13'] = $result[0]->banner13;

        $sql = "select * from bannerlink as A";
        $result = $this->db->query($sql)->result();

        $jsonResult['bannerlink1'] = $result[0]->link1;
        $jsonResult['bannerlink2'] = $result[0]->link2;
        $jsonResult['bannerlink3'] = $result[0]->link3;
        $jsonResult['bannerlink4'] = $result[0]->link4;


        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onUpdateProfile() {
        $no = $_POST['no'];
        $user = $_POST['user'];
        $address = "";
        $phone = "";
        if (isset($_POST['address']))
            $address = $_POST['address'];
        if (isset($_POST['phone']))
            $phone = $_POST['phone'];
        $this->connectDB();
        $date = new DateTime();
        $file_path = "";
        $photo_path = "";
        if (isset($_FILES['photo'])) {
            $filename = $date->getTimestamp() . "." . "png";
            $file_path = BASEPATH . '../images/item/' . $filename;
            $photo_path = "./images/item/" . $filename;
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $file_path)) {
                $file_path = "";
                $photo_path = "";
            }
        }
        $sql = "update users set user='" . $user . "',address='" . $address . "',phone='" . $phone . "' where no='" . $no . "'";
        if ($photo_path != "")
            $sql = "update users set user='" . $user . "',image='" . $photo_path . "',address='" . $address . "',phone='" . $phone . "' where no='" . $no . "'";
        $resultArray2 = $this->db->query($sql);

        $ss = "select * from users where no='" . $no . "'";
        $dataArr = $this->db->query($ss)->result();
        $data = $dataArr[0];
        $this->sendUserData($data);
    }

    public function onLoadItems() {
        $category = $_POST['category'];
        $count = $_POST['count'];
        $sql = "select A.*,B.category as cname from items as A left join category as B on A.category=B.no where A.category='" . $category . "' order by createdate desc limit " . $count . ",20";
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['items'] = $this->makeJsonItems($result);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onSearchItemsKeyword() {
        $keyword = $_REQUEST['keyword'];
        $categoryCount = $_REQUEST['categorycount'];
        $categoryArray = array();
        for ($i = 0; $i < $categoryCount; $i++) {
            $categoryArray[$i] = $_REQUEST['category' . $i];
        }

        $colorCount = $_REQUEST['colorcount'];
        $colorArray = array();
        for ($i = 0; $i < $colorCount; $i++) {
            $colorArray[$i] = $_REQUEST['color' . $i];
        }
        $min = $_REQUEST['minprice'];
        $max = $_REQUEST['maxprice'];

        $count = $_REQUEST['count'];

        //$whereSql = "where ";
        //if ($keyword != '')
        $whereSql = "where (A.name like '%" . $keyword . "%' or A.brand like '%" . $keyword . "%')";
        for ($i = 0; $i < $categoryCount; $i++) {
            if ($i == 0)
                $whereSql = $whereSql . " and ( A.brand = '" . $categoryArray[$i] . "'";
            if ($i == $categoryCount - 1) {
                $whereSql = $whereSql . " or A.brand= '" . $categoryArray[$i] . "' ";
                $whereSql = $whereSql . ") ";
            }
            if ($i > 0 && $i < $categoryCount - 1)
                $whereSql = $whereSql . " or A.category='" . $categoryArray[$i] . "' ";
        }
        for ($i = 0; $i < $colorCount; $i++) {
            if ($i == 0)
                $whereSql = $whereSql . " and ( A.color='" . $colorArray[$i] . "' ";
            if ($i == $colorCount - 1) {
                $whereSql = $whereSql . " or A.color like '%" . $colorArray[$i] . "%' ";
                $whereSql = $whereSql . ") ";
            }
            if ($i > 0 && $i < $colorCount - 1)
                $whereSql = $whereSql . " or A.color like '%" . $colorArray[$i] . "%' ";
        }
        if ($min != -1) {
            $whereSql = $whereSql . " and ( A.price > '" . $min . "' ) ";
        }
        if ($max != -1) {
            $whereSql = $whereSql . " and ( A.price < '" . $max . "' )";
        }

        $sql = "select A.*,B.category as cname from items as A left join category as B on A.category=B.no " . $whereSql . " order by createdate desc limit " . $count . ",20";

        //echo $sql;
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['items'] = $this->makeJsonItems($result);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onSearchItems() {
        $category = $_REQUEST['category'];
        $keyword = $_REQUEST['keyword'];
        $min = $_REQUEST['min'];
        $max = $_REQUEST['max'];
        $sql = "select A.*,B.category as cname from items as A left join category as B on A.category=B.no where A.price > '" . $min . "' and A.price < '" . $max . "' and  A.category='" . $category . "' order by createdate desc";
        if ($keyword != '') {
            $sql = "select A.*,B.category as cname from items as A left join category as B on A.category=B.no where A.price > '" . $min . "' and A.price < '" . $max . "' and A.name like '%" . $keyword . "%' and A.category='" . $category . "' order by createdate desc";
        }
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['items'] = $this->makeJsonItems($result);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }
    public function uploadImage($m_image, $index, $width = 320, $height = 420) {
        $this->connectDB();
        $upload_file = $m_image['tmp_name'];
        $path_parts = pathinfo($m_image['name']);
        if (($path_parts['basename'] == "") || ((strtolower($path_parts['extension']) != 'jpg') and ( strtolower($path_parts['extension']) != 'png'))) {
            return "";
        }
        $date = new DateTime();
        $name = $date->getTimestamp();
        $filename = $name . "_" . $index . "." . $path_parts["extension"];
        $m_imgPath = BASEPATH . '../images/item/' . $filename;
        if (is_uploaded_file($upload_file))
            move_uploaded_file($upload_file, $m_imgPath);
        $thumb_filename = '/images/item/' . $filename;
        $this->resizeThumbnailImage($m_imgPath, $m_imgPath, $width, $height);
        return $thumb_filename;
    }

    function resizeThumbnailImage($thumb_path, $org_image_path, $width = 320, $height = 420) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($org_image_path);
        $imageType = image_type_to_mime_type($imageType);

        $newImageWidth = $width;
        $newImageHeight = $height;
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($org_image_path);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($org_image_path);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($org_image_path);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $imagewidth, $imageheight);
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_path);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_path, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_path);
                break;
        }
        chmod($thumb_path, 0777);
        return $thumb_path;
    }
    
    public function onLoadItemInfo() {
        $uid = $_REQUEST['uid'];
        $iid = $_REQUEST['iid'];
        $this->connectDB();
        if ($uid != "-1") {
            $sql = "select * from favourite where uid='" . $uid . "' and iid='" . $iid . "'";
            $this->connectDB();
            $result = $this->db->query($sql)->result();
            $jsonResult = array();
            if (count($result) > 0) {
                $jsonResult['favourite'] = 1;
            } else
                $jsonResult['favourite'] = 0;
        } else
            $jsonResult['favourite'] = 0;

        //get reviews
        $sql = "select A.*,B.user as uname from reviews as A left join users as B on A.uid=B.no where iid='" . $iid . "'";
        $result = $this->db->query($sql)->result();
        $jsonResult['reviews'] = $result;

        //get sizes

        $sql = "select A.no as no,B.name as name from itemsize as A left join sizebase as B on A.sz=B.no where A.iid='" . $iid . "'";
        $result = $this->db->query($sql)->result();
        $jsonResult['sizes'] = $result;

        //get related
        $sql = "select * from items where no='" . $iid . "'";
        $resultItem = $this->db->query($sql)->result();
        $category = $resultItem[0]->category;

        $sql = "select  A.*,B.category as cname from items as A left join category as B on A.category=B.no where A.no!='" . $iid . "' and A.category='" . $category . "' limit 0,10";
        $result = $this->db->query($sql)->result();
        $jsonResult['related'] = $this->makeJsonItems($result);

        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onAddItemFavourite() {
        $uid = $_REQUEST['uid'];
        $iid = $_REQUEST['iid'];
        $sql = "INSERT INTO favourite(iid,uid)
				VALUES (
					'" . $iid . "',"
                . "'" . $uid . "')";
        $this->connectDB();
        $resultArray2 = $this->db->query($sql);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onRemoveItemFavourite() {
        $uid = $_REQUEST['uid'];
        $iid = $_REQUEST['iid'];
        $sql = "delete from favourite where uid='" . $uid . "' and iid='" . $iid . "'";
        $this->connectDB();
        $resultArray2 = $this->db->query($sql);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onDeleteOrder() {
        $oid = $_REQUEST['oid'];
        $sql = "update orders set status='4' where no='" . $oid . "'";
        $this->connectDB();
        $resultArray2 = $this->db->query($sql);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onUpdateOrderComplete() {
        $oid = $_REQUEST['oid'];
        $sql = "update orders set status='2' where no='" . $oid . "'";
        $this->connectDB();
        $resultArray2 = $this->db->query($sql);


        //send Email
        $adminInfo = $this->getAdminInfo();
        mail($adminInfo->email, 'Update Order Status', 'Order Completed.');

        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onLoadFavourites() {
        $uid = $_REQUEST['uid'];
        $sql = "select A.*,B.category as cname from favourite as C left join items as A on C.iid=A.no left join category as B on A.category=B.no where C.uid='" . $uid . "' order by C.no desc";

        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['items'] = $this->makeJsonItems($result);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onAddReview() {
        $oid = $_REQUEST['oid'];
        $star = $_REQUEST['star'];
        $uid = $_REQUEST['uid'];
        $comment = $_REQUEST['comment'];
        $this->connectDB();
        $sql = "select * from sellproduct where oid='" . $oid . "'";
        $resultItems = $this->db->query($sql)->result();
        for ($i = 0; $i < count($resultItems); $i++) {
            $iid = $resultItems[$i]->iid;
            $sql = "insert into reviews(iid,star,comment,uid) values ('" . $iid . "','" . $star . "','" . $comment . "','" . $uid . "')";
            $resultArray2 = $this->db->query($sql);
        }

        $sql = "update orders set status='3' where no='" . $oid . "'";
        $resultArray2 = $this->db->query($sql);

        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onAddOrder() {
        $uid = $_REQUEST['uid'];
        $cnt = $_REQUEST['count'];
        $price = $_REQUEST['price'];
        $itemArray = array();
        $sizeArray = array();
        for ($i = 0; $i < $cnt; $i++) {
            $itemArray[$i] = $_REQUEST['item' . $i];
            $sizeArray[$i] = $_REQUEST['size' . $i];
        }
        $address = $_REQUEST['address'];
        $payment = $_REQUEST['payment'];
        $lat = $_REQUEST['lat'];
        $lon = $_REQUEST['lon'];
        $date = new DateTime();
        $orderName = "OD" . $date->getTimestamp();

        $sql = "INSERT INTO orders(uid,name,address,status,payment,price,lat,lon)
				VALUES (
					'" . $uid . "',"
                . "'" . $orderName . "',"
                . "'" . $address . "','0','" . $payment . "','" . $price . "','" . $lat . "','" . $lon . "')";
        $this->connectDB();
        $resultArray2 = $this->db->query($sql);
        $oid = $this->db->insert_id();

        for ($i = 0; $i < $cnt; $i++) {
            $sql = "INSERT INTO sellproduct(oid,iid,sz)
				VALUES (
					'" . $oid . "',"
                    . "'" . $itemArray[$i] . "','" . $sizeArray[$i] . "')";
            $resultArray2 = $this->db->query($sql);
        }

        //send Email
        $adminInfo = $this->getAdminInfo();
        mail($adminInfo->email, 'Request Order', 'Requested Order from Order Name(' . $orderName . ')');
        //
        $jsonResult = array();
        $jsonResult['orderName'] = $orderName;
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function getAdminInfo() {
        $sql = "select * from admin_user";
        $resourceUser = $this->db->query($sql)->result();
        return $resourceUser[0];
    }

    public function onLoadOrders() {
        $uid = $_REQUEST['uid'];
        $sql = "select * from orders where uid='" . $uid . "' and status < 2 order by createdate desc";
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['orders'] = $this->makeJsonOrders($result);

        $sql = "select * from orders where uid='" . $uid . "' and status > 1 order by createdate desc";
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult['history'] = $this->makeJsonOrders($result);


        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function onLoadOrderById() {
        $oid = $_REQUEST['oid'];
        $sql = "select *,C.category as cname from sellproduct as A left join items as B on A.iid=B.no left join category as C on B.category=C.no where A.oid='" . $oid . "' order by A.no asc";
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $jsonResult = array();
        $jsonResult['items'] = $this->makeJsonItems($result);
        $jsonResult['response'] = 200;
        echo json_encode($jsonResult);
    }

    public function makeJsonOrders($result) {
        $outArray = array();
        for ($i = 0; $i < count($result); $i++) {
            $dataItem = $result[$i];
            $data = array();
            $data['no'] = $dataItem->no;
            $data['address'] = $dataItem->address;
            $data['state'] = $dataItem->status;
            $data['payment'] = $dataItem->payment;
            $data['name'] = $dataItem->name;
            $data['price'] = $dataItem->price;
            $data['createdate'] = $dataItem->createdate;
            $outArray[$i] = $data;
        }
        return $outArray;
    }

    public function makeJsonItems($result) {
        $outArray = array();
        for ($i = 0; $i < count($result); $i++) {
            $dataItem = $result[$i];
            $data = array();
            $data['no'] = $dataItem->no;
            $data['name'] = $dataItem->name;
            $data['description'] = $dataItem->description;
            $data['amount'] = $dataItem->amount;
            $data['price'] = $dataItem->price;
            $data['createdate'] = $dataItem->createdate;
            $data['image1'] = $dataItem->image1;
            $data['brand'] = $dataItem->brand;
            $data['image2'] = $dataItem->image2;
            $data['image3'] = $dataItem->image3;
            $data['image4'] = $dataItem->image4;
            $data['category'] = $dataItem->cname;
            $data['phone'] = $dataItem->phone;
            $data['email'] = $dataItem->email;

            //review and count
            $data['review'] = $this->getReviewInfo($dataItem->no);

            $outArray[$i] = $data;
        }
        return $outArray;
    }

    public function getReviewInfo($iid) {
        $resultArray = array();
        $sql = "select * from reviews where iid='" . $iid . "'";
        $this->connectDB();
        $result = $this->db->query($sql)->result();
        $resultArray['count'] = count($result);
        $stars = 0;
        for ($i = 0; $i < count($result); $i++) {
            $stars = $stars + $result[$i]->star;
        }
        if (count($result) == 0)
            $resultArray['star'] = 0;
        else
            $resultArray['star'] = $stars / count($result);
        return $resultArray;
    }

}
