<?php

$name = $_POST['name'];
$email = $_POST["email"];
$phone_number = $_POST["phone_number"]; 

$errors = [];
if (empty($name) || empty($email) || empty($phone_number)) {
  $errors[] = '「予約者」「Email」「電話番号」のどれかが記入されていません!';
}

// データベース接続
$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=bookingform; charset=utf8',
  $dbUserName,
  $dbPassword
);

// データ追加
$stmt = $pdo->prepare("INSERT INTO bookings (
	name, email, phone_number
) VALUES (
	:name, :email, :phone_number
)");

$stmt->bindParam( ':name', $name, PDO::PARAM_STR);
$stmt->bindParam( ':email', $email, PDO::PARAM_STR);
$stmt->bindParam( ':phone_number', $phone_number, PDO::PARAM_STR);

$res = $stmt->execute();
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
 
<body>

  <div>
    <!-- エラーの場合 -->
    <?php if (!empty($errors)): ?>
      <?php foreach ($errors as $error): ?>
        <p><?php echo $error."\n"; ?></p>
      <?php endforeach; ?>
      <a href="index.php">予約画面へ</a>
    <?php endif; ?>

    <!-- エラーでない場合 -->
    <?php if (empty($errors)): ?>
      <h2>送信完了^ ^</h2>
      <a href="index.php">予約画面へ</a>
    <?php endif; ?>

  </div>
</body>
    
</html>