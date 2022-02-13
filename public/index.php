<?php
$appConfig = require __DIR__ . '/../config/config.php';

$routeAction = $_SERVER["REQUEST_URI"];
if (isset($_GET['action'])) {
    $routeAction = $_GET['action'];
}

// router
switch ($routeAction) {
    case "create":
    case "edit":
        $controllerName = "EmployeesController";
        $action = 'create';
        break;
    case "store":
        $controllerName = "EmployeesController";
        $action = 'store';
        break;
    case "detail":
        $controllerName = "EmployeesController";
        $action = 'detail';
        break;
    case "update":
        $controllerName = "EmployeesController";
        $action = 'update';
        break;
    case "delete":
        $controllerName = "EmployeesController";
        $action = 'delete';
        break;
    default:
        $controllerName = 'EmployeesController';
        $action = 'index';
        break;
}
require './../src/views/IndexView.php';
require '../src/controller/ControllerInterface.php';
require '../src/controller/' . $controllerName . '.php';
require '../src/model/Employees.php';
require '../src/model/DbConnectionManager.php';

$db = new DbConnectionManager($appConfig);
$dbConnection = null;
if ($db) {
    $dbConnection = $db->getConnection();
}
$employees = new Employees($dbConnection);
$controller = new $controllerName($employees);
$controller->{$action}($_REQUEST);