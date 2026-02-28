<?php 
require_once "imp.php";
session_start();
if ($_SESSION["admin_logged_in"]==true) {
   echo "hoşgeldiniz";
 }elseif ($_SESSION["admin_logged_in"]==false) {
    exit("hatalı giriş");
}
$ad=$_POST["ad"] ?? "";
$soyad=$_POST["soyad"] ?? "";
$tarih = str_replace("T", " ", $_POST['tarih']) ?? "";
$tarih .=":00";
$memleket=$_POST["memleket"] ?? "";
try {
    $pdo=new PDO("mysql:host=$host;dbname=c$dbnamer","$usr","psw");  
    $pdo->prepare("
    create table if not exists 
    bilgiler(
    id int auto_increment primary key,
    ad varchar(50),
    soyad varchar(50),
    tarih datetime,
    memleket varchar(50)
    );
    ")->execute(); 
    $pdo->prepare(
        "
        insert into bilgiler(
        ad,soyad,tarih,memleket)
        values
        (?,?,?,?);
        "
    )->execute([$ad,$soyad,$tarih,$memleket]);
    
    } catch (\Throwable $th) {
    echo "";
    }

    $sql2=$pdo->prepare("
    select*from bilgiler
    ");
    $sql2->execute();
    $r=$sql2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akademisyen Kayıt</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { min-height: 100vh; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); padding: 2rem; }
        .container { max-width: 1000px; margin: 0 auto; }
        h1 { color: #2c3e50; text-align: center; margin-bottom: 2rem; }
        .form-box { background: white; padding: 2rem; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 2rem; }
        .form-box h3 { color: #333; margin-bottom: 1rem; }
        .form-box input { width: 100%; padding: 12px 15px; margin-bottom: 12px; border: 2px solid #ddd; border-radius: 8px; font-size: 14px; transition: 0.3s; }
        .form-box input:focus { border-color: #667eea; outline: none; }
        .form-box button { padding: 12px 30px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: 0.3s; }
        .form-box button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102,126,234,0.4); }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        th { background: linear-gradient(135deg, #667eea, #764ba2); color: white; padding: 15px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid #eee; color: #555; }
        tr:hover { background: #f8f9ff; }
        tr:last-child td { border-bottom: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Akademisyen Kayıt</h1>
        <div class="form-box">
            <h3>Yeni Kayıt Ekle</h3>
            <form method="post">
                <input type="text" placeholder="Ad" name="ad"><br>
                <input type="text" name="soyad" placeholder="Soyad"><br>
                <input name="tarih" type="datetime-local" placeholder="Doğum tarihi"><br>
                <input type="text" name="memleket" placeholder="Memleket"><br><br>
                <button>Kaydet</button>
            </form>
        </div>
        <table>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Tarih</th>
                <th>Memleket</th>
            </tr>
            <?php 
            foreach( $r as $r){
            ?>
            <tr>
                <td><?php echo $r["ad"]  ?></td>
                <td><?php echo $r["soyad"] ?> </td>
                <td><?php echo $r["tarih"] ?></td>
                <td><?php echo $r["memleket"] ?> </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
