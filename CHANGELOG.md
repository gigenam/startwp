```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Historial de cambios

[ + ] Agregado -- [ - ] Quitado -- [ ! ] Arreglado/Modificado.

## Version 1.3.1 - 2022-08-08 :

- [+] Agregado de `sanitize_callback` en [class-customizer.php](app/inc/custom/class-customizer.php#L53).
- [!] Arreglo en alertas para instanciarlas más fácil y que los mensajes se puedan
  traducir correctamente en [class-alerts.php](app/inc/setup/class-alerts.php#L123).
- [!] Cambio en la forma de usar SVGs en [class-enqueue.php](app/inc/core/class-enqueue.php#L86).
- [!] Ocultar información extra como autor y fechas en páginas privadas.
- [!] Correcciones menores en mejora de accesibilidad.
- [!] Correcciones menores de documentación.

## Version 1.3.0 - 2022-08-06 :

- [+] Agregado nuevo ícono para contenido privado.
- [+] Agregada tarea `gulp translate` al iniciar el proyecto así ya queda el
  archivo `.pot` creado para traducciones futuras.
- [-] Quitada la tarea para combinar todos los **media queries** en [gulpfile.js](./gulpfile.js#L98)
  porque causa problemas con los `sourcemaps`. Más info en [TODO.md](./TODO.md#L19).
- [!] Mejoras en la visualización y personalización de contenidos privados.
- [!] Corrección en la visualización de contenido para la vista de blog.
- [!] Correcciones menores de estilos generales y para algunos bloques de WP.
- [!] Ajustes en las imágenes destacadas del blog con optimización de tamaño en
  [class-setup.php](/inc/core/class-setup.php#L82).
- [!] Ajustes en el ancho de contenido para páginas internas.
- [!] Cambio de ubicación de plantillas no utilizadas desde `app/backups` a `templates/php`.

## Version 1.2.1 - 2022-08-04 :

- [+] Agregado contador de comentarios a las entradas cuando estos están abiertos
  en las lineas [45](app/inc/setup/class-posts.php#L45) y [225](app/inc/setup/class-posts.php#L225)
  del archivo [class-posts.php](app/inc/setup/class-posts.php).
- [!] Cambio de nombre para íconos de comentarios porque no funcionaban. Ahora
  se utilizan con `icon-cmt` y `icon-cmts`.
- [!] Correcciones en comentarios y documentación.

## Version 1.2.0 - 2022-08-03 :

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

## Version 1.1.1 - 2022-07-18 :

- [!] Correcciones generales de documentación y mejoras en comentarios.

## Version 1.1.0 - 2022-07-16 :

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

## Version 1.0.1 - 2022-07-06 :

- [!] Cambios de documentación en [LEEME.txt](./app/LEEME.txt) para agregar
  índice, ayuda para importar tipografías desde [Google Fonts](https://fonts.google.com)
  y modificación en las versiones mínimas soportadas por navegadores.
- [!] Correcciones menores de formato en algunos documentos.

## Version 1.0.0 - 2022-07-04 : Versión inicial.
