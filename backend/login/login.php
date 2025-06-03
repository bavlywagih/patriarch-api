 <?php
    // // backend/login/login.php
    // 
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Headers: Content-Type");
    // header("Access-Control-Allow-Methods: POST");
    // header("Content-Type: application/json; charset=UTF-8");
    // 
    // if ( $_SERVER['REQUEST_METHOD'] !== 'POST') {
    //     http_response_code(405);
    //     echo json_encode(["error" => "فقط POST مسموح"]);
    //     exit();
    // }
    // 
    // require_once("../connect.php");
    // 
    //  $input = json_decode(file_get_contents("php://input"), true);
    // 
    //  $email =  $input['email'] ?? null;
    //  $password =  $input['password'] ?? null;
    // 
    // if (! $email || ! $password) {
    //     echo json_encode(["error" => "يجب ملء البريد الإلكتروني وكلمة المرور"]);
    //     exit();
    // }
    // 
    // try {
    //     $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND password = ? ");
    //     $stmt->execute([$email, $password]);
    //     $row = $stmt->fetch();
    //     $count = $stmt->rowCount();
    // 
    //     if ($user) {
    //         // مبدئيًا نقارن نصيًا، يمكن استبداله بـ password_verify لو استخدمت hash
    //         if ($password ===  $row['password']) {
    //             echo json_encode([
    //                 "success" => true,
    //                 "id" => $row['id'],
    //                 "name" => "lklklkl",
    //                 "group_id" => $row['group_id']
    //             ]);
    //         } else {
    //             echo json_encode(["error" => "كلمة المرور غير صحيحة"]);
    //         }
    //     } else {
    //         echo json_encode(["error" => "البريد الإلكتروني غير مسجل"]);
    //     }
    // } catch (PDOException  $e) {
    //     http_response_code(500);
    //     echo json_encode(["error" => "حدث خطأ في السيرفر"]);
    // }
    // 


    header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "error" => "error POST "]);
    exit();
}

require_once("../connect.php");

$input = json_decode(file_get_contents("php://input"), true);
$email = $input['email'] ?? null;
$password = $input['password'] ?? null;

if (!$email || !$password) {
    echo json_encode(["success" => false, "error" => "يجب ادخل البريد الالكتروني والباسورد"]);
    exit();
}else{
        $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if ($row) {
            if ($password === $row->password) {
                echo json_encode([
                    "success" => true,
                    "id" => $row->id,
                    "name" => $row->name ?? 'غير معروف',
                    "group_id" => $row->group_id ?? null
                ]);
            } else {
                echo json_encode(["success" => false, "error" => "كلمة المرور غير صحيحة"]);
            }
        } else {
            echo json_encode(["success" => false, "error" => "البريد الإلكتروني غير مسجل"]);
        }
    }

// try {

// } catch (PDOException $e) {
//     http_response_code(500);
//     echo json_encode(["success" => false, "error" => "حدث خطأ في السيرفر"]);
// }
