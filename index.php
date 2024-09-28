<?php

declare(strict_types=1);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
session_start();

/* HELPER */
require_once(__DIR__ . '/App/helpers.php');
/* TRAIT */
require_once(__DIR__ . '/App/Traits/EnumValue.php');
require_once(__DIR__ . '/App/Traits/Validated.php');
/* ENUM  */
require_once(__DIR__ . '/App/Enums/PdoConnectionEnum.php');
require_once(__DIR__ . '/App/Enums/SchemeEnum.php');
require_once(__DIR__ . '/App/Enums/RoleEnum.php');
require_once(__DIR__ . '/App/Enums/FormValidationTypeEnum.php');
/* INTERFACES */
require_once(__DIR__ . '/App/Interfaces/ValidationRule.php');
/* REQUEST */
require_once(__DIR__ . '/App/Requests/LoginRequest.php');
require_once(__DIR__ . '/App/Requests/UserCreateRequest.php');
require_once(__DIR__ . '/App/Requests/UserGetRequest.php');
require_once(__DIR__ . '/App/Requests/UserUpdateRequest.php');
/* DB */
require_once(__DIR__ . '/App/Core/Database.php');
/* MODEL */
require_once(__DIR__ . '/App/Core/Model.php');
/* CONTROLLER */
require_once(__DIR__ . '/App/Core/Controller.php');
/* ROUTE */
require_once(__DIR__ . '/App/Core/Route.php');

phpinfo();
exit();


Route::get(url: '/', controller: 'Index', function: '');
Route::get(url: '/index', controller: 'Index', function: '');

Route::get(url: '/login', controller: 'Login', function: 'index');
Route::post(url: '/auth', controller: 'Login', function: 'login');

Route::get(url: '/admin', controller: 'Admin', function: 'index');
Route::get(url: '/logout', controller: 'Admin', function: 'logout');

Route::post(url: '/user-add', controller: 'User', function: 'add');
Route::post(url: '/user-get', controller: 'User', function: 'get');
Route::post(url: '/user-update', controller: 'User', function: 'update');
Route::post(url: '/user-delete', controller: 'User', function: 'delete');

Route::get(url: '/404', controller: 'NotFound', function: 'index');
Route::get(url: '/403', controller: 'Forbidden', function: 'index');
