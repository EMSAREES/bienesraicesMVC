<?php

require_once __DIR__ . '/../include/app.php';

USE MVC\Router;
USE Controllers\PropiedadController;
USE Controllers\VendedorController;
USE Controllers\PaginasController;
USE Controllers\BlogController;
USE Controllers\LoginController;

$router = new Router();


$router->get("/admin", [PropiedadController::class, 'index']);

//zona privada
// Propiedades
$router->get("/propiedades/crear", [PropiedadController::class, 'crear']);
$router->post("/propiedades/crear", [PropiedadController::class, 'crear']);
$router->get("/propiedades/actualizar", [PropiedadController::class, 'actualizar']);
$router->post("/propiedades/actualizar", [PropiedadController::class, 'actualizar']);
$router->post("/propiedades/eliminar", [PropiedadController::class, 'eliminar']);
// Vendedores
$router->get("/vendedores/crear", [VendedorController::class, 'crear']);
$router->post("/vendedores/crear", [VendedorController::class, 'crear']);
$router->get("/vendedores/actualizar", [VendedorController::class, 'actualizar']);
$router->post("/vendedores/actualizar", [VendedorController::class, 'actualizar']);
$router->post("/vendedores/eliminar", [VendedorController::class, 'eliminar']);
// Blogs
$router->get("/blogs/crear", [BlogController::class, 'crear']);
$router->post("/blogs/crear", [BlogController::class, 'crear']);
$router->get("/blogs/actualizar", [BlogController::class, 'actualizar']);
$router->post("/blogs/actualizar", [BlogController::class, 'actualizar']);
$router->post("/blogs/eliminar", [BlogController::class, 'eliminar']);


// zona publica
//pagina principales
$router->get("/", [PaginasController::class, 'index']);
$router->get("/nosotros", [PaginasController::class, 'nosotros']);
$router->get("/propiedades", [PaginasController::class, 'propiedades']);
$router->get("/propiedad", [PaginasController::class, 'propiedad']);
$router->get("/blog", [PaginasController::class, 'blog']);
$router->get("/entrada", [PaginasController::class, 'entrada']);
$router->get("/contacto", [PaginasController::class, 'contacto']);
$router->post("/contacto", [PaginasController::class, 'contacto']);


//login y autenticacion
$router->get("/login", [LoginController::class, 'login']);
$router->post("/login", [LoginController::class, 'login']);
$router->get("/logout", [LoginController::class, 'logout']);

$router->comprobarRutas();