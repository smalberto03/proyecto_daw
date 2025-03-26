<?php
require_once '../../controllers/SeccionController.php';

$controller = new SeccionController();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller->borrarSeccion($id);
}
?>
