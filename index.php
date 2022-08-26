<?php
session_start();
require_once __DIR__.'/Docky/autoload.php';
use Docky\App\App;
use Docky\DB\DB;
use Docky\UserController\UserController;
use Docky\Config\Config;
use Docky\Router\Router;
$Router = new Router([]);
$Router->add("/", "home");
$Router->add("/addproduct", "addproduct");
if ($Router->run() == "TplError" && !isset($_GET['del'])){
  header("Location: ./");
}
if (isset($_POST) && count($_POST) > 0 && !isset($_GET['del'])){
  switch ($_POST["switcher"]) {
    case "dvd":
      $sku = $_POST["sku"];
      $name = $_POST["name"];
      $price = $_POST["price"];
      $other = $_POST["size"];
      $info_text = "Size: ".$other." MB";
      $query = $DB->query("INSERT INTO `products` (sku,name,price,info) VALUES('$sku','$name','$price','$info_text')");
      break;
    case "book":
      $sku = $_POST["sku"];
      $name = $_POST["name"];
      $price = $_POST["price"];
      $other = $_POST["weight"];
      $info_text = "Weight: ".$other." KG";
      $query = $DB->query("INSERT INTO `products` (sku,name,price,info) VALUES('$sku','$name','$price','$info_text')");
      break;
    case "furniture":
      $sku = $_POST["sku"];
      $name = $_POST["name"];
      $price = $_POST["price"];
      $width = $_POST["width"];
      $height = $_POST["height"];
      $length = $_POST["length"];
      $info_text = "Dimension: ".$height."x".$width."x".$length;
      $query = $DB->query("INSERT INTO `products` (sku,name,price,info) VALUES('$sku','$name','$price','$info_text')");
      break;
  }
}
if (isset($_GET['del']) && isset($_POST['list'])){
  $list = explode(",", $_POST['list']);
  foreach ($list as $delpr){
    $DB->query("DELETE FROM `products` WHERE id = $delpr");
  }
  header("Location: ./");
}
$products_list = ['<div class="products">'];
$result = $DB->query("SELECT * FROM `products`");
while ($row = mysqli_fetch_assoc($result)){
  $products_list[] = '<div class="product" id="'.$row['id'].'">
    <input type="checkbox" class="delete-checkbox">
    <div class="info">
      <span class="info__name">'.$row["sku"].'</span>
      <span class="info__description">'.$row["name"].'</span>
      <span class="info__price">'.$row["price"].' $</span>
      <span class="info__other">'.$row["info"].'</span>
    </div>
  </div>';
}
$products_list[] = "</div>";
$__micro = $Config->vars_get();
$__TEMPLATE_CONFIG__ = $Config->template_vars_get();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- META SEO -->
  <?= $App->render('seo', $__micro); ?>
  <!-- META SEO -->
  <title><?= $__micro["project"]; ?></title>
  <link rel="icon" href="./src/img/title_logo.png">
  <link rel="stylesheet" href="./src/css/style.css">
  <?php
  echo '<link rel="stylesheet" href="./src/css/'.$Router->run().'.css">';
  ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrapper">
  <!-- MAIN -->
  <?php 
  if ($Router->run() != "TplError")
    $App->render($Router->run(), $__TEMPLATE_CONFIG__);
  else{
    $App->render("home", $__TEMPLATE_CONFIG__);
  }
  if ($Router->run() == "home"){
    foreach ($products_list as $product){
      echo $product;
    }
  }
  ?>
  <!-- MAIN -->
  <!-- FOOTER -->
  <?= $App->render('footer', $__TEMPLATE_CONFIG__); ?>
  <!-- FOOTER -->
</div>
<?= $App->render('js', $__TEMPLATE_CONFIG__); ?>
</body>
</html>
