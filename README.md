<div align="center">
  <div>
    <img style="background-color: #000; display: inline-block; padding: 10px; border-radius: 8px;" width="500" src="assets/logo.png" alt="Snowworm Logo">
  </div>
  <br>
  <br>
  <h1 width="200">Prueba Técnica - Desarrollador Fullstack Senior</h1>
  <p>Demuestra tu experiencia construyendo un sistema robusto, seguro y escalable de nivel empresarial.</p>
  <br>
</div>

## 🎯 Objetivos de Evaluación

Esta prueba busca medir tu capacidad para:

1. Diseñar arquitecturas desacopladas y escalables
2. Implementar seguridad avanzada y estrategias de autenticación modernas
3. Aplicar patrones y principios de arquitectura empresarial
4. Construir un sistema distribuido con rendimiento y mantenibilidad
5. Entregar una solución con documentación profesional y pruebas automatizadas

---

## 📋 Requisitos Técnicos

### 🔐 Autenticación y Seguridad Avanzadas
- [ ] Login con OAuth 2.0 usando Laravel Passport
- [ ] TOTP para autenticación 2FA (Time-based One-Time Password)
- [ ] Roles y permisos configurables (Admin, Staff, Operador, Auditor)
- [ ] Middleware avanzado para control de acceso por permiso
- [ ] Rate Limiting personalizado (por IP y usuario)
- [ ] Auditoría de accesos y acciones críticas (registro en tabla y log)
- [ ] Recuperación segura de contraseña con token expirable y validación de dispositivo

### 🛍️ Gestión de Productos y Catálogo
- [ ] CRUD completo para productos con:
  - SKU único
  - Nombre (máximo 100 caracteres, requerido)
  - Descripción larga (opcional)
  - Precio y costo (decimales, requeridos)
  - Tipo de producto: individual o con variantes
  - Imágenes (mínimo 3 por producto)
  - Categorías anidadas hasta 3 niveles (selección múltiple)
  - Relación con Proveedores disponibles
  - Variantes (ej. tallas, colores) y tipos de variante relacionados (creados al momento)
  - Generación automática de combinaciones de variantes
- [ ] Buscador avanzado con filtros combinables (categoría, proveedor, stock, precio)
- [ ] SoftDelete y auditoría de cambios
- [ ] Exportación de catálogo a Excel/CSV

### 🧩 Gestión de Categorías, Proveedores, Variantes y Tipos de Variante
- [ ] **Categorías:** CRUD con subcategorías (hasta 3 niveles), búsqueda y visualización jerárquica.
- [ ] **Proveedores:** CRUD con campos validados (nombre, email único, teléfono, dirección).
- [ ] **Variantes:** CRUD con campo nombre, búsqueda y soft delete.
- [ ] **Tipos de Variante:**
  - Relacionados a una variante padre.
  - CRUD completo con validación y vinculación estricta.
  - Se crean al momento de crear la variante o por separado.
  - Vista de árbol mostrando tipos asociados.
- [ ] **Validaciones Avanzadas:** Reglas específicas por tipo de entidad (longitud, unicidad, formatos).
- [ ] **Notificaciones visuales** y retroalimentación en acciones de CRUD.
- [ ] SoftDelete implementado en todas las entidades para mantener histórico sin eliminación física.
- [ ] CRUD completo con búsqueda paginada, filtros, y softdelete
- [ ] Validaciones estrictas (nombre, relaciones válidas, emails únicos, etc.)
- [ ] Visualización en árbol para subcategorías y tipos de variante anidados

### 🧠 Gestión de Inventario Multi-Bodega
- [ ] CRUD de bodegas (nombre y dirección obligatorios)
- [ ] Transferencias entre bodegas con validación de stock
- [ ] Historial detallado de entradas, salidas y ajustes por producto
- [ ] Alertas por stock bajo configurables por bodega
- [ ] Reporte de valorización y rotación de inventario por periodo
- [ ] Multi-tenant: cada empresa maneja sus propias bodegas y productos

### 📦 Gestión de Pedidos Avanzada
- [ ] CRUD de pedidos con seguimiento de estados (incluye historial)
- [ ] Asociación con usuario comprador y productos con cantidades
- [ ] Envío de notificaciones por cambio de estado (Mailtrap)
- [ ] Procesamiento asíncrono vía jobs
- [ ] Reajuste automático de inventario según estado final del pedido

### 📱 Frontend Interactivo y Escalable
- [ ] Dashboard con métricas clave (bajo stock, pedidos recientes, ventas totales)
- [ ] CRUDs completos con formularios avanzados y validación en tiempo real
- [ ] Paginación, filtros persistentes y ordenamiento dinámico
- [ ] Gestión de estado global (Context/Redux)
- [ ] Soporte de internacionalización (i18n)
- [ ] Diseño responsive y accesible (uso de Tailwind recomendado)
- [ ] Animaciones básicas para UX
- [ ] WebSockets para tiempo real (pedidos, stock)
- [ ] Modo offline (opcional, suma puntos)

### ⚙️ Backend Empresarial
- [ ] Arquitectura desacoplada: Service Layer, Repository Pattern
- [ ] Jobs, Events, Listeners, Observers
- [ ] API RESTful documentada (Postman/Swagger)
- [ ] Validaciones con Form Requests
- [ ] Caching avanzado con Redis
- [ ] Lazy/Eager loading estratégico
- [ ] Opcional: GraphQL (complementando REST)

### 🧪 Pruebas y Calidad
- [ ] Pruebas unitarias y funcionales backend (mín. 5 bien justificadas)
- [ ] Pruebas E2E frontend (mín. 5 con herramientas como Cypress)
- [ ] Tipado estático y uso de linter (TypeScript recomendado en frontend)

5. **Eventos en Tiempo Real**

   - Agregar WebSockets para actualizaciones en tiempo real en el frontend cuando se modifiquen pedidos o inventario.

6. **Optimización y Performance**

   - Agregar cacheo avanzado con Redis para consultas frecuentes de productos e inventario.
   - Implementar lazy loading y eager loading en Eloquent para optimizar consultas.

---

## 🧰 Tecnologías Recomendadas

| Área         | Tecnologías                                                                 |
|--------------|-----------------------------------------------------------------------------|
| Backend      | Laravel (actual), Laravel Passport, Redis, MySQL/PostgreSQL                     |
| Frontend     | React Native o Web (React 18+ preferido)                                   |
| Base de Datos| MySQL 8+ o PostgreSQL                                                      |
| Cache        | Redis                                                                      |
| Correo       | Mailtrap                                                                   |
| CI/CD        | Github Actions (opcional)                                                  |
| Docker       | Contenedorización opcional                                                 |

---

## 📦 Entregables Requeridos

1. **Repositorio Git** con:
   - Código backend y frontend organizado
   - Migraciones y seeders
   - Instrucciones completas de instalación

2. **README.md** que incluya:
   - Explicación técnica de arquitectura y decisiones
   - Tecnologías utilizadas
   - Instrucciones detalladas para su instalación


3. **Documentación Técnica**:
   - Diagrama ERD
   - Diagrama de flujo de pedidos e inventario
   - API Docs (Swagger/Postman)

4. **Pruebas Automatizadas**:
   - Backend: Unitarias, integración, factories
   - Frontend: E2E (Cypress o similar)

---

## 📊 Criterios de Evaluación

| Categoría             | Peso  | Detalles                                                                |
|-----------------------|-------|-------------------------------------------------------------------------|
| Funcionalidad         | 30%   | Implementación completa y funcionalidad operativa                      |
| Arquitectura          | 25%   | Escalabilidad, patrones, separación de capas                           |
| Seguridad             | 15%   | OAuth, 2FA, control de acceso, auditoría                               |
| Calidad de Código     | 15%   | Buenas prácticas, tipado, pruebas automatizadas                        |
| Documentación         | 10%   | Claridad, diagramas, justificación técnica                             |
| Entorno DevOps (Extra)| 5%    | Docker, CI/CD, cobertura, despliegue                                  |

---

## ⏱️ Tiempo y Entrega

- **Duración estimada:** 4-5 días de trabajo efectivo
- **Plazo máximo:** 7 días hábiles desde la asignación
- **Proceso:**
  1. Fork del repositorio base
  2. Desarrollo en branch con tu nombre (ej. `alex-senior`)
  3. Pull Request al repositorio original
  4. Incluir en la descripción del PR:
     - Tiempo invertido
     - Dificultades encontradas
     - Extras implementados

---

## 🧠 Extras Avanzados (Opcionales)

- Microservicios desacoplados
- Integración con servicios externos (ej. facturación, ERP)
- CI/CD con Github Actions o Gitlab CI
- Despliegue en Cloud (AWS/GCP/Azure)
- Documentación Swagger con seguridad OAuth2
- Auditoría con logs y backups automáticos

---

## ❓ FAQ

**¿Puedo usar otra tecnología frontend?**  
Sí, justifícalo en el README.

**¿Debo usar Docker?**  
Opcional, pero suma puntos y facilita el despliegue.

**¿Se puede usar alguna plantilla?**  
Solo visual. El código de lógica debe ser original.

**¿Puedo entregar en menos de 7 días?**  
¡Claro! Apreciamos entregas tempranas si están bien hechas.

---

**¡Esperamos ver tu mejor trabajo! 🚀**