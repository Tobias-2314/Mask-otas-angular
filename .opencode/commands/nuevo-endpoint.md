---
description: Crea un endpoint REST completo para una entidad del proyecto Maskotas
---

Crea un endpoint REST completo para: $ARGUMENTS

Sigue este orden:
1. Usa el skill `mvc-structure` para confirmar el módulo correcto
2. Si la entidad no existe, usa `entity` para crearla
3. Crea el Repository con los métodos JPA necesarios (no SQL manual)
4. Usa `service` para crear el Service con la lógica de negocio
5. Usa `api-response` para definir el Request y Response como Java Records
6. Usa `controller` para crear el RestController

Código simple: métodos cortos, nombres claros, sin lógica en el controller.
Indica el path completo de cada fichero generado.
