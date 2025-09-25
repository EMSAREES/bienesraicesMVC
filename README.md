# 🏠 Bienes Raíces - Sistema de Gestión Inmobiliaria

Un sistema  web completo de practica para la gestión de propiedades inmobiliarias desarrollado con PHP siguiendo el patrón MVC (Modelo-Vista-Controlador) y programación orientada a objetos.

## 📋 Descripción

Plataforma integral que permite gestionar propiedades inmobiliarias, vendedores y contenido de blog. Incluye tanto un panel de administración privado como una interfaz pública para mostrar las propiedades disponibles.

## ✨ Características Principales

### 🔐 Panel de Administración
- **Gestión de Propiedades**: Crear, actualizar y eliminar propiedades
- **Gestión de Vendedores**: Administrar información de agentes de ventas
- **Gestión de Blog**: Crear y administrar entradas de blog
- **Sistema de Autenticación**: Login/logout seguro para administradores

### 🌐 Sitio Público
- **Página Principal**: Presentación de la empresa y propiedades destacadas
- **Catálogo de Propiedades**: Listado completo con detalles individuales
- **Blog Corporativo**: Artículos y noticias del sector inmobiliario
- **Página de Contacto**: Formulario para consultas de clientes
- **Información Corporativa**: Sección "Nosotros"

## 🛠 Tecnologías Utilizadas

- **PHP 8+** - Lenguaje principal
- **Patrón MVC** - Arquitectura del sistema
- **POO** - Programación Orientada a Objetos
- **Composer** - Gestión de dependencias
- **PSR-4** - Autoloading de clases

### 📦 Dependencias

```json
- intervention/image: ^3.11    # Procesamiento de imágenes
- phpmailer/phpmailer: ^6.10   # Envío de correos electrónicos
- vlucas/phpdotenv: ^5.6       # Gestión de variables de entorno
```

## 📁 Estructura del Proyecto

```
bienes-raices/
├── controllers/          # Controladores MVC
├── models/              # Modelos de datos
├── views/               # Vistas/Templates
├── public/              # Archivos públicos (CSS, JS, imágenes)
├── include/             # Archivos de configuración
├── vendor/              # Dependencias de Composer
└── composer.json        # Configuración de dependencias
```

## 🚀 Instalación

1. **Clonar el repositorio**
   ```bash
   git clone [url-del-repositorio]
   cd bienes-raices
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar variables de entorno**
   ```bash
   en carpeta include agrega el .env que contiene:
   Base de dato: DB_HOST, DB_USER, DB_PASS, DB_NAME 
   Mandejo de correo: EMAIL_HOST, EMAIL_USER, EMAIL_PASS, EMAIL_PORT  
   cp .env.example .env
   # Editar .env con tus configuraciones
   ```

4. **Configurar base de datos**
   - Crear base de datos
   - Importar esquema SQL
   - Configurar credenciales en .env

5. **Configurar servidor web**
   - Apuntar document root a `/public`
   - Configurar mod_rewrite (Apache) o equivalente

## 🗺 Rutas del Sistema

### Rutas Públicas
- `/` - Página principal
- `/nosotros` - Información de la empresa
- `/propiedades` - Catálogo de propiedades
- `/propiedad` - Detalle de propiedad individual
- `/blog` - Blog corporativo
- `/entrada` - Entrada individual del blog
- `/contacto` - Formulario de contacto

### Rutas Administrativas
- `/admin` - Panel de administración
- `/login` - Acceso de administradores
- `/propiedades/crear` - Crear nueva propiedad
- `/propiedades/actualizar` - Modificar propiedad
- `/vendedores/crear` - Registrar vendedor
- `/vendedores/actualizar` - Modificar vendedor
- `/blogs/crear` - Crear entrada de blog
- `/blogs/actualizar` - Modificar entrada de blog

## 👨‍💻 Autor

**EMSAREES**
- yo


---

*Proyecto desarrollado con ❤️ utilizando PHP y buenas prácticas de desarrollo web*
