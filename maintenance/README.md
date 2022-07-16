```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Mantenimiento

En esta carpeta se agregan todos los archivos para poner el sitio en mantenimiento.
Ya sea de forma manual o cuando WordPress está actualizando.

[index.html](./index.html) es utilizado principalmente cuando WordPress todavía
no fue instalado. A modo de próximamente.

[index.php](./index.php) es recomendado para usar si se crean sub-carpetas
(por ejemplo una llamada **maintenance** o similar) para agregar más cosas como
imágenes o scripts para usar en [maintenance.php](./maintenance.php). Este archivo
está vacío para evitar accesos indeseados.

[maintenance.php](./maintenance.php) debe ser subido dentro de la carpeta
`/wp-content/` y será usado cuando WordPress actualice el sitio o cuando se
utilice el archivo [maintenance](./maintenance) para forzar esta funcionalidad.

[maintenance](./maintenance), como se comenta arriba, es para forzar el modo de
mantenimiento de WordPress. Para eso hay que nombrarlo a `.maintenance` (con un punto delante)
y subirlo a la raíz del servidor (public_html/).

[function.php](./function.php) cuenta con una función para agregar en los archivos
del tema y forzar el modo mantenimiento pero con mayor control sobre quien puede
ver o acceder al sitio. Esta forma es la recomendada para bloquear el acceso
a usuarios (registrados o anónimos) cuando quieres hacer cambios importantes en
tu sitio ya que a diferencia del método anterior, en este caso WordPress y todas
sus funcionalidades siguen funcionando sin problemas.
