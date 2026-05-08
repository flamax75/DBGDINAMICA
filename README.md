# dreambouw-web

Web dinamica en PHP para DreamBouw Group, preparada para ejecutarse con Docker.

## Ejecutar con Docker

```bash
docker compose up --build
```

La web queda disponible en:

```text
http://localhost:8080
```

Puedes cambiar el puerto con:

```bash
APP_PORT=8081 docker compose up --build
```

## Configuracion

- `APP_URL`: URL publica usada en metadatos SEO.
- `CONTACT_TO`: email receptor del formulario de contacto.
- `DATABASE_PATH`: ruta de la base de datos SQLite.
- `ADMIN_PASSWORD_HASH`: hash de la clave del administrador.

Como el repositorio es publico, no subas `.env`. Usa `.env.example` como plantilla:

```bash
cp .env.example .env
```

Genera el hash de la clave de admin:

```bash
docker compose run --rm web php scripts/create-admin-hash.php "tu-clave-segura"
```

Copia el resultado en `ADMIN_PASSWORD_HASH` dentro de `.env`, entre comillas simples para que Docker no interprete los `$` del hash:

```env
ADMIN_PASSWORD_HASH='$2y$...'
```

## Admin

El formulario guarda los mensajes en SQLite, por defecto en `storage/database.sqlite`.

Panel de administracion:

```text
http://localhost:8080/admin/
```

La clave no se guarda en claro. El login compara la clave con `password_verify()` usando el hash configurado en `.env`.

El formulario tambien intenta enviar email con `mail()`, pero en produccion conviene conectar el servidor a un SMTP real o instalar un relay de correo.
