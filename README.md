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
![Image Text](https://github.com/EstebanRios99/challenge-abitmedia-app/blob/master/public/img_readme/xampp.png)

**Nota:** En el caso de que exista conflictos con el puerto 80 se debe cambiar el puerto y para esto se deben seguir los siguientes pasos.

**7.1** Dentro de XAMPP ir a la sección **Config** y seleccionar la opción **`Apache (httpd.config)`** tal como se muestra en la imagen.
    ![Image Text](https://github.com/EstebanRios99/challenge-abitmedia-app/blob/master/public/img_readme/config_p1.png)

**7.2** En el archivo buscar **Listen 80** y cambiar el puerto 80 por cualquier otro, por ejemplo 85 guardar y volver a inizializar el Apache.
    ![Image Text](https://github.com/EstebanRios99/challenge-abitmedia-app/blob/master/public/img_readme/config_p2.png)

**8.** Abrir el Admin de MySQL **http://localhost/phpmyadmin/**, en el caso que se haya realizado la configuración del puerto la ruta será: **http://localhost:[puerto]/phpmyadmin/** `(http://localhost:85/phpmyadmin/)` y dar clic en la opcion **Nuevo**.
![Image Text](https://github.com/EstebanRios99/challenge-abitmedia-app/blob/master/public/img_readme/bd_p1.png)

**9.** Asignar el nombre **abitmedia** a la Base de Datos y dar clic en **Crear**.
![Image Text](https://github.com/EstebanRios99/challenge-abitmedia-app/blob/master/public/img_readme/bd_p2.png)

**10.** Finalmente ejecutar el comando **php artisan migrate:refresh --seed** y ya se podrá utilizar cada una de las APIs.

## Funcionamiento

### Login (Obtener JWT Token)

Para poder utilizar las demás funciones del proyecto primero se debe iniciar sesión con las siguientes credenciales para obtener el token de acceso.

**URL:** `http://127.0.0.1:8000/api/login`

**Type:** POST

**Body:**
```json
{
    "email":"admin@pruebas.com",
    "password":"soporte1"
}
```

**Respuesta Correcta**
```json
{
   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzA0NjUwODA2LCJleHAiOjE3MDQ2NTQ0MDYsIm5iZiI6MTcwNDY1MDgwNiwianRpIjoiU3U3NFl3OXFpRFVTVHpCdyIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.tW7OLsqvfGF1LobU_7Dq0WzFgLiW-HDW7A5plnZbPxs"
}
```
**Respuesta Incorrecta**
```json
{
    "error": "invalid credentials"
}
```

### Obtener Productos
Devuelve una lista completa con todos los productos que se encuentran registrados.

**URL:** `http://127.0.0.1:8000/api/products`

**Type:** GET

**Authorization:** De tipo Bearer, se debe utilizar el token devuelto por el api de login.

**Respuesta Correcta**
```json
[
    {
        "id": 1,
        "name": "Antivirus W1 Edit",
        "price": 5,
        "so": "Windows",
        "license": "SAieNVeCtQRRQ4WiH03j3Z5nDudag8JvUu9cK1S0a2CGgg7EZi6xRthnTXyFt5xPJY0hiiHSDhNdFoEUowFfWuOMPdH57FwOhXkT",
        "sku": "1234567890",
        "type": "1",
        "is_delete": "1",
        "type_name": "software",
        "delete": "Eliminado"
    },
    {
        "id": 2,
        "name": "Antivirus W2",
        "price": 5,
        "so": "Windows",
        "license": "mkCSvDcv3DcnXipftKj3saXTQlm3yqYMj7e6uivMw6d4qC0IGyrZCBRdswBSf7njEmLjZ06NtLuUh7G09moD5KX7MQgeFfQ3Ar7t",
        "sku": "5891633911",
        "type": "1",
        "is_delete": "0",
        "type_name": "software",
        "delete": ""
    }
]
```
**Respuesta Incorrecta**
```json
{
    "error": "token_invalid"
}
```

### Obtener Producto por SKU
Obtener la información de un producto en específico utilizando el SKU registrado.

**URL:** `http://127.0.0.1:8000/api/product/{sku}`

**Ej URL:** `http://127.0.0.1:8000/api/product/1234567890`

**Type:** GET

**Authorization:** De tipo Bearer, se debe utilizar el token devuelto por el api de login.

**Respuesta Correcta**
```json
{
    "status": "ok",
    "response": {
        "id": 1,
        "name": "Antivirus W1 Edit",
        "price": 5,
        "so": "Windows",
        "license": "SAieNVeCtQRRQ4WiH03j3Z5nDudag8JvUu9cK1S0a2CGgg7EZi6xRthnTXyFt5xPJY0hiiHSDhNdFoEUowFfWuOMPdH57FwOhXkT",
        "sku": "1234567890",
        "type": "1",
        "is_delete": "1",
        "type_name": "software",
        "delete": "Eliminado"
    }
}
```
**Respuesta Incorrecta**
```json
{
    "error": "token_invalid"
}
```

### Crear Producto
Registrar un nuevo producto para la venta.

**URL:** `http://127.0.0.1:8000/api/product`

**Type:** POST

**Authorization:** De tipo Bearer, se debe utilizar el token devuelto por el api de login.

**Body:**
```json
{
    "name" : "Antivirus W11",
    "price" : 6,
    "type" : 1,
    "sku" : 4538587211,
    "so" : "Windows"
}
```

**Notas:**
- **name:** Nombre que va a llevar el producto.
-  **price:** Valor que tendrá el producto, debe ser un valor numérico.
- **type:** El campo **type** representa si el tipo de producto que se va a crear, **1** para el caso de una licencia software y **2** para un servicio.
- **sku:** Identificador único de cada producto, debe ser de 10 caracteres.
- **so:** El campo **so** se utiliza para cuando se vaya a crear una nueva licencia, es decir, el campo **type** es de tipo 1, en caso que se vaya a crear un nuevo servicio se puede omitir o enviar un valor vacío.

**Respuesta Correcta**
```json
{
    "status": "ok",
    "response": {
        "name": "Capacitaciones del sistema",
        "price": 40,
        "so": null,
        "license": null,
        "sku": 4538587216,
        "type": 2,
        "is_delete": "0",
        "id": 126
    }
}
```
**Respuesta Incorrecta**
```json
{
    {
        "error": "data_validation_failed",
        "error_list": {
            "sku": [
                "The sku must be at least 10 characters."
            ]
        }
    }
}
```

### Actualizar Producto por SKU
Actualizar la información de uno de los porductos utilizando el SKU registrado, se puede actualizar el nombre, precio y sku.

**URL:** `http://127.0.0.1:8000/api/product/{sku}`

**Ej URL:** `http://127.0.0.1:8000/api/product/4538587210`

**Type:** PUT

**Authorization:** De tipo Bearer, se debe utilizar el token devuelto por el api de login.

**Body**
```json
{
    "name" : "Mantenimiento de redes Edit",
    "sku" : 4538587210,
    "price": 45
}
```

**Nota:** En caso que no se requiera modificar uno de los campos permitidos no se debe enviar esa información.

**Respuesta Correcta**
```json
{
    "status": "ok",
    "response": {
        "id": 124,
        "name": "Mantenimiento de redes Edit",
        "price": 45,
        "so": null,
        "license": null,
        "sku": 4538587210,
        "type": "2",
        "is_delete": "0"
    }
}
```
**Respuesta Incorrecta**
```json
{
    "error": "token_invalid"
}
```

### Eliminar Producto por SKU
Eliminar o desactivar uno de los productos utilizando el SKU registrado.

**URL:** `http://127.0.0.1:8000/api/product/{sku}`

**Ej URL:** `http://127.0.0.1:8000/api/product/4538587210`

**Type:** PUT

**Authorization:** De tipo Bearer, se debe utilizar el token devuelto por el api de login.

**Nota:** El campo **is_delete** cambiará su estado a 1, lo que quiere decir que el producto se encuentra eliminado.

**Respuesta Correcta**
```json
{
    "status": "ok",
    "response": {
        "id": 124,
        "name": "Mantenimiento de redes Edit",
        "price": 35,
        "so": null,
        "license": null,
        "sku": "4538587210",
        "type": "2",
        "is_delete": "1"
    }
}
```
**Respuesta Incorrecta**
```json
{
    "error": "token_invalid"
}
```
