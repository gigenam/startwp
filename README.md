```
Theme Name  : StartWP
Theme URI   : https://github.com/gigenam/startwp
Description : Un tema simple para iniciar la creación de otros proyectos
Author      : Marcos Gigena
Author URI  : https://github.com/gigenam
License     : GNU General Public License v2 or later
License URI : https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
```

![GitHub manifest version](https://img.shields.io/github/manifest-json/v/gigenam/startwp?label=Repositorio&logo=github)
![GitHub Workflow Status (branch)](https://img.shields.io/github/workflow/status/gigenam/startwp/npm-run-build/main?label=NPM%20Build)
![Required Node Version](https://img.shields.io/badge/Mínimo->=16.x%20LTS-blue?logo=node.js)
![Required PHP Version](https://img.shields.io/badge/Recomendado->=7.0-blue?logo=php)
![Required WP Version](https://img.shields.io/badge/Recomendado->=6.0-blue?logo=wordpress)
![Tested WP Version](https://img.shields.io/badge/Probado-6.0-lightgrey?logo=wordpress)

# Índice:

- [Documentación](#documentación)
- [Dependencias](#dependencias)
- [Configuración inicial](#configuración-inicial)
- [Empezar a trabajar](#empezar-a-trabajar)
- [Extras](#documentación-adicional)
  - [Localización](#localización)
  - [Plugins](#plugins)
  - [Mantenimiento](#mantenimiento)
  - [Plantillas adicionales](#plantillas-adicionales)
  - [Dependencias](#dependencias)
- [Listo para producción](#listo-para-producción)

<br>

# Documentación

**StartWP** es un tema pensado como plantilla para crear otros temas. Viene con lo
más básico en cuanto a plantillas php y estilos suficientes como para instalar y
que todo funcione bien.

Está desarrollado para ser usado de forma 'tradicional'. No tiene ningún soporte
para FSE (Full Site Editing) e incluso desactiva [algunas cosas](app/functions.php#L47)
por defecto, como los svg para duotone y las variables CSS de WordPress.

> Está incluido el nuevo archivo [theme.json](./app/theme.json), pero principalmente
> para no repetir código o estilos entre el sitio y el editor y para prevenir o
> desactivar [estilos no deseados](app/theme.json#L10).

Este tema cuenta con varios archivos para poder desarrollar mediante varias
automatizaciones realizadas con [Gulp](https://gulpjs.com/docs/en/getting-started/quick-start).
Algunos ejemplos son compilar los estilos de SCSS a CSS, Javascript a JS ES5,
auto refresco de navegador, etc.

<br>

# Dependencias

- [NodeJS](https://nodejs.org/)
- [Gulp](https://gulpjs.com/docs/en/getting-started/quick-start)
- [Browser Sync](https://www.browsersync.io/)
- [Composer](https://getcomposer.org) (opcional)
- [WPCS](https://github.com/WordPress/WordPress-Coding-Standards) (opcional)

## Extensiones recomendadas

Para [Visual Studio Code](https://code.visualstudio.com/) (la mayoría están para
otros editores populares):

- [Prettier](https://marketplace.visualstudio.com/items?itemName=esbenp.prettier-vscode) - [Configurar prettierrc](.prettierrc).
- [EditorConfig](https://marketplace.visualstudio.com/items?itemName=EditorConfig.EditorConfig) - [Configurar editorconfig](.editorconfig).
- [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint) - [Configurar eslintrc](.eslintrc) y [eslintignore](.eslintignore).
- [PHP Sniffer & Beautifier](https://marketplace.visualstudio.com/items?itemName=ValeryanM.vscode-phpsab) - [Configurar composer.json](composer.json).
- [SCSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=mrmlnc.vscode-scss) y [SCSS Formatter](https://marketplace.visualstudio.com/items?itemName=sibiraj-s.vscode-scss-formatter)
- [WordPress Snippets](https://marketplace.visualstudio.com/items?itemName=wordpresstoolbox.wordpress-toolbox) (actions, filters, functions, etc.).

Para [WordPress](https://wordpress.org/):

- [Query Monitor](https://es-ar.wordpress.org/plugins/query-monitor/)
- [Theme Check](https://es-ar.wordpress.org/plugins/theme-check/) (en caso de
  querer redistribuir tu tema en el directorio de temas de WordPress)

<br>

# Configuración inicial

Si ya tienes una instalación de WordPress lista, abre el archivo `wp-config.php`
en la raíz del sitio y activa el modo **DEBUG** (más info en [functions.php](./app/functions.php#L10)).
Además puedes agregar otras opciones para obtener más información en caso de
problemas:

```php
// wp-config.php

define( 'WP_DEBUG', true );
// Opcionales.
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
```

Abre el archivo [package.json](package.json) y modifica todos los valores por
defecto con tus datos. Estos van a ser usados en algunas tareas, por ejemplo el
valor `site` es la url de desarrollo que va a tomar [Browser Sync](https://www.browsersync.io/).

Abre el archivo [composer.json](composer.json) (en caso de querer usar
[WPCS](https://github.com/WordPress/WordPress-Coding-Standards)) y configura los
valores y las rutas apuntando a donde descargaste el proyecto en tu PC.

```jsonc
// composer.json

// Ejemplo de las rutas en diferentes sistemas operativos.

// Windows(*) y macOS:
"phpcs --config-set installed_paths /Users/TU_USUARIO/ruta/a/wpcs",

// Linux:
"phpcs --config-set installed_paths /home/TU_USUARIO/ruta/a/wpcs",

// También puedes hacer la instalación con composer y https://packagist.org/,
// pero yo prefiero tener una carpeta global para ser usada en todos mis proyectos.

// (*) Usando git bash (y creo que PowerShell), sino con CMD las barras deben ser invertidas.
```

Por último abre la carpeta del tema en tu editor y utiliza la funcionalidad de
**Buscar y Remplazar** para cambiar todas las variables, funciones y clases
llamadas con **startwp**.

Que las búsquedas seas sensibles a mayúsculas ya que necesitaras cambiar varios
tipos (`startwp`, `Startwp`, `StartWP`).

> Todos los archivos `README.md` del tema tienen mis datos y la descripción
> genérica, también puedes buscar y remplazar esos textos. Se agradece cualquier
> referencia a este repositorio.

Una vez todo listo, abre una terminal en la carpeta del proyecto y arranca el
comando `npm run start` para instalar todas las dependencias de desarrollo.

\* Si no quieres usar [Composer](https://getcomposer.org), usa el comando
`npm run start:no-composer` para evitar errores de instalación.

\*\* Los archivos [CHANGELOG.md](CHANGELOG.md) y [manifest.json](manifest.json)
en la raíz del proyecto son sólo para mostrar [cierta información](index.js) y
llevar registro de la versión y los cambios del repositorio. Para registrar tus
propios cambios, utiliza el archivo [CHANGELOG.md](app/CHANGELOG.md) dentro de
`app/`.

<br>

## Configuración adicional de plugins

Para auto formatear todos los archivos utilizando los [mismos plugins en VSCode](#extensiones-recomendadas),
puedes agregar los siguientes parametros a tu configuración.

Abre la paleta de comandos (`control + shift + p`) y busca `settings.json`.
Añade el siguiente código:

```jsonc
// settings.json (VS Code)

{
  // ...
  // Otras configuraciones tuyas (revisa que no se repitan las opciones).
  // ...

  "editor.formatOnSave": true,
  "editor.formatOnPaste": true,
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true
  },
  "[scss]": {
    "editor.defaultFormatter": "sibiraj-s.vscode-scss-formatter"
  },
  "[json]": {
    "editor.defaultFormatter": "esbenp.prettier-vscode"
  }
}
```

<br>

# Empezar a trabajar

Una vez todo listo e instalado, arranca el comando `npm run dev` para iniciar el
servidor local con [Browser Sync](https://www.browsersync.io/) y vigilar todos
los archivos SCSS, JS y PHP.

Para hacer cambios en los archivos sin necesidad de arrancar
[Browser Sync](https://www.browsersync.io/), utiliza el comando `npm run watch`.

Una vez todo listo para pasar a producción, utiliza el comando `npm run build`
el cual comprimirá todos los archivos para ser subidos al sitio final. Más info
al final de este documento.

<br>

# Documentación adicional

Este tema está basado en [underscores](https://github.com/automattic/_s) y creado
bajo los [estándares de código de WordPress](https://developer.wordpress.org/coding-standards/).
Esto significa que todos los archivos del proyecto están bien documentados y
formateados de forma consistente (con la ayuda de las extensiones y configuraciones
anteriores). En todas partes del tema encontraras archivos `README.md` con algo
más de información.

Además, se incluyen algunos extras tanto en el tema como fuera de este.

## Localización

El tema está preparado para poder localizar varios textos. Estos están por defecto
en ingles porque es más fácil dejar ese por defecto y luego agregar los necesarios
en tu idioma que al revés (a menos que no te importe el soporte multi idioma).
Además el tema cuenta con dos traducciones por defecto, es_ES y es_AR.

Para más información puedes ver la tarea en [gulpfile.js](./gulpfile.js#L191)
y la carpeta `app/languages/` y buscar todas las funciones de textos traducibles
(`__()`, `_e()`, etc). Para más información, revisar la [documentación oficial](https://developer.wordpress.org/themes/functionality/internationalization/)
(En ingles) y el archivo [README.md](app/languages/README.md).

## Plugins

Cualquier plugin que siga los mismos [estándares de código de WordPress](https://developer.wordpress.org/coding-standards/)
no debería generar problemas de compatibilidad. Por cuestión de reutilización
frecuente, los únicos plugins soportados parcialmente son:

- [Contact Form 7](https://wordpress.org/plugins/contact-form-7/)
- [MetaSlider](https://wordpress.org/plugins/ml-slider/)
- [Slide Anything](https://wordpress.org/plugins/slide-anything/)

Los estilos personalizados de los tres plugins vienen comentados por defecto.
Revisa el archivo [main.scss](./app/assets/scss/main.scss#L24) y cada archivo
dentro de `app/assets/scss/plugins/`.

## Mantenimiento

En la carpeta `maintenance` hay varios archivos para personalizar el aspecto del
sitio tanto cuando todavía no lo tienes listo ([index.html](./maintenance/index.html)),
como cuando WordPress está actualizando y quieres evitar la pantalla en blanco
genérica.

## Plantillas adicionales

En la carpeta `templates` encontraras carpetas con archivos de ayuda para crear
la imagen que se mostrará en la sección de temas de la administración
([screenshot.png](./app/screenshot.png)), las imágenes genéricas que se mostraran
al compartir tu sitio por redes sociales, los favicons y otras plantillas php.

## Actualizar dependencias

Siempre crea una copia de seguridad de [package.json](package.json) y
[composer.json](composer.json) o genera un nuevo commit o rama antes por si los
paquetes actualizados rompen algo.

Para mantener los paquetes al día, puedes usar los siguientes comandos.

**npm**:

a)

- `npm outdated` : Verifica si tienes paquetes desactualizados.
- `npm update` : Actualiza a los paquetes de forma segura sin subir de versión
  mayor\*.

b)

- `npm install -g npm-check-updates` : Instala el paquete global (sudo en linux/mac).
- `ncu` : Verifica si tienes paquetes desactualizados.
- `ncu -u` : Actualiza a las últimas versiones en [package.json](package.json).
- `npm install` : Instala los paquetes a las últimas versiones.

**composer**:

- `composer outdated` : Verifica si tienes paquetes desactualizados.
- `composer update` : Actualiza a los paquetes de forma segura sin subir de
  versión mayor\*.

\* Siempre que las vesiones contengan el simbolo `^`. Si lo quitas, puedes subir
a la siguiente versión mayor.
<br>

# Listo para producción

Una vez que tengas tu tema listo, tienes algunas automatizaciones y archivos para
facilitar la forma de preparar todo para producción y futuras actualizaciones.

Al utilizar el comando `npm run build`, además de comprimir todos los archivos de
estilos, scripts e imágenes, se modifica la versión en [style.css](app/style.css#L8)
desde [package.json](package.json#L5). Esto es importante porque una vez que
desactives el modo `WP_DEBUG` para tu sitio final, todos los archivos de estilos
y scripts var a tener la versión del tema.

Al hacer actualizaciones, sólo tienes que cambiar la versión de tu proyecto en un
solo lugar ([package.json](package.json#L5)), compilar y subir los archivos
modificados que con la nueva versión no vas a tener problemas en que los cambios
se actualicen correctamente (a menos que utilices plugins adicionales para
aumentar la velocidad del sitio).

_atte._ **MG**
