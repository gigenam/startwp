```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Imágenes

En esta carpeta van todas las imágenes originales que el tema pueda requerir.
Luego estas se comprimen y copian a la carpeta `img/` principal.

En desarrollo corriendo la tarea `dev`, estas se copian a la carpeta `img/` pero
sin comprimir.

`sprites/`:

Esta carpeta está pensada para agregar todos los íconos para el sitio en formato
**svg**.

Luego mediante el comando `gulp sprites` se compilan todos en el archivo
[sprites.svg](./sprites.svg) en la carpeta superior para ser utilizados en linea
(como por ejemplo [ACÁ](../../inc/setup/class-posts.php#L123)) o mediante clases
y agregados dinamicamente con [JavaScript](../js/utilities/InlineIcons.js)).
