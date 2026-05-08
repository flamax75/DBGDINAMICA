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
- `DB_CONNECTION`: usa `mysql` en hosting con MySQL; usa `sqlite` para desarrollo local sin MySQL.
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: credenciales de MySQL.
- `DATABASE_PATH`: ruta de SQLite solo para desarrollo local si no configuras MySQL.
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

El formulario guarda los mensajes en MySQL cuando configuras las variables `DB_*`. Con Docker se levanta una base MariaDB local automaticamente. Si configuras `DB_CONNECTION=sqlite`, usa SQLite localmente en `storage/database.sqlite`.

Para DonDominio o cualquier hosting PHP + MySQL, rellena estas variables con los datos del panel del hosting:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nombre_de_base_de_datos
DB_USERNAME=usuario_mysql
DB_PASSWORD=clave_mysql
DB_CHARSET=utf8mb4
```

La tabla `contact_messages` se crea automaticamente cuando se carga la web o el panel por primera vez.

Panel de administracion:

```text
http://localhost:8080/admin/
```

La clave no se guarda en claro. El login compara la clave con `password_verify()` usando el hash configurado en `.env`.

El formulario tambien intenta enviar email con `mail()`, pero en produccion conviene conectar el servidor a un SMTP real o instalar un relay de correo.
