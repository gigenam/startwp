```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Plantillas

Carpeta para agregar plantillas reutilizables.

`favicons/`:

- En esta carpeta se encuentran algunos archivos para la creación de la imagen
  que aparece en las pestañas de los navegadores (favicon). Ver [header.php](../app/header.php#L18).

  Las imágenes finales deben ir en la carpeta `app/img/`.

  Para más ayuda o más íconos (por ejemplo para Android e iOS), visita
  [https://realfavicongenerator.net/](https://realfavicongenerator.net/).

  - `apple-touch-icon.png` es para dispositivos Apple y tiene un tanaño de 180x180.
  - `favicon.png` es el más genérico y soportado por la mayoría de navegadores y
    tiene un tamaño de 32x32.
  - `favicon.svg` es la versión más [moderna](https://caniuse.com/?search=svg%20favicons)
    y además de la ventaja propia en cuanto a calidad, también se puede utilizar
    en temas claros y oscuros (abrir el archivo en un editor de texto para ver).

`screenshot/`:

- En esta carpeta se encuentran algunos archivos para la creación de la imagen de
  muestra del tema que se visualiza al seleccionar temas en la administración.
  Ver [screenshot.png](../app/screenshot.png).
- El archivo de formato .xcf es para ser utilizado con [GIMP](https://gimp.org/).

`sharing/`:

- En esta carpeta se encuentran algunos archivos para la creación de la imagen de
  muestra al compartir enlaces en redes sociales como Facebook y Twitter.
  Ver [class-general.php](../app/inc/setup/class-general.php#L139) y
  [og-summary-large.jpg](../app/img/og-summary-large.jpg).

- El archivo de formato .xcf es para ser utilizado con [GIMP](https://gimp.org/)
  y tiene dos modos por defecto. **summary** y **summary-large**.

  Tamaños mínimos recomendados (px):

  - Summary Large (1.9:1) = 1200 x 630
  - Summary (1:1) = 600 x 600
