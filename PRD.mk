# Product Requirements Document (PRD) - App de Gestión para Canchas de Fútbol

## 1. Resumen del Proyecto
El objetivo es desarrollar una aplicación web para la administración integral de un complejo de canchas de fútbol. El sistema permitirá gestionar las reservas de las canchas, controlar el inventario y ventas de la despensa (kiosco/bar), y llevar un control financiero detallado del negocio.

## 2. Stack Tecnológico Definido
* **Backend:** Laravel (PHP)
* **Base de Datos:** MySQL (aprovechando Eloquent ORM para las relaciones)
* **Frontend / Estilos:** Tailwind CSS (integrado con vistas Blade)

## 3. Funcionalidades Principales (Core Features)

### 3.1. Módulo de Reservas de Canchas
* **Gestión de Turnos:** Capacidad para visualizar, crear, editar y cancelar reservas.
* **Control de Pagos:**
    * Registro del precio total de la reserva.
    * Ingreso de "Seña" (pago por adelantado) y cálculo automático del saldo restante.
    * Marcador de estado de pago (Pendiente, Seña Pagada, Pagado en su totalidad).
    * Registro del método de pago (Efectivo, Transferencia, Tarjeta, MercadoPago, etc.).

### 3.2. Módulo de Despensa (Kiosco)
* **Gestión de Productos:** ABM (Alta, Baja, Modificación) de productos con su respectivo precio y categoría.
* **Control de Stock:** Descuento automático del stock al realizar una venta.
* **Historial de Ventas:** Registro de cada venta realizada, qué productos se vendieron y cuándo.
* **Distribución de Pagos:** Registro del método de pago utilizado para las compras en la despensa.

### 3.3. Módulo de Finanzas (Dashboard / Reportes)
* **Resumen Diario Neto:** Cálculo de ingresos del día (Reservas + Despensa) separando por métodos de pago.
* **Resúmenes Periódicos:** Reportes agregados de ingresos Semanales, Mensuales y Anuales.
* **Filtros:** Capacidad para ver los ingresos filtrados por origen (Canchas vs. Despensa).

---

## 4. Esquema de Base de Datos Propuesto (Relacional - MySQL)

A continuación, se detalla la estructura relacional inicial sugerida para los modelos y migraciones:

### Tabla: `canchas`
* `id` (Primary Key)
* `numero_o_nombre` (String)
* `precio_base` (Decimal)

### Tabla: `productos`
* `id` (Primary Key)
* `nombre` (String)
* `categoria` (String)
* `stock` (Integer)
* `precio` (Decimal)

### Tabla: `reservas`
* `id` (Primary Key)
* `cancha_id` (Foreign Key -> canchas.id)
* `fecha_reserva` (Date)
* `horario_inicio` (Time)
* `horario_fin` (Time)
* `cliente_nombre` (String)
* `estado_reserva` (Enum: 'disponible', 'reservado', 'cancelado', 'completado')
* `precio_total` (Decimal)
* `monto_senia` (Decimal)
* `metodo_pago` (String)
* `estado_pago` (Enum: 'pendiente', 'senia_pagada', 'pagado')
* `timestamps`

### Tabla: `ventas_despensa`
* `id` (Primary Key)
* `producto_id` (Foreign Key -> productos.id)
* `cantidad` (Integer)
* `total_venta` (Decimal)
* `metodo_pago` (String)
* `timestamps` (Usado para la fecha de venta)

---

## 5. Instrucciones para la IA Asistente
Actúa como un desarrollador Full-Stack Senior experto en Laravel. Basado en este PRD:
1. Genera los comandos de Artisan necesarios para crear los Modelos, Migraciones y Controladores base.
2. Escribe el código para las migraciones de MySQL asegurando la correcta definición de tipos de datos y claves foráneas.
3. Sugiere la estructura de controladores y rutas en Laravel para manejar el flujo principal de Reservas y el cálculo del Dashboard de Finanzas.
4. Proporciona ejemplos de cómo estructurar una vista Blade base utilizando Tailwind CSS para el Dashboard.
