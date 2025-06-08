<?php
// src/modelos/ModeloUsuario.php

class ModeloUsuario
{
    public function autenticarUsuario($email, $password)
    {
        // Aquí iría la lógica para autenticar al usuario, por ejemplo, consultando una base de datos.
        // Por simplicidad, vamos a simular una autenticación exitosa.
        return [
            'email' => $email,
            'nombre' => 'Nombre del Usuario'
        ];
    }
}
