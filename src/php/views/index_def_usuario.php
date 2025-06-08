<!-- clien id '853503363773-pgq1ccd922rns5k5igeen5eln9vlsvtr.apps.googleusercontent.com'
    secrect id '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'
Uri 'http://localhost/proyecto_daw/src/php/vistas/index_usuario.php'-->

<?php
  require_once '../config/config.php';
  //require_once 'index_usuario.php';
  // require_once '../config/configdb.php';

  // if(!isset($_SESSION['user_token']))
  // {
  //   header('Location: index_usuario.php');
  //   die();
  // }
  
  // authenticate code from Google OAuth Flow
  

  if(isset($_GET['code'])) {

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();

    $userinfo = [
      'email' => $google_account_info['email'],
      'first_name' => $google_account_info['givenName'],
      'last_name' => $google_account_info['familyName'],
      'gender' => $google_account_info['gender'],
      'full_name' => $google_account_info['name'],
      'picture' => $google_account_info['picture'],
      'verifiedEmail' => $google_account_info['verifiedEmail'],
      'token' => $google_account_info['id'],
    ];

    $dominio = explode("@", $userinfo['email']);
    echo $dominio[1];
    //var_dump($dominio[1]);
    //$dominio = explode("@", $userinfo['email']);

    // if($dominio[1] != 'gmail.com');
    // {
    //   if (!isset($_SESSION['user_token'])) 
    //   {
    //     header("Location: index_usuario.php");
    //     die();
    //   }
    // }

    //cho $userinfo['email'];

    

    //echo $dominio[1];

    
  
    // checking if user is already exists in database
    $sql = "SELECT * FROM users WHERE email ='{$userinfo['email']}'";

    $result = mysqli_query($conn, $sql);
    // $conexion = new Conexion();
    // $conectar = $conexion->conectar();
    // $result = $conectar->query($sql);

    if (mysqli_num_rows($result) > 0) 
    {
      // user is exists
      $userinfo = mysqli_fetch_assoc($result);
      $token = $userinfo['token'];

    }else{

      // user is not exists   
      
      $sql = "INSERT INTO users (email, first_name, last_name, gender, full_name, picture, verifiedEmail, token, es_admin) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['gender']}', '{$userinfo['full_name']}', '{$userinfo['picture']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}', 0)";
      $result = mysqli_query($conn, $sql);
      // $conexion2 = new Conexion();
      // $conectar2 = $conexion2->conectar();
      // $result = $conectar2->query($sql);
      if($result){

        $token = $userinfo['token'];

      }else{

        echo "User is not created";

        //die();
      }
    }

    // save user data into session
    $_SESSION['user_token'] = $token;
    

  }else{

    if(!isset($_SESSION['user_token']))
    {
      header('Location: index_usuario.php');
      die();
    }

    // if (!isset($_SESSION['user_token'])) 
    // {
    //   header("Location: index_usuario.php");
    //   die();
    // }

    // checking if user is already exists in database
    $sql = "SELECT * FROM users WHERE token ='{$_SESSION['user_token']}'";

    // $conexion3 = new Conexion();
    // $conectar3 = $conexion3->conectar();
    // $result = $conectar3->query($sql);
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) 
    {
      // user is exists
      $userinfo = mysqli_fetch_assoc($result);
    }
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="nav">
      <div>
          <img src="../../../diseno/assets/logotipo.png" alt="Logo de la escula" id="logo">
      </div>
      <div class="titulo">ESCUELA VIRGEN DE GUADALUPE</div>
      <div><img src="<?= $userinfo['picture'] ?>" alt="" width="55px" height="55px" class="user_image"></div>
    </div>
    <div class="nav2">
        <div>
            Gestionar usuarios 
        </div>
        <div>
            Profesores
        </div>
        <div>
            Gestión horario 
        </div>
        <div>
            Horas especiales
        </div>
    </div>
    <!--<div>    
       // echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />'; -->
      <!-- // echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'];     
    </div>-->
  
    <!-- <ul>
    <li>Full Name: <?= $userinfo['full_name'] ?></li>
    <li>Email Address: <?= $userinfo['email'] ?></li>
    <li>Gender: <?= $userinfo['gender'] ?></li>-->
    <li><a href="cerrar_sesion.php">Logout</a></li>
    <!-- </ul>  -->
    <!-- <div class="horario">
      HORARIO PROFESOR
    </div> -->
</body>

</html>


























































<!-- 
    //require_once('index_usuario.php');
    // if(isset($_GET["code"]))
    // {
    //     if(!isset($token['error']))
    //     {
    //         if(!empty($data['given_name']))
    //         {
    //             $_SESSION['user_first_name'] = $data['given_name'];
    //         }

    //         if(!empty($data['family_name']))
    //         {
    //             $_SESSION['user_last_name'] = $data['family_name'];
    //         }

    //         if(!empty($data['picture'])) 
    //         {
    //             $_SESSION['user_image'] = $data['picture'];
    //         }
    //     }
    // }

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="nav">
        <div>
            <img src="../../assets/logotipo.png" alt="Logo de la escula" id="logo">
        </div>
        <div class="titulo">ESCUELA VIRGEN DE GUADALUPE</div>
    </div>
    <div>
         
            // echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
            // echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'];
        
    </div>
    <div class="horario">
        HORARIO PROFESOR
    </div>
  
        // if($login_button == '')
        // {
        //     echo'<h3><a href="cerrar_sesion.php">Logout</h3></div>';
        // }
        // if($login_button != '')
        // {
        //     echo '<div align="center">'.$login_button.'</div>';
        // }
    
</body>
</html> -->