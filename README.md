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

El formulario guarda una copia de cada solicitud en `storage/contact-submissions.log` dentro del volumen Docker `contact_storage`. Tambien intenta enviar email con `mail()`, pero en produccion conviene conectar el servidor a un SMTP real o instalar un relay de correo.
