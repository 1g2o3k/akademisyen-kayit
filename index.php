<?php 
    session_start();
    $a1=$_POST["kullanici"];$a2=$_POST["sifre"];
    if ($a1=="dekan"&&$a2=="12345") {
        $_SESSION["admin_logged_in"]=true;
        header("Location: kayd.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { min-height: 100vh; display: flex; justify-content: center; align-items: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .login-box { background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); width: 350px; }
        .login-box h2 { color: #333; text-align: center; margin-bottom: 1.5rem; }
        .login-box input { width: 100%; padding: 12px 15px; margin-bottom: 15px; border: 2px solid #ddd; border-radius: 8px; font-size: 14px; transition: 0.3s; }
        .login-box input:focus { border-color: #667eea; outline: none; }
        .login-box button { width: 100%; padding: 12px; background: linear-gradient(135deg, #667eea, #764ba2); color: white; border: none; border-radius: 8px; font-size: 16px; cursor: pointer; transition: 0.3s; }
        .login-box button:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(102,126,234,0.4); }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>🔐 Giriş Yap</h2>
        <form method="post">
            <input type="text" name="kullanici" placeholder="Kullanıcı adı">    
            <input type="password" name="sifre" placeholder="Şifre">
            <button type="submit">Giriş</button>
        </form>
    </div>
</body>
</html>
