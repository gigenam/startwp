```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Historial de cambios del repositorio

[ + ] Agregado -- [ - ] Quitado -- [ ! ] Arreglado/Modificado.

## Ver 1.9.0 - 2022-12-05 :

- [+] Agregada clase para íconos con [fondo](app/assets/img/sprites/demo.html#L477).
- [!] Corrección de tamaños para íconos con contorno `is-outline` para que no
  sean más grandes que el resto.
- [!] Cambios menores y actualización de diseño en algunos sprites, para una
  mejor integración con [fondos](app/assets/img/sprites/demo.html#L358).
- [!] Mejoras y agregados en la documentación de [sprites](app/assets/img/sprites/demo.html).

## Ver 1.8.1 - 2022-12-01 :

- [!] Mejoras en el agregado de sprites en linea mediante clases.
- [!] Correcciones menores en documentación de [sprites](app/assets/img/sprites/demo.html).

## Ver 1.8.0 - 2022-11-30 :

- [+] Agregado de sprite `telegram.svg` y algunos cambios de aspecto generales.
- [+] Agregado archivo [demo.html](app/assets/img/sprites/demo.html) para mostrar
  como usar y probar los sprites en este tema.
- [!] Correccion menor de selector de clases en [inlineIcons.js](app/assets/js/utilities/InlineIcons.js#L15).
- [!] Refactor y optimización de todos los sprites, ahorrando un **29%** en el
  peso total de todos los SVG's y un **33%** en el archivo [sprites.svg](app/assets/img/sprites.svg).
  Además de dejar todos los archivos en mejores condiciones para editarlos más
  fácilmente.

## Ver 1.7.0 - 2022-11-28 :

- [+] Agregado de sprite `tiktok.svg` y corrección menor en `star-half.svg`.
- [+] Agregados más estilos básicos para los comentarios (comentados por defecto
  en [main.scss](app/assets/scss/main.scss#L19)).
- [!] Cambios en plantilla SCSS. El archivo `_forms.scss` pasa a llamarse
  `_comments.scss`.

## Ver 1.6.0 - 2022-11-25 :

- [+] Agregados estilos para el formulario de comentarios (comentados por defecto)
  en [forms.scss](app/assets/scss/components/_forms.scss#L7).
- [+] Agregados estilos para la navegación de entradas en [\_posts.scss](app/assets/scss/layouts/_posts.scss#L21).
- [+] Agregado de tamaños variables para títulos inspirado en las nuevas opciones
  de WP 6.1 en [\_variables.scss](app/assets/scss/abstracts/_variables.scss#L15).
- [!] Corrección para bloques de botones para WP 6.1 en [editor.scss](app/assets/scss/editor.scss#L119)
  y [\_buttons.scss](app/assets/scss/components/_buttons.scss#L33).
- [!] Corrección en el alto del `body` en la página de login/register para evitar
  scroll vertical.
- [!] Correcciones en traducciones.

## Ver 1.5.0 - 2022-11-24 :

- [!] Mejoras en [Open Graph](app/inc/setup/class-general.php#L165) haciendo que
  en caso de no tener imagen destacada pero sí alguna dentro del contenido, use
  la primera publicada.
- [!] Pequeña corrección en la separación de los elementos en [editor.scss](app/assets/scss/editor.scss)
  y ajustes menores en la documentación de Flexgrid en [demo.html](app/assets/scss/flexgrid/demo.html).
- [!] Correcciones menores de comentarios.

## Ver 1.4.11 - 2022-11-22 :

- [-] Eliminado contenido comentado sobre block templates en [class-setup](app/inc/core/class-setup.php#L94).
- [!] Mejoras y correcciones de documentación y comentarios.

## Ver 1.4.10 - 2022-11-18 :

- [+] Agregados 3 sprites más. `shipping.svg`, `star-half.svg` y `spotify.svg`.
- [!] Separación de tarea para borrar la carpeta `img` en [gulpfile.js](gulpfile.js#L102).
- [!] Correcciones menores.
- [!] Actualización de dependencias.

## Ver 1.4.9 - 2022-11-03 :

- [!] Correcciones menores de documentación y soporte para WP 6.1.
- [!] Actualización de dependencias.

## Ver 1.4.8 - 2022-10-17 :

- [!] Arregos y actualización en la tarea de [compresión de imágenes](./gulpfile.js#L179),
  que traía problemas al compilar los `sprites.svg` en modo producción.
- [!] Actualización de dependencias.

## Ver 1.4.7 - 2022-10-12 :

- [+] Agregada opción de pasar el valor `rem` sin medida en
  [\_functions.scss](app/assets/scss/abstracts/_functions.scss#L13) para poder
  ser utilizado en operaciones matemáticas sin problemas.
- [!] Corrección menor en botones de login en `:focus`.
- [!] Modificación menor de documentación de algunos parametros en scripts.

## Ver 1.4.6 - 2022-10-05 :

- [+] Agregado de clases de colores `has-white-*` y `has-black-*` en
  [utilities.scss](app/assets/scss/base/_utilities.scss#L279) porque al seleccionar
  colores blanco y negro puros desde el editor, Wordpress agrega las siguientes
  clases en vez de el código hexadecimal.
- [!] Actualización de dependencias.

## Ver 1.4.5 - 2022-09-09 :

- [!] Corrección de márgenes para todos los elementos de formulario.
- [!] Corrección de tamaño en checkbox y radios (em por rem) para evitar que
  puedan crecer con el tamaño de un padre (Agregandolos dentro de un encabezado,
  pos ejemplo).

## Ver 1.4.4 - 2022-08-26 :

- [-] Eliminación de la plantilla `app/template-parts/content-page.php` ya que
  fue integrada directamente en [page.php](app/page.php).
- [!] Limpieza y optimización en [MainNav.js](app/assets/js/components/MainNav.js).
- [!] Actualización de dependencias.
- [!] Correcciones menores de documentación.

## Ver 1.4.3 - 2022-08-22 :

- [+] Agregado de [Github Action](.github/workflows/build.yml) para compilar y
  probar el proyecto en Node 16.x y 18.x.
- [!] Cambio en la versión mínima de Node a 16.x LTS o superior.

## Ver 1.4.2 - 2022-08-16 :

- [+] Agregado [demo.html](app/assets/scss/flexgrid/demo.html) para demostrar y
  probar el uso de `FlexGrid`.
- [+] Agregada plantilla de [front-page.php](/templates/php/front-page.php).
- [!] Más correcciones en documentación. Eliminado de Google Fonts usando
  @import y PHP en [LEEME.txt](app/LEEME.txt) (respaldo en [TODO.ms](TODO.md)).
  Agregado de instrucciones para modificar el formulario de comentarios en
  [LEEME.txt](app/LEEME.txt#L177)

## Ver 1.4.1 - 2022-08-15 :

- [!] Actualización de dependencias. Corregidos los problemas que podían surgir
  en la actualización [1.2.0](#ver-120---2022-08-03).
- [!] Correcciones menores para las secciones de widgets y comentarios solo para
  que respeten las dimensiones de contenido.

## Ver 1.4.0 - 2022-08-12 :

- [+] Agregado archivo [manifest.json](manifest.json) para probar mostrar y
  controlar mejor la versión actual del repositorio.
- [!] Cambios en [index.js](index.js). Ahora la información viene de [manifest.json](manifest.json).
- [!] Cambios en [package.json](package.json) y [composer.json](composer.json)
  ya que las versiones en esos archivos deben ser modificadas por el proyecto a
  desarrollar y/o actualizar en producción.
- [!] Optimización y limpieza de código en [InlineIcons.js](app/assets/js/utilities/InlineIcons.js).
- [!] Pequeña optimización en [MainNav.js](app/assets/js/components/MainNav.js)
  creando las ayudas de navegación con teclado fuera del loop de ítems. También
  se eliminó una variable en [DetectBrowsers.js](app/assets/js/utilities/DetectBrowsers.js).
- [!] Correcciones menores de estilos.
- [!] Actualización de documentación.

## Ver 1.3.3 - 2022-08-11 :

- [-] Eliminados los colores predeterminados en el editor para no tener que
  agregar estilos personalizados para cada nombre. Ver [theme.json](app/theme.json#L10).
- [!] Correcciones de ancho máximo de la sección de widgets por defecto igual al
  contenido principal.
- [!] Correcciones de estilos para algunos bloques, en el editor y cargar clases
  utilitarias al final del CSS.
- [!] Correcciones generales de documentación.

## Ver 1.3.2 - 2022-08-10 :

- [+] Agregado nuevo ícono `dots` y nuevas animaciones para íconos con las clases
  `is-animate` y `is-animate-reverse`.
- [!] Actualización de licencias en [LEEME.txt](app/LEEME.txt#L219).
- [!] Correcciones en contenidos privados, búsquedas y traducciones.
- [!] Correcciones menores de documentación y estilos.

## Ver 1.3.1 - 2022-08-08 :

- [+] Agregado de `sanitize_callback` en [class-customizer.php](app/inc/custom/class-customizer.php#L53).
- [!] Arreglo en alertas para instanciarlas más fácil y que los mensajes se puedan
  traducir correctamente en [class-alerts.php](app/inc/setup/class-alerts.php#L123).
- [!] Cambio en la forma de usar SVGs en [class-enqueue.php](app/inc/core/class-enqueue.php#L74).
- [!] Ocultar información extra como autor y fechas en páginas privadas.
- [!] Correcciones menores en mejora de accesibilidad.
- [!] Correcciones menores de documentación.

## Ver 1.3.0 - 2022-08-06 :

- [+] Agregado nuevo ícono `private` para contenido privado.
- [+] Agregada tarea `gulp translate` al iniciar el proyecto así ya queda el
  archivo `.pot` creado para traducciones futuras.
- [-] Quitada la tarea para combinar todos los **media queries** en [gulpfile.js](./gulpfile.js#L98)
  porque causa problemas con los `sourcemaps`. Más info en [TODO.md](./TODO.md#L19).
- [!] Mejoras en la visualización y personalización de contenidos privados.
- [!] Corrección en la visualización de contenido para la vista de blog.
- [!] Correcciones menores de estilos generales y para algunos bloques de WP.
- [!] Ajustes en las imágenes destacadas del blog con optimización de tamaño en
  [class-setup.php](app/inc/core/class-setup.php#L82).
- [!] Ajustes en el ancho de contenido para páginas internas.
- [!] Cambio de ubicación de plantillas no utilizadas desde `app/backups` a `templates/php`.

## Ver 1.2.1 - 2022-08-04 :

- [+] Agregado contador de comentarios a las entradas cuando estos están abiertos
  en las lineas [45](app/inc/setup/class-posts.php#L45) y [232](app/inc/setup/class-posts.php#L232)
  del archivo [class-posts.php](app/inc/setup/class-posts.php).
- [!] Cambio de nombre para íconos de comentarios porque no funcionaban. Ahora
  se utilizan con `icon-cmt` y `icon-cmts`.
- [!] Correcciones en comentarios y documentación.

## Ver 1.2.0 - 2022-08-03 :

- [+] Agregado nuevo sistema de SVGs para cargarlos en el final del `<body>` y no
  necesitar rutas absolutas al llamarlos con `<svg><use xlink:href="..."></svg>`.
  Más información en [class-enqueue.php](app/inc/core/class-enqueue.php#L75).
- [!] Limpieza de algunos paquetes `npm` ya innecesarios y agregado del paquete
  principal de `webpack` para evitar problemas.
- [!] Correcciones y actualizaciones de nuevos paquetes `npm`. Al momento de esta
  actualización puede surgir un error entre `@wordpress/eslint-plugin ^12.x` y
  `eslint ^8.x`. En ese caso instalar las dependencias con la opción extra
  `--legacy-peer-deps`. Ej: `npm run start --legacy-peer-deps`.
- [!] Cambio en el nombre de `gulpfile.babel.js` por `gulpfile.js`. Ya no es
  necesario usar `babel` para la configuración de gulp aunque de momento algunas
  funcionalidades están marcadas como experimentales (asserts).

## Ver 1.1.1 - 2022-07-18 :

- [!] Correcciones generales de documentación y mejoras en comentarios.

## Ver 1.1.0 - 2022-07-16 :

- [+] Agregado archivo [function.php](maintenance/function.php) para poner el
  sitio en mantenimiento a todos menos usuarios permitidos para hacer una mejor
  administración de contenido y modificaciones ocultas.
- [+] Agregado de versionado para los favicons en [header.php](app/header.php#L18)
  para prevenir almacenamiento de cache. Sobretodo en desarrollo.
- [-] Eliminación del archivo `templates/favicons/original.svg`. Usar el archivo
  `favicon.svg`. Se recomienda copiar y pegar en `app/assets/img` antes de modificar.
- [!] Correcciones en los archivos de favicon porque el valor `filter: invert()`
  no estaba funcionando correctamente.
- [!] Revisiones menores en la documentación.

## Ver 1.0.1 - 2022-07-06 :

- [!] Cambios de documentación en [LEEME.txt](./app/LEEME.txt) para agregar
  índice, ayuda para importar tipografías desde [Google Fonts](https://fonts.google.com)
  y modificación en las versiones mínimas soportadas por navegadores.
- [!] Correcciones menores de formato en algunos documentos.

## Ver 1.0.0 - 2022-07-04 : Versión inicial.
