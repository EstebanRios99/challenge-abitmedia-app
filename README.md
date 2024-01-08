# Documentación para la Ejecución y Funcionamiento del Proyecto

## Instalación y Ejecución

### Requisitos para la Instalación

- [XAMPP V8.1.12](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.1.12/xampp-windows-x64-8.1.12-0-VS16-installer.exe/download).
- [Composer](https://getcomposer.org/download/).
- [Visual Studio Code](https://code.visualstudio.com/download).

### Pasos para la Instalación y Ejecución

**1.** Instalar Composer y luego configurar la variable de entorno **PATH** para que el ejecutable de Laravel pueda ser localizado en el sistema. 

- **macOS:** $HOME/.composer/vendor/bin
- **Distribuciones GNU/Linux:** $HOME/.config/composer/vendor/bin o $HOME/.composer/vendor/bin
- **Windows:** %USERPROFILE%\AppData\Roaming\Composer\vendor\bin

**2.** Instalar la versión de XAMPP.

**3.** Clonar el proyecto en el directorio que usted lo requiera utilizando el comando **git clone https://github.com/EstebanRios99/challenge-abitmedia-app.git**.

**4.** Abrir la carpeta del proyecto en un editor de código de preferencia **Visual Studio Code** y en el terminal ejecutar el comando **composer install**.

**5.** Dentro de la carpeta principal del proyecto crear el archivo **.env** y copiar la información del archivo **.env.example**.

**6.** Ejecutar los comandos **php artisan key:generate** y **php artisan jwt:secret**.

**7.** Ejecutar XAMPP e inicializar Apache y MySQL tal como se muestra en la imagen.
![xampp](https://github.com/EstebanRios99/challenge-abitmedia-app/tree/master/public/img_readme/xampp.png)

**Nota:** En el caso de que exista conflictos con el puerto 80 se debe cambiar el puerto y para esto se deben seguir los siguientes pasos.

    **7.1** Dentro de XAMPP ir a la sección **Config** y seleccionar la opción **`Apache (httpd.config)`** tal como se muestra en la imagen.
    ![config 1](https://github.com/EstebanRios99/challenge-abitmedia-app/tree/master/public/img_readme/config_p1.png)

    **7.2** En el archivo buscar **Listen 80** y cambiar el puerto 80 por cualquier otro, por ejemplo 85 guardar y volver a inizializar el Apache.
    ![config 2(https://github.com/EstebanRios99/challenge-abitmedia-app/tree/master/public/img_readme/config_p2.png)

**8.** Abrir el Admin de MySQL **http://localhost/phpmyadmin/**, en el caso que se haya realizado la configuración del puerto la ruta será: **http://localhost:[puerto]/phpmyadmin/** `(http://localhost:85/phpmyadmin/)` y dar clic en la opcion **Nuevo**.
![bd_1](https://github.com/EstebanRios99/challenge-abitmedia-app/tree/master/public/img_readme/bd_p1.png)

**9.** Asignar el nombre **abitmedia** a la Base de Datos y dar clic en **Crear**.
![bd_2](https://github.com/EstebanRios99/challenge-abitmedia-app/tree/master/public/img_readme/bd_p2.png)

**10.** Finalmente ejecutar el comando **php artisan migrate:refresh --seed** y ya se podrá utilizar cada una de las APIs.

## Funcionamiento
