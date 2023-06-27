/* eslint-disable */
import info from './manifest.json' assert { 'type': 'json' };

console.info(
	'\x1b[2m%s\x1b[0m',
	`
/**
 * \x1b[37;1mBienvenido/a a las herramientas de desarrollo de ${info.name}.\x1b[39m
 *
 * @link    \x1b[34m${info.repository.url}\x1b[39m
 * @docs    README.md
 * @version \x1b[32;1m${info.version}\x1b[39m
 */

\x1b[0m Comandos básicos para empezar a trabajar: \n
\x1b[32m npm run start : \n \x1b[0m    Instala todas las dependencias de desarrollo y configura la información básica del tema (ver package.json). \n
\x1b[32m npm run dev   : \n \x1b[0m    Arranca un servidor local, compila y vigila varios archivos para desarrollar con varias automatizaciones. \n
\x1b[32m npm run watch : \n \x1b[0m    Compila y vigila varios archivos para desarrollar. \n
\x1b[32m npm run build : \n \x1b[0m    Compila y comprime archivos e imágenes para producción. \n
`
);
