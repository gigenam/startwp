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

## Version 1.2.1 - 2022-08-04 :

- [+] Agregado contador de comentarios a las entradas cuando estos están abiertos
  en [class-posts.php](app/inc/setup/class-posts.php#L45) y [class-posts.php](app/inc/setup/class-posts.php#L225).
- [!] Cambio de nombre para íconos de comentarios porque no funcionaban. Ahora
  se utilizan con `icon-cmt` y `icon-cmts`.
- [!] Correcciones en comentarios y documentación.

## Version 1.2.0 - 2022-08-03 :

- [+] Agregado nuevo sistema de SVGs para cargarlos en el final del `<body>` y no
  necesitar rutas absolutas al llamarlos con `<svg><use xlink:href="..."></svg>`.
  Más información en [class-enqueue.php](app/inc/core/class-enqueue.php#L74).
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
