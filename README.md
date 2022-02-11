# Construcción de un CMS con Laravel

Para este ejercicio se seguirá el tutorial de este [enlace](https://webmobtuts.com/backend-development/building-a-simple-cms-with-laravel-breeze/), donde se usará el framework laravel con el paquete breeze para construir una aplicación CMS con php.

La primera fase consta de la instalación de todo lo necesario para el proyecto, por lo que en la terminal de laragon se reproducen los siguientes comandos:

- composer create-project laravel/laravel php-laravel-breeze-cms --prefer-dist (php-laravel-breeze-cms es el nombre del proyecto)
- composer require laravel/breeze --dev
- php artisan breeze:install (para instalar el paquete que se requiere)

Ahora disponemos de un árbol extenso y completo de directorios donde podremos trabajar sobre los archivos y hacer los cambios nacesarios. Pero antes se harán otros dos comandos en terminal para compilar los recursos y estilos que nos da laravel breeze.

- npm install
- npm run dev

Como la base de datos no se construye automáticamente, se crea una en phpmyadmin o la terminal (la llamamos igual que al proyecto) y se actualiza el archivo ".env" con los datos correspondientes (usuario, clave, etc.). Finalmente migramos esa base con "php artisan migrate".

Si abrimos la url del proyecto ahora, veremos la página inicial de laravel y los links de login en la parte superior.

Tras esta serie de instalaciones, el siguiente paso es extender el paquete breeze según las necesidades del proyecto o añadir nuevas funciones. Para ello se usan las "blade views" y los "controllers". Por ejemplo, para modificar el login se iría a "resources/views/auth" y "resources/views/layouts".

## Modelos

Para este proyecto concreto, se añaden dos módulos del cms: categorías y artículos, de forma que se crean los modelos y migraciones al mismo tiempo:

- php artisan make:model Category -m
- php artisan make:model Post -m

Es necesario actualizar el método up() tanto en "database/migrations/create_categories_table.php" como en "database/migrations/create_posts_table.php", y correr de nuevo el comando "php artisan migrate".

Por último, se actualizan "app/Models/Category.php" y "app/Models/Post.php" con sus correspondientes funciones.

## Controladores

Para crear los controllers es necesario crear un nuevo directorio en "app/Http/Controllers/Admin", y después los dos controladores de categoría y artículo por terminal:

- php artisan make:Controller Admin/CategoriesController -r
- php artisan make:Controller Admin/PostsController -r

Se añaden las rutas de estos controles en "routes/web.php" (bajo Route::get(‘dashboard’)) y los links de navegación en "resources/views/layouts/navigation.blade.php".

Obviamente faltaría actualizar "app/Http/Controllers/Admin/CategoriesController.php" y "app/Http/Controllers/Admin/PostsController.php" para que incluyan las funciones de un CRUD estándar.

## Vistas

En cuanto a las vistas, se debe crear un nuevo directorio resources/views/admin, y en su interior las carpetas "category" y "post", donde irán archivos de añadir, editar o indexar.

Para "Category":

- resources/views/admin/category/index.blade.php
- resources/views/admin/category/add.blade.php
- resources/views/admin/category/edit.blade.php

Para "Post": (no olvidar crear la carpeta uploads en public para las imágenes de los posts)

- resources/views/admin/post/index.blade.php
- resources/views/admin/post/add.blade.php
- resources/views/admin/post/edit.blade.php

Ahora es posible crear categorías y posts a través de los links superiores del header principal. No obstante, aún falta hacer el display de ambos en el front-end, para lo que se crearán 3 páginas:

- Una home page de los últimos posts.
- Una página de categoría con los posts de la misma.
- Una página de post detallado.

Con esto en mente se crea un HomeController.php en "app/Http/Controllers/" (recordemos que los otros estan en Admin/), y se añade su ruta en "routes/web.php".

Finalmente se crean las vistas:

- resources/views/home.blade.php
- resources/views/category.blade.php
- resources/views/post.blade.php

## Conclusión

En este punto se deberían poder ver todas las páginas, categorías y posts, simplemente habiendo usado laravel breeze con módulos y blade. Si se quisiera trabajar con vuejs o react en este entorno, tendrían que instalarse con "php artisan breeze:install vue/react".

## Comentarios de uso y cambios

Para probar la aplicación creada se ha hecho un Registro cubriendo los datos pedidos (nombre, correo y contraseña), de forma que la próxima vez que se quiera acceder sólo se haría un Login directo. Al entrar en la página principal o dashboard sale un mensaje de "estás logueado" y un header con las opciones de ver y crear las categorías y posts, que de momento se encontrarían todas vacías. También hay un botón con el nombre del usuario conectado y la opción de logout.

- Crear Categoría funciona correctamente, sólo es necesario agregar un título para la misma.
- Crear Prueba taambién funciona, en este caso se pide un título, una descripción, elegir la categoría a la que pertenece y opcionalemente agregar una imagen.

Ambas funciones están bien pero para que se creen sólo es posible mediante la tecla "enter" del teclado, ya que se carece de un botón "guardar", por ejemplo, que facilite la tarea en la pantalla. Además, hablando del layout general se aprecian errores de estilo como la mala organización del header o menú de funciones (los links están todos juntos en un lado), los botones de crear ocupan todo el ancho de la pantalla, y aunque las categorías y posts se pueden editar o eliminar en sus respectivas páginas, no hay opción de abrir cada categoría ni cada post para que arroje su contenido en pantalla.

Para "arreglar" el layout general se ha incluido taildwindCSS en los archivos de resources/views/layouts, de momento en forma de link externo al cdn de tailwind. Para hacer esto con archivos .css internos, habría que crearlos o moverlos a public/css y resources/css antes de referenciarlos en el html/php.

Esta inclusión de tailwind ha arreglado el header, los estilos simples anteriores tienen más color, y al crear categorías y posts ahora hay un botón de crear claro, así como un mejor mensaje de que se ha creado satisfactoriamente.

Como apunte, si vamos a nuestra base de datos en phpmyadmin, podemos ver que se han creado las tablas "users", "categories" y "posts", con sus respectivas filas y datos dentro (según se introducen).

Hasta aquí hemos estado logueados en la aplicación, donde todo funciona correctamente, pero si salimos de la sesión y queremos ver la página de home nos encontramos con un error, básicamente el programa no encuentra la clase index y la vista de home, por lo que no la muestra, debido a un problema con las views de los post. Este erro está en proceso de estudio y solución.

**Nota**: Como siempre, se ha creado un respositorio remoto en Github usando los comando de git por terminal.
