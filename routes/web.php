<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PedidoController;

//middlewares   
use App\Http\Middleware\AdminIndex;
use App\Http\Middleware\carrito;

//index de la pagina
Route::get('/home', [ProductoController::class, 'index'])->name('home');
Route::get('/', [ProductoController::class, 'index'])->name('home');
Route::get('/busqueda', [ProductoController::class, 'busqueda'])->name('home.busqueda');

//reportes y facturas
Route::get('/reporte/pdf', [PDFController::class, 'generarPDF'])->name('reporte.pdf');
Route::get('/factura/pdf/{id}',[PDFController::class, 'factura'])->name('pdf.factura');

//producto
Route::get('/producto/{id}', [ProductoController::class, 'producto'])->name('producto');

//oferta
//Route::get('/ofertas', [ProductoController::class, 'ofertas'])->name('ofertas');
Route::get('/ver-todas/ofertas', [ProductoController::class, 'ofertas'])->name('oferta.todos');

//pedido
Route::get('/checkout', [PedidoController::class, 'checkout'])->name('checkout')->middleware(carrito::class);
Route::post('/checkout/save', [PedidoController::class, 'checkoutSave'])->name('checkoutSave');
Route::post('/pedido/login', [PedidoController::class, 'ingreso'])->name('check.login');
Route::get('/pedido/confirmado/{id}', [PedidoController::class, 'confirmado'])->name('pedido.confirmado');

//carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::get('/carrito/add/{id}', [CarritoController::class, 'add'])->name('carrito.add');
Route::post('/carrito/add/cuota', [CarritoController::class, 'addCuota'])->name('carrito.addCuota');
Route::get('/carrito/quitar/{indice}', [CarritoController::class, 'quitar'])->name('carrito.quitar');
Route::get('/carrito/eliminar/{indice}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/carrito/borrar', [CarritoController::class, 'borrar'])->name('carrito.borrar');

//usuario
Route::get('/registro', [UsuarioController::class, 'registro'])->name('usuario.registro');
Route::post('/registro/save', [UsuarioController::class, 'registroSave'])->name('usuario.registroSave');
Route::get('/ingreso', [UsuarioController::class, 'login'])->name('login');
Route::post('/ingreso/save', [UsuarioController::class, 'loginSave'])->name('loginSave');
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('/Ajustes/{id}', [UsuarioController::class, 'Ajustes'])->name('user.ajustes')->middleware('auth');
Route::post('/Ajustes/cambio-de-datos', [UsuarioController::class, 'AjusteSave'])->name('AjusteSave')->middleware('auth');
Route::get('/olvide-mi-contraseña', [UsuarioController::class, 'forgot'])->name('forgot.pass');
Route::post('/recuperar-contraseña', [UsuarioController::class, 'recuperar'])->name('recuperar.pass');
Route::get('/cambiar-contraseña/{id}', [UsuarioController::class, 'cambiar'])->name('cambiar.pass');
Route::post('/cambiar/Save', [UsuarioController::class, 'cambiarSave'])->name('cambiarSave');

//administracion
Route::get('/adm/login', [AdmController::class, 'login'])->name('adm.login');
Route::post('/adm/save', [AdmController::class, 'loginSave'])->name('adm.loginSave');
Route::get('/adm/registro', [AdmController::class, 'registro'])->name('adm.registro');
Route::post('/adm/registro/save', [AdmController::class, 'registroSave'])->name('adm.registroSave');

Route::middleware([AdminIndex::class])->group(function () {    
    Route::get('/adm/usuarios', [AdmController::class, 'users'])->name('adm.users');

    Route::get('/adm', [AdmController::class, 'index'])->name('adm.index');    
    Route::get('/adm/logout', [AdmController::class, 'logout'])->name('adm.logout');
    //categoria
    Route::get('/adm/agregar/categoria', [CategoriaController::class, 'agregar'])->name('categoria.agregar');
    Route::post('/adm/agregar/categoria/save', [CategoriaController::class, 'agregarSave'])->name('aggSave');
    Route::get('/adm/editar/{id}', [CategoriaController::class, 'editar'])->name('categoria.editar');
    Route::delete('/adm/eliminar/{id}', [CategoriaController::class, 'eliminar'])->name('categoria.eliminar');
    Route::get('adm/ver-categorias', [CategoriaController::class, 'verTodos'])->name('categoria.todos');
    //subcategoria
    Route::post('/adm/agregar/subcategoria/save', [CategoriaController::class, 'aggSubCategoria'])->name('sub.agregar');
    Route::get('/adm/sub-caregorias', [CategoriaController::class, 'verSub'])->name('sub.ver');
    Route::delete('/adm/eliminar/subcategoria/{id}', [CategoriaController::class, 'eliminarSub'])->name('sub.eliminar');
    Route::get('/adm/editar/subcategoria/{id}', [CategoriaController::class, 'editarSub'])->name('sub.editar');
    Route::post('/adm/editar/subcategoria/save', [CategoriaController::class, 'editarSubSave'])->name('editarSubSave');
    //producto
    Route::get('/adm/agregar/producto', [ProductoController::class, 'agregar'])->name('producto.agregar');
    Route::post('/adm/agregar/producto/save/', [ProductoController::class, 'agregarSave'])->name('producto.agregarSave');
    Route::get('/adm/productos', [ProductoController::class, 'amdIndex'])->name('producto.amdIndex');
    Route::get('/adm/index/busqueda', [ProductoController::class, 'admBusqueda'])->name('producto.busqueda');
    Route::delete('/adm/eliminar/producto/{id}', [ProductoController::class, 'eliminar'])->name('producto.eliminar');
    Route::get('/adm/producto/editar/{id}', [ProductoController::class, 'editar'])->name('producto.editar');
    Route::post('/adm/producto/editar/save', [ProductoController::class, 'editarSave'])->name('producto.editarSave');
    Route::get('/adm/producto/detalle/{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');
    Route::post('/adm/producto/aggFotos', [ProductoController::class, 'aggFotos'])->name('producto.aggFotos');
    Route::delete('/adm/eliminar/foto/{id}', [ProductoController::class, 'eliminarFoto']);        
    Route::get('/adm/reporte/productos', [PDFController::class, 'productos'])->name('pdf.productos');
    //pedido
    Route::get('/adm/pedido/busqueda', [PedidoController::class, 'buscador'])->name('pedido.buscador');
    Route::get('/adm/pedidos', [PedidoController::class, 'pedidos'])->name('pedidos');
    Route::post('/actualizar-estado', [PedidoController::class, 'actualizarEstado'])->name('actualizar.estado');
    Route::get('/adm/pedido/{id}', [PedidoController::class, 'detalle'])->name('pedido.detalle');    


});

Route::get('/debug', function(){
    echo count(session('carrito'));
});

Route::get('/debug/3', function(){
    dd(App\Utils\Util::stats());
});

Route::get('/debug/2', function(){
    Session()->flush();
    return  redirect('/');
});






