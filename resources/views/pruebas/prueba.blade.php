<!-- resources/views/productos/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-gray-800">

    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Nuevo Producto</h1>

        <form action="" method="POST" enctype="multipart/form-data" class="bg-gray-100 p-6 rounded-lg shadow-md max-w-lg mx-auto">
            @csrf

            <div class="mb-4">
                <label for="nombre" class="block text-gray-700 font-semibold">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" class="w-full px-4 py-2 border rounded-lg" placeholder="Nombre del Producto" required>
            </div>

            <div class="mb-4">
                <label for="descripcion" class="block text-gray-700 font-semibold">Descripción</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="w-full px-4 py-2 border rounded-lg" placeholder="Descripción del Producto" required></textarea>
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-gray-700 font-semibold">Precio</label>
                <input type="number" name="precio" id="precio" class="w-full px-4 py-2 border rounded-lg" placeholder="Precio" required>
            </div>

            <div class="mb-4">
                <label for="categoria" class="block text-gray-700 font-semibold">Categoría</label>
                <select name="categoria" id="categoria" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="tecnologia">Tecnología</option>
                    <option value="ropa">Ropa</option>
                    <option value="hogar">Hogar</option>
                    <!-- Agrega más categorías si es necesario -->
                </select>
            </div>

            <div class="mb-6">
                <label for="foto" class="block text-gray-700 font-semibold">Agregar Foto</label>
                <input type="file" name="foto" id="foto" class="w-full py-2">
            </div>

            <div class="text-center">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700">Agregar Producto</button>
            </div>
        </form>
    </div>

</body>
</html>
