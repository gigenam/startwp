```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

# Lista de cosas e ideas para hacer, revisar, arreglar, etc.

<br>

## Funcionalidades pendientes:

## Revisiones pendientes:

## Correcciones:

## Traducciones:

## Notas:

URL para probar verificación de correo. WordPress muestra esta pantalla cada unos
meses. **Debes iniciar sesión**, sino serás redirigido a la pantalla de login.

`http://[domain]/[site]/wp-login.php?redirect_to=http://[domain]/[site]/wp-admin&action=confirm_admin_email`

- `[domain]` = Dominio del sitio. Por lo general en desarrollo es localhost o
  localhost:8080, etc.
- `[site]` = En desarrollo es probable que estés en una subcarpeta, por ejemplo
  localhost:8080/mi-sitio. Si no es así, quita esto de la url.

<br>

# Ideas:

<br>

# Solución de errores comunes:

## Desarrollo

Errores de compilación:

- Actualizar dependencias `npm update` y/o `composer update`.
- Revisar archivos de configuración y verificar código y rutas.
- Habilita/deshabilitar cosas no necesarias para el proyecto (admin styles,
  admin scripts, etc).

## Tema

Pantalla en blanco sin errores:

- revisar en [header.php](./app/header.php) que esté la función de cabecera
  correctamente - `wp_head()`.
- revisar en [footer.php](./app/footer.php) que esté la función de cierre
  correctamente al final del body - `wp_footer()`.
- revisar en [index.php](./app/index.php), [page.php](./app/page.php),
  [single.php](./app/single.php), etc. Que estén la funciones de cabecera y pie
  de página correctamente.
  - `get_header()`.
  - `get_footer()`.
