<div align="center">
   <div >
      <img style="background-color: #000; display: inline-block; padding: 10px; border-radius: 8px;" width="500" src="assets/logo.png" alt="Snowworm Logo">
   </div>
   <br>
   <br>
    <h1 width="200">Desarrollador Fullstack</h1>
   <p>La siguiente es una prueba para evaluar a aspectos técnicos de los candidatos a desarrollador Fullstack <b>Senior</b>.</p>
   <br>
</div>


## Objetivo de la Prueba

El objetivo de esta prueba es evaluar la capacidad del candidato para diseñar e implementar un sistema avanzado, con énfasis en la escalabilidad, seguridad y optimización. Se espera que el candidato pueda trabajar con **Laravel** para construir un backend robusto y seguro, así como un frontend funcional con **React Native** (u otra tecnología de su elección). Además, deberá implementar estrategias avanzadas de manejo de datos y pruebas automatizadas.

---

## Requisitos de Desarrollo

### Funcionalidades Principales

1. **Autenticación y Seguridad**

   - Implementar un sistema de autenticación utilizando OAuth 2.0 con Laravel Passport.
   - Crear roles configurables (e.g., Admin, Usuario Básico).
   - Proteger rutas de la API según los roles de usuario.
   - Implementar TOTP (Time-based One-Time Password) para autenticación de dos factores.
   - Limitar intentos de login por usuario con rate limiting en Laravel.

2. **Gestión de Productos con Control de Inventarios Avanzado**

   - CRUD (crear, leer, actualizar y eliminar) para productos mediante la API.
   - Validar los siguientes campos:
     - **Nombre**: Texto corto, obligatorio.
     - **Descripción**: Texto largo, opcional.
     - **Precio**: Decimal, obligatorio.
     - **Cantidad en Inventario**: Número entero, obligatorio (mínimo de 0).
   - Funcionalidades avanzadas:
     - **Alertas de inventario bajo**: Enviar notificaciones por correo electrónico cuando la cantidad de inventario de un producto sea menor a un umbral definido.
     - **Historial de movimientos**: Registrar aumentos y disminuciones de inventario, incluyendo:
       - Cantidad modificada.
       - Fecha y hora de la modificación.
       - Usuario que realizó la acción.

3. **Gestión de Pedidos**

   - Crear, leer y listar pedidos asociados a los productos.
   - Cada pedido debe incluir:
     - Productos comprados (con cantidades).
     - Usuario que realizó el pedido.
     - Estado del pedido (Pendiente, Procesado, Completado, Cancelado).
     - Fecha de creación y última actualización.
   - Enviar un correo electrónico de confirmación al usuario cuando el pedido cambie de estado.
   - Procesamiento asíncrono de pedidos usando colas y jobs en Laravel.
   - Aumentar la cantidad de productos en inventario cuando se complete un pedido.
   - Soporte para Multi-Tenancy, donde cada empresa tenga su propio inventario separado.

4. **Frontend con React Native**

   - Crear una interfaz de usuario en React Native que permita:
     - Iniciar sesión y gestionar el token de autenticación.
     - Visualizar el listado de productos con paginación optimizada.
     - Buscar productos por nombre o descripción.
     - Poder ordenar o filtrar los productos con los siguientes criterios:
         - Por precio.
         - Por cantidad en inventario.
         - Por rango de precios.
     - Crear, editar y eliminar productos.
     - Gestionar inventarios con historial de movimientos.
     - Consultar y gestionar pedidos, incluyendo su cambio de estado.
   - Opcional: Implementar GraphQL en vez de REST para mejorar la eficiencia en el consumo de la API.
   - Implementar internacionalización (i18n) en el frontend.
   - Opcional: Incluir un modo offline en el frontend.
   - En caso de no utilizar React Native, se puede emplear otra tecnología o método para el frontend, explicando en el archivo `README.md` los motivos de la elección.

5. **Eventos en Tiempo Real**

   - Agregar WebSockets para actualizaciones en tiempo real en el frontend cuando se modifiquen pedidos o inventario.

6. **Optimización y Performance**

   - Agregar cacheo avanzado con Redis para consultas frecuentes de productos e inventario.
   - Implementar lazy loading y eager loading en Eloquent para optimizar consultas.

---

## Restricciones

- No está permitido el uso de paquetes externos para las funcionalidades principales descritas, como autenticación, CRUD o gestión de roles. Se deben utilizar exclusivamente las herramientas nativas de Laravel y el framework elegido.
- **Excepciones:**
  - Uso de librerías externas para la navegación en el frontend.
  - Se debe utilizar **Mailtrap** para las notificaciones por correo electrónico.

---

## Tecnologías y Herramientas

- **Backend:** Laravel (versión 11).
- **Frontend:** React Native (preferentemente) o alguna otra tecnología elegida por el candidato.
- **Base de Datos:** MySQL o PostgreSQL (a elección del candidato).
- **Autenticación:** Laravel Sanctum.
- **Control de Versiones:** Git.
- **Servicio de Correos:** Mailtrap.

---

## Entregables Requeridos

1. **Repositorio de Código:**

   - Subir el código fuente al repositorio indicado en las intrucciones.

2. **Archivo `README.md`:**

   - Instrucciones claras para configurar y ejecutar el proyecto localmente, tanto para el backend como para el frontend.
   - Descripción de las decisiones técnicas tomadas durante el desarrollo.
   - Lista de las tecnologías utilizadas.
   - Instrucciones para configurar Mailtrap en el archivo `.env`.

3. **Pruebas Automatizadas:**

   - Implementar pruebas unitarias y funcionales para el backend y/o frontend.

4. **Demostraciones Visuales:**

   - Capturas de pantalla o videos que muestren:
     - Uso del sistema de autenticación y gestión de roles.
     - Gestión avanzada de inventarios.
     - CRUD de productos.
     - Creación y gestión de pedidos.
     - Envío de notificaciones por correo electrónico mediante Mailtrap.

---

## Criterios de Evaluación

1. **Funcionalidad:**
   - Verificar que todas las funcionalidades descritas estén implementadas y funcionando correctamente.

2. **Diseño:**
   - Interfaz simple, funcional y atractiva utilizando Tailwind CSS.

3. **Calidad del Código:**
   - Evaluar el uso de buenas prácticas en Laravel y React Native (o la tecnología elegida).
   - Organización del código y modularidad.

4. **Calidad del control de versiones:**

   - Uso de git flow para la creación los commits del proyecto.
   - Títulos descriptivos para los commits del proyecto.
   - Uso de las diferentes funcionalidades de gitflow para todas las carácteriticas del proyecto según se necesite.

5. **Documentación:**
   - Revisar que el archivo `README.md` sea claro, completo y bien estructurado.

6. **Extras Opcionales:**
   - Uso de Docker para facilitar la configuración y despliegue del proyecto (En caso de implementar docker incluir las instrucciones necesarias para su ejecución en el archivo `README.md` del proyecto).
   - Implementación de cacheo para optimizar la API.

---

## Tiempo Estimado para la Prueba

Se estima que el desarrollo de esta prueba puede tomar alrededor de **3 días**. Para mayor flexibilidad, se otorgará un plazo de **7 días hábiles** para su entrega, permitiendo al candidato administrar su tiempo de manera eficiente.

---

## Proceso de Entrega

1. El candidato debe realizar un fork de este repositorio (https://github.com/snowworm-mx/prueba-senior).
2. Una vez completada la prueba, debe realizar un pull request (PR) al repositorio original . 
   * El PR debe incluir:
      * Un título descriptivo (e.g., "Implementación de funcionalidades de gestión de inventario").
      * Una descripción detallada de las funcionalidades implementadas y cualquier consideración técnica adicional.

---

**¡Éxito!**
