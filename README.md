# Proyecto de Seguridad Web

**Titulación:** MASW  
**Curso académico:** 2024 – 2025  
**Alumnos:** Osvaldo Arriagada, Felipe Giraldo  
**Profesor:** Paco Gómez  
**Convocatoria:** Segunda

Este proyecto es parte de la asignatura de **Seguridad Web** del curso 2024-2025. El objetivo principal es implementar un sistema de registro y autenticación utilizando el framework **Laravel** (versiones 10/11), aplicando validaciones estrictas y mecanismos de seguridad en la Base de Datos y el servidor.

## Funcionalidades Principales
- **Registro de usuario**: Implementación de un formulario de registro con validaciones de campos como nombre, apellidos, DNI, email, contraseña, y otros.
- **Autenticación**: Sistema de login con validaciones y un usuario de prueba predefinido.
- **Validaciones personalizadas**: Se utilizan tanto las validaciones predefinidas de Laravel como validaciones personalizadas para cumplir con los requisitos de seguridad.
- **Puesta en producción**: El proyecto debe ser desplegado en un entorno virtualizado con Ubuntu, configurando adecuadamente un servidor web (LAMP) y protegiendo los puertos HTTP y MySQL.

## Requisitos de Validación
- **Registro**: Validaciones de campos como nombre (mínimo 2 caracteres), apellidos, DNI con formato español, email único, y contraseña segura.
- **Login**: Validaciones básicas de email y contraseña, con un mensaje de error genérico para evitar revelar información sensible.

## Despliegue
El proyecto debe ser desplegado en un servidor virtualizado con **Ubuntu** y configurado usando **Apache** o mediante el servidor de desarrollo de Laravel. Además, se debe configurar el firewall para restringir el acceso a ciertos puertos.

## Evaluación
Este proyecto forma parte de la evaluación de la asignatura y tiene un peso del 30% en la calificación final. Se requiere la entrega del código fuente en un repositorio público de GitHub y una memoria explicativa de entre 5 y 10 páginas.
