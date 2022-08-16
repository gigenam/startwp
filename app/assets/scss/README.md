```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Desarrollo de estilos

En esta carpeta se encuentran todos los archivos SCSS que luego se compilan en
los archivos de estilos finales en la carpeta `css/`.

`abstracts/`:

Cosas para ser reutilizadas en SCSS. Por ejemplo mixins, funciones y variables.

`base/`:

Estilos básicos para el funcionamiento inicial y estándar del tema. Por ejemplo
normalizar estilos para todos los navegadores y clases utilitarias de uso global.

`components/`:

Estilos para elementos modulares y reutilizables. Por ejemplo botones, menús,
íconos, bloques, etc.

`flexgrid/`:

Un conjunto de estilos para ser reutilizados y crear interfaces fáciles con
flexbox. Se puede usar por clases en los archivos HTML/PHP o mediante @mixins en
otros archivos SCSS. En caso de no querer utilizarlo, comentar la linea 10 en
[main.scss](./main.scss#L10).

Ver [demo.html](flexgrid/demo.html) para obtener más ayuda.

`layouts/`:

Estilos estructurales y de interfaz. Por ejemplo cabeceras, contenidos principales,
entradas y páginas, etc.

`plugins/`:

Estilos sobre extensiones que instales y necesites modificar. Por ejemplo sliders,
formularios, carrito de compras, etc.

`themes/`:

Estilos temporales o que afecten ciertas partes de la web a nivel de diseño.
Por ejemplo agregar modo oscuro (Dark mode), o estilos por temporadas como
navidad, etc.

[editor.scss](./editor.scss) es para agregarle estilos similares al editor de
bloques de WordPress.

[login.scss](./login.scss) es para agregarle estilos a la pantalla de inicio de
sesión, recuperar contraseña y registro de usuarios.

[main.scss](./main.scss) es el archivo a compilar todos los estilos responsables
del funcionamiento del sitio para el público general.
