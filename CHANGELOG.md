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

## Version 1.1.1 - 2022-07-18 :

- [!] Corrección menor en la documentación para crear un tema hijo y llamar los
  estilos y scripts personalizados correctamente.

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
