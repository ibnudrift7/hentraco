<?php 
// function get database $dbcon
// mysql_connect($dbcon['host'], $dbcon['user'], $dbcon['pass']);
// mysql_select_db($dbcon['db']);

    function getRandom()
    {
        $randm = 'rand-'.rand(1000,9999);
        return $randm;
    }

    $set_random = getRandom();

    function connectDb(){
        $dbcon = array(
                'host'=>'localhost',
                'user'=>'root',
                'pass'=>'',
                'db'=>'hentraco',
        );
            
        $mysqli = mysqli_connect($dbcon['host'], $dbcon['user'], $dbcon['pass'], $dbcon['db']); 
        if (!$mysqli) {
            die('Could not connect: ' . mysqli_connect_errno() . ' - ' . mysqli_connect_error());
        }

        return $mysqli;
    }

    // function getSetting($lang)
    // {

    //     $squery = mysqli_query(connectDb(), "select * from setting");
    //     $data = array();
    //     while ($result = mysqli_fetch_assoc($squery)) {
    //         // print_r($result); exit;
    //         if ($result['dual_language']=='y') {
    //             $v = getSettingModel($result['name'], $lang);
    //             $data[$result['name']]= ($v['value']);
    //         } else {
    //             $data[$result['name']]= ($result['value']);
    //         }       
    //     }
    //     return $data;
    // }

    // function getAllCategorys()
    // {
    //     $model = mysqli_query(connectDb(), "SELECT * FROM `reference_list` GROUP BY `kategori` ORDER BY `id` ASC");
    //     $data = array();

    //     while ($result = mysqli_fetch_assoc($model)) {
    //         $data[] = $result;
    //     }
    //     return $data;
    // }

    // function getAllReference()
    // {
    //     $model = mysqli_query(connectDb(), "SELECT * FROM `reference_list` ORDER BY `id` ASC");
    //     $data = array();

    //     while ($result = mysqli_fetch_assoc($model)) {
    //         $data[] = $result;
    //     }
    //     return $data;
    // }

    // function getDataReferencebyCat($cats_name)
    // {
    //     $sql = 'SELECT * FROM `reference_list` WHERE `kategori` = "'.$cats_name.'"';
    //     $model = mysqli_query(connectDb(), $sql);
    //     $data = array();

    //     while ($result = mysqli_fetch_assoc($model)) {
    //         $data[] = $result;
    //     }
    //     return $data;
    // }

    // $set_References = getAllReference();

    // $set_CategoryRef = getAllCategorys();