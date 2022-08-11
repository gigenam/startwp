/* eslint-disable */
import info from './package.json' assert {'type':'json'};

console.info(
'\x1b[2m%s\x1b[0m', `
/**
 * Bienvenido/a a las herramientas de desarrollo de ${ info.name }
 *
 * @link    ${ info.repository.url }
 * @docs    README.md
 * @version ${ info.version }
 */

\x1b[0m Comandos básicos para empezar a trabajar: \n
\x1b[32m npm run start : \n \x1b[0m    Instala todas las dependencias de desarrollo y configura la información básica del tema (ver package.json). \n
\x1b[32m npm run dev   : \n \x1b[0m    Arranca un servidor local, compila y vigila varios archivos para desarrollar con varias automatizaciones. \n
\x1b[32m npm run watch : \n \x1b[0m    Compila y vigila varios archivos para desarrollar. \n
\x1b[32m npm run build : \n \x1b[0m    Compila y comprime archivos e imágenes para producción. \n
`);
