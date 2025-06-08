<?php
// src/controladores/ControladorAutenticacion.php

session_start();

class ControladorAutenticacion
{
    private $clientId = '1007451231855-n8q3mfthq2j33k793fo6onmbs0ego4oh.apps.googleusercontent.com';
    private $clientSecret = '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';
    private $redirectUri = 'http://localhost/proyecto_daw_2425_def/src/php/controllers/ControladorAutenticacion.php';

    public function inicioSesion()
    {
        if (!isset($_GET['code'])) {
            $authUrl = $this->createAuthUrl();
            header('Location: ' . $authUrl);
        } else {
            $token = $this->fetchAccessTokenWithAuthCode($_GET['code']);
            if ($token) {
                $userInfo = $this->fetchUserInfo($token['access_token']);

                // Verificar el dominio del correo electrónico
                if (strpos($userInfo['email'], '@gmail.com') === false) {
                    header('Location: ../views/inicio_sesion/inicio_sesion.php?error=dominio_no_valido');
                    exit();
                }

                $profesor = $this->buscarPorEmail($userInfo['email']);

                if ($profesor) {
                    // Almacenar la información del usuario en la sesión, incluyendo la imagen de perfil de Google
                    $_SESSION['usuario'] = array_merge($profesor, ['google_picture' => $userInfo['picture']]);
                    header('Location: ControladorTablero.php?action=tablero');
                } else {
                    header('Location: ../views/inicio_sesion/inicio_sesion.php?error=usuario_no_encontrado');
                }
            } else {
                header('Location: inicio_sesion.php?error=autenticacion_fallida');
            }
            exit();
        }
    }


    private function createAuthUrl()
    {
        return 'https://accounts.google.com/o/oauth2/v2/auth?' . http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => 'email profile',
            'access_type' => 'online',
            'prompt' => 'consent'
        ]);
    }

    private function fetchAccessTokenWithAuthCode($code)
    {
        $tokenUrl = 'https://oauth2.googleapis.com/token';
        $params = [
            'code' => $code,
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'grant_type' => 'authorization_code'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private function fetchUserInfo($accessToken)
    {
        $userInfoUrl = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $userInfoUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $accessToken]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private function buscarPorEmail($email)
    {
        $conexion = new mysqli('localhost', 'root', '', 'proyecto_daw_2425_def');
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        $stmt = $conexion->prepare("SELECT * FROM Profesores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc();
    }

    public function cerrarSesion()
    {
        session_unset();
        session_destroy();
        header('Location: ../views/inicio_sesion/inicio_sesion.php');
        exit();
    }
}

// Uso del controlador
$controlador = new ControladorAutenticacion();
if (isset($_GET['action']) && $_GET['action'] === 'cerrarSesion') {
    $controlador->cerrarSesion();
} else {
    $controlador->inicioSesion();
}
