# Sistema de Reserva y Gestión Deportiva

Plataforma backend integral orientada a la administración de turnos, gestión de clientes y alquiler de canchas de fútbol. Diseñada para garantizar disponibilidad en tiempo real, procesar transacciones seguras y optimizar la consulta de grillas horarias.

---

## Características Principales

* **Control de Disponibilidad y Turnos:** Algoritmo de agendamiento que previene la superposición de reservas y valida franjas horarias en tiempo real.
* **Gestión Transaccional en Base de Datos:** Esquema relacional con control de estados de reserva (pendiente, confirmada, cancelada), clientes y cobros. Uso de transacciones atómicas para impedir colisiones o double-booking en peticiones concurrentes.
* **API RESTful de Alto Rendimiento:** Endpoints estructurados para la consulta rápida del calendario de canchas y el procesamiento de solicitudes.
* **Arquitectura Limpia y Modular:** Separación de responsabilidades entre capas de negocio, persistencia y controladores para facilitar el mantenimiento y la escalabilidad.

---

## Stack Tecnológico

* **Backend:** PHP (Laravel)
* **Base de Datos:** MySQL (Modelado relacional, índices, transacciones ACID)
* **Arquitectura de Software:** API RESTful, Clean Architecture, Repository Pattern
* **Testing & Documentación:** Postman
* **Control de Versiones:** Git / GitHub

---

## Modelo de Datos (Esquema Principal)

* canchas: Identificador, tipo/superficie, capacidad y estado operativo.
* turnos: Grilla horaria base, días hábiles y configuración de duraciones.
* reservas: Vínculo entre usuario, cancha y horario, con control de concurrencia y validación temporal.
* pagos_transacciones: Registro de señas/cobros, método de pago y estado de la transacción.
* clientes: Perfil, historial de alquileres y datos de contacto.

---

## Endpoints Destacados

| Método | Endpoint | Descripción |
| :--- | :--- | :--- |
| GET | /api/canchas | Lista de canchas activas y características |
| GET | /api/disponibilidad | Consulta de grilla horaria filtrada por fecha y cancha |
| POST | /api/reservas | Creación de reserva con bloqueo transaccional |
| PATCH | /api/reservas/{id}/estado | Actualización de estado (confirmada, cancelada) |
| POST | /api/pagos | Registro y validación del comprobante/seña |

---

## Instalación y Configuración Local

1. Clonar el repositorio:
git clone https://github.com/LucasFloress/sistema-reserva-canchas.git
cd sistema-reserva-canchas

2. Instalar dependencias:
composer install

3. Configurar el entorno:
cp .env.example .env
php artisan key:generate
(Configurar credenciales de MySQL en el archivo .env)

4. Ejecutar migraciones y seeders:
php artisan migrate --seed

5. Levantar el servidor local:
php artisan serve

---

## Autor

Lucas Ezequiel Flores  
* Técnico Universitario en Programación – UTN Haedo  
* LinkedIn: https://linkedin.com/in/lucas-ezequiel-flores
* GitHub: https://github.com/LucasFloress
