```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Desarrollo de scripts

En esta carpeta se encuentran todos los archivos JS que luego se compilan en los
archivos de scripts finales en la carpeta `js/`.

`components/`:

- Scripts basados en componentes. Por ejemplo para la navegación principal,
  alertas, etc.

`utilities/`:

- Scripts re-utilizables y de funcionalidades básicas. Por ejemplo verificar
  el navegador del usuario o eliminar el comportamiento por defecto de los enlaces.

[main.js](./main.js) es el archivo a compilar todos los scripts responsables de el
funcionamiento del sitio para el público general.
