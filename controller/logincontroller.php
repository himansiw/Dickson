<?php

include '../commons/session.php';
//Call for getmodel object
include '../model/user_model.php';
$userObj = new User();

include '../model/login_model.php';
//Create the login class object
$loginObj = new Login();
$status = $_REQUEST["status"];

switch ($status) {

    /**
     * Check the username and password then go the dashboard
     */
    case "login":
        $uname = $_POST["username"];
        $pw = $_POST["password"];
        $pw = sha1($pw); //convert password to sha1
        $pw = strtoupper($pw);// convert the pw to uppercase

        $result = $loginObj->validateLogin($uname, $pw);

        if ($result->num_rows == 1) { // valid user in the system
            $userRow = $result->fetch_assoc();  //fetch sql result
            $role_id = $userRow["user_role"]; //getRoleId
            $firstname = $userRow["user_fname"]; //get user firstname
            $lastname = $userRow["user_lname"]; //get user lastname
            $user_id = $userRow["user_id"]; //get user id
            $moduleResult = $userObj->getModulesByRole($role_id); //get the paticular module for role
            $moduleArray = [];

            if (!empty($role_id)) { //check the user role is empty or not
                $navArray = creteNavigation(); //call the navigation
            }

            while ($mRow = $moduleResult->fetch_assoc()) {
                array_push($moduleArray, $mRow["module_id"]);
            }

            $_SESSION["user_modules"] = $moduleArray;

            $userArray = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "role_id" => $role_id,
                "user_id" => $user_id,
                "nav" => $navArray,
            ];
            $_SESSION["user"] = $userArray;
            header('Location: ../view/dashboard.php'); //redirection

        } else {
            $msg = "The Credentials: username and the password does not match!";
            $msg = base64_encode($msg);
            header('Location: ../view/login.php?msg=' . $msg);//redirection
        }

        break;

    /**
     * logout
     */
    case "logout":
        session_destroy();//sessin destroy
        ?>
        <script>window.location = "../index.php"</script>
        <?php
        break;

    /**
     * Password recovery
     */
    case "verify_account":
        $username = $_POST["username"];
        // die($username);
        $userResult = $userObj->getUserByEmail($username);
        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $user_id = $userRow["user_id"];
            $string = "encrypted_id=$user_id";
            $string = base64_encode($string);
            $url = "http://localhost/dicksons/view/acc.php?status=recovery&code=$string";

            include '../includes/email_include.php';

            $mail->setFrom('mail@et.lk', 'Dicksons Food City Management System');
            $mail->addReplyTo('mail@et.lk', 'Dicksons Food City management System');
            $mail->addAddress($username); //Add a recipient

            // $mail->AddAttachment('../Documents/user_reports/user_report_20-08-08.pdf');

            // $mail->addCC($client_email);
            // $mail->addBCC($client_email);
            $mail->Subject = 'Account Recovery Email';

            $mail->isHTML(true); //Set email format to HTML

            $body .= "<img src='https://scontent.fcmb11-1.fna.fbcdn.net/v/t31.0-8/26961660_259586244575582_3411003803498886708_o.jpg?_nc_cat=100&ccb=2&_nc_sid=09cbfe&_nc_ohc=C4vLeSe-IsgAX836IA2&_nc_ht=scontent.fcmb11-1.fna&oh=a3454625be4df71570c4470bb6d9b2aa&oe=5FC95264' alt='' width='95' height='90'/>";
            $body .= "<h2>Please use the below link to Reset your password</h2>";
            $body .= "<a href='$url' target='_blank'>Please click on this link</a>";

            $mail->Body = $body;
            if ($mail->send()) {
                echo "Mail Successfully Sent!!!";
            } else {
                die($mail->ErrorInfo);
            }
            ?>
            <script>window.location = "../view/landing.php"</script>
            <?php
        }
        break;

    /**
     * change the password
     */
    case "change_password":
        $user_id = $_POST["user_id"];
        $new_pass = $_POST["n_password"];
        $userObj->changePassword($user_id, $new_pass);
        $msg = "Password Successfully Updated";
        $msg = base64_encode($msg);
        ?>
        <script> window.location = "../view/login.php?msg=<?php echo $msg; ?>"</script>
        <?php
        break;

    default:
        echo "Invalid Parameters";

}
/**
 * create navigation bar.
 * @return array[]
 */
function creteNavigation()
{
    $navigationArray = [

        0 => [
            "title" => "Dashboard",
            "url" => "dashboard.php",
            "role" => [1, 2, 3, 4, 5, 6, 7],
            "icon" => "fa-dashboard",
            "submenu" => [],
        ],
        // User management
        1 => [
            "title" => "User Management",
            "url" => "#",
            "role" => [1],
            "icon" => "fa-user",
            "submenu" => [
                0 => [
                    "title" => "View Users",
                    "url" => "view-user.php",
                    "role" => [1],
                    "icon" => "fa-eye",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "Add User",
                    "url" => "add-user.php",
                    "role" => [1],
                    "icon" => "fa-user-plus",
                    "submenu" => [],
                ],

            ],


        ],
        // Product master
        2 => [
            "title" => "Product Master",
            "url" => "#",
            "role" => [1, 2],
            "icon" => "fa-cubes",
            "submenu" => [
                0 => [
                    "title" => "List Products",
                    "url" => "view-product.php",
                    "role" => [1, 2],
                    "icon" => "fa-list",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "Units",
                    "url" => "unit.php",
                    "role" => [1, 2],
                    "icon" => "fa-balance-scale",
                    "submenu" => [],
                ],
                2 => [
                    "title" => "Departments",
                    "url" => "department.php",
                    "role" => [1, 2],
                    "icon" => "fa-building-o",
                    "submenu" => [],
                ],
                3 => [
                    "title" => "Brands",
                    "url" => "brand.php",
                    "role" => [1, 2],
                    "icon" => "fa-diamond",
                    "submenu" => [],
                ],
                4 => [
                    "title" => "Categories & Sub categories",
                    "url" => "category_subcategory.php",
                    "role" => [1, 2],
                    "icon" => "fa-tags",
                    "submenu" => [],
                ],
                5 => [
                    "title" => "Print Label",
                    "url" => "label.php",
                    "role" => [1, 2],
                    "icon" => "fa-barcode",
                    "submenu" => [],
                ],
                6 => [
                    "title" => "Product Location",
                    "url" => "product-location.php",
                    "role" => [1, 2],
                    "icon" => "fa fa-location-arrow",
                    "submenu" => [],
                ],

            ],


        ],
        // Purchase Management.
        3 => [
            "title" => "Purchase",
            "url" => "#",
            "role" => [1, 2, 3, 4],
            "icon" => "fa-truck",
            "submenu" => [
                0 => [
                    "title" => "Purchase Order",
                    "url" => "view-purchaseOrder.php",
                    "role" => [1, 4],
                    "icon" => "fa-shopping-cart",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "Supplier",
                    "url" => "supplier.php",
                    "role" => [1, 2, 4],
                    "icon" => "fa-address-card-o",
                    "submenu" => [],
                ],
                2 => [
                    "title" => "Add Receiving",
                    "url" => "add-receiving.php",
                    "role" => [1, 2, 4],
                    "icon" => "fa-plus-square ",
                    "submenu" => [],
                ],
                3 => [
                    "title" => "View Receiving",
                    "url" => "view-receiveOrder.php",
                    "role" => [1, 2, 4],
                    "icon" => "fa-book",
                    "submenu" => [],
                ],
            ],
        ],
        // Sales & Billing Management.
        4 => [
            "title" => "Sales & Billing",
            "url" => "#",
            "role" => [1, 3],
            "icon" => "fa-money",
            "submenu" => [
                0 => [
                    "title" => "Add Sale",
                    "url" => "sale.php",
                    "role" => [1, 3],
                    "icon" => "fa-cart-plus",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "View Sales",
                    "url" => "view-saleOrder.php",
                    "role" => [1, 3],
                    "icon" => "fa-shopping-basket",
                    "submenu" => [],
                ],
            ],
        ],
        // Inventory & Stock Management.
        5 => [
            "title" => "Inventory & Stock",
            "url" => "#",
            "role" => [1, 5],
            "icon" => "fa-building",
            "submenu" => [
                0 => [
                    "title" => "View Stocks",
                    "url" => "view-stock.php",
                    "role" => [1, 5],
                    "icon" => "fa-list-ul",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "Expired Products",
                    "url" => "expire.php",
                    "role" => [1, 5],
                    "icon" => "fa-calendar",
                    "submenu" => [],
                ],
                2 => [
                    "title" => "Low stock Products",
                    "url" => "lowstock.php",
                    "role" => [1, 5],
                    "icon" => "fa-minus-square-o",
                    "submenu" => [],
                ],
            ],
        ],
        // Employee Management.
        6 => [
            "title" => "Employee Management",
            "url" => "#",
            "role" => [1, 2],
            "icon" => "fa-users",
            "submenu" => [
                0 => [
                    "title" => "View Employee",
                    "url" => "employee.php",
                    "role" => [1, 2],
                    "icon" => "fa-list",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "Add Attendance",
                    "url" => "attendance.php",
                    "role" => [1, 2],
                    "icon" => "fa-plus-square",
                    "submenu" => [],
                ],
            ],
        ],
        // Security & Backup Management.
        7 => [
            "title" => "Security & Backup",
            "url" => "#",
            "role" => [1],
            "icon" => "fa-lock",
            "submenu" => [
                0 => [
                    "title" => "Backup",
                    "url" => "backup.php",
                    "role" => [1],
                    "icon" => "fa-hdd-o",
                    "submenu" => [],
                ],
            ],
        ],
        // Report Management.
        8 => [
            "title" => "Report Management",
            "url" => "#",
            "role" => [1, 2],
            "icon" => "fa-bar-chart-o",
            "submenu" => [
                0 => [
                    "title" => "Sale Reports",
                    "url" => "sevenday_sales.php",
                    "role" => [1, 2],
                    "icon" => "fa-dollar",
                    "submenu" => [],
                ],
                1 => [
                    "title" => "Purchase Reports",
                    "url" => "view-reports.php",
                    "role" => [1, 2],
                    "icon" => "fa-money",
                    "submenu" => [],
                ],
                2 => [
                    "title" => "Inventory Reports",
                    "url" => "stock_report.php",
                    "role" => [1, 2],
                    "icon" => "fa-bar",
                    "submenu" => [],
                ],
                3 => [
                    "title" => "fa-pie-chart",
                    "url" => "line-chart.php",
                    "role" => [1, 2],
                    "icon" => "fa-pie",
                    "submenu" => [],
                ],
            ],
        ],
        // Customer & Loyalty Management.
        9 => [
            "title" => "Customer & Loyalty",
            "url" => "#",
            "role" => [1, 3],
            "icon" => "fa-user-circle-o",
            "submenu" => [
                0 => [
                    "title" => "View Customers",
                    "url" => "customer.php",
                    "role" => [1, 3],
                    "icon" => "fa-user-secret",
                    "submenu" => [],
                ],
            ],
        ],


    ];

    return $navigationArray;
}


?>

