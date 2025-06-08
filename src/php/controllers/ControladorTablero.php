<?php
// src/controladores/ControladorTablero.php

session_start();

class ControladorTablero
{
    public function tablero()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ../views/inicio_sesion/inicio_sesion.php');
            exit();
        }

        // Obtener el cod_profesor del usuario autenticado
        $cod_profesor = $_SESSION['usuario']['cod_profesor'];

        // Decidir a qué vista redirigir
        if ($cod_profesor === 'ASM') {
            header('Location: /proyecto_daw_2425_def/src/php/views/horarios/horarioView.php');
        } else {
            header('Location: /proyecto_daw_2425_def/src/php/views/horarios/horarioView_user.php');
        }
        exit();
    }

    public function otraVista()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: ../views/inicio_sesion/inicio_sesion.php');
            exit();
        }
        include __DIR__ . '/../views/inicio_sesion/otra_vista.php';
    }
}

// Uso del controlador
$controlador = new ControladorTablero();
$action = $_GET['action'] ?? 'tablero';
$controlador->$action();
