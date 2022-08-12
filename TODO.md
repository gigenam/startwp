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

Quitada la tarea para combinar todos los **media queries** en [gulpfile.js](./gulpfile.js#L99)
porque causa problemas con los `sourcemaps` y puede generar problemas de
especificidad en producción si no se prueban los estilos antes. Ademas el paquete
no recibe actualizaciones desde hace demasiados años (mismo para otros similares).

De momento el paquete se sigue instalando con [npm install](./package.json#L40)
para hacer más pruebas o como opción de compilación manual descomentando las
lineas [105](./gulpfile.js#L105) y/o [118](./gulpfile.js#L118) en [gulpfile.js](./gulpfile.js#L99).

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

### Colores:

Para utilizar los mismos colores en todo el tema con prioridad en la facilidad de
modificarlos en desarrollo, estos están definidos y utilizados como **custom properties**
en [variables.scss](app/assets/scss/abstracts/_variables.scss#L64).

Al utilizar estas variables CSS en [theme.json](app/theme.json#L14) funcionan en
el editor de WordPress y muestra los colores correctamente, pero con el efecto
negativo que aparece la variable como texto y no el código de color.

Una solución sería no quitar las variables generadas por WordPress en [functions.php](app/functions.php#L54)
y utilizar estas en el tema, pero en mi caso prefiero tener mis propios nombres
para evitar sobre-escrituras, tanto por WordPress como plugins externos (ya sufrí
estos problemas en el pasado con un plugin).

La otra sería tener que repetir los colores dos veces de forma manual. En
[theme.json](app/theme.json#L14) y en [variables.scss](app/assets/scss/abstracts/_variables.scss#L44).

Esto sería un poco incomodo, pero fácil de corregir al finalizar el desarrollo
del tema en caso que se quiera dejar algo más intuitivo para personas que sólo
vayan a utilizar el editor de contenido para hacer modificaciones.

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
