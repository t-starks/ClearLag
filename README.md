# ClearLag

ClearLag es un plugin para PocketMine-MP diseñado para limpiar automáticamente los ítems tirados en el servidor cada cierto tiempo. Esto ayuda a reducir el lag y mantener el rendimiento del servidor.

## Características

- Elimina automáticamente los ítems tirados en el servidor en intervalos configurables.
- Envía un mensaje de advertencia antes de limpiar los ítems.
- Muestra mensajes periódicos informando sobre el tiempo restante hasta la próxima limpieza.
- Permite personalizar los mensajes de advertencia y de limpieza.
- Informa la cantidad de ítems eliminados después de cada limpieza.

## Instalación

1. Descarga el plugin y descomprímelo si es necesario.
2. Coloca la carpeta `ClearLag` en el directorio `plugins` de tu servidor PocketMine-MP.
3. Inicia o reinicia tu servidor PocketMine-MP para cargar el plugin.

## Configuración

El archivo de configuración `config.yml` se encuentra en la carpeta `resources/ClearLag/config.yml`. Puedes editar este archivo para ajustar los intervalos de limpieza y personalizar los mensajes. A continuación se muestra un ejemplo de la configuración predeterminada:

```yaml
clear-interval: 120
clear-message: "§aItems eliminados."
warning-message: "§cRecogiendo basura en {time}..."
broadcast-interval: 15
broadcast-message: "§bLos ítems serán borrados en {time} segundos."
