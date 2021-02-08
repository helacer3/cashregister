# API Caja registradora - Symfony 5.2.3

Se realiza el desarrollo de la API teniendo con la siguiente estructura:

- Base Class        = Clases base para estandarizar el formato de las respuestas de la API, inyección de dependencias, etc
- Controller        = Controlador CashController para el acceso a los diferentes verbos de la API
- CashRegisterClass = Clase que actual como puente para la interacción entre el controlador y el BL encargado de interactuar con la BD
- CashRegisterBL    = Clase encarga de la interacción con las diferentes entidades de la BD
- Entity/*          = Entidas que corresponden al mapeo de las tablas de la bd.  

## Comentarios:

- Para validar el funcionamiento de la API puede acceder haciendo uso de la colección postman ubicada en el directorio postman en la raiz del proyecto
- El script inicial de la base de datos lo encontrará en el directorio SQL, en la raiz del proyecto

### Requisitos🔧

- PHP >= 7.4
- MySQL
- Composer
- Postman (Para probar los Request)

### Instalación 🔧

_ clonar el proyecto

- configurar los datos de conexión a MySQL en el archivo .env, parámetro: DATABASE_URL.

_ composer update para descargar los paquetes necesario

_ configurar los parámetros de conexión a la base de datos, en el archivo: .env