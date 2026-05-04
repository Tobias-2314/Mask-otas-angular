---
description: Revisa código del proyecto Maskotas buscando problemas concretos
---

Revisa el siguiente código del proyecto Maskotas:

$ARGUMENTS

Verifica específicamente:
1. ¿Hay lógica de negocio en el controller? → debe ir al service
2. ¿Los métodos tienen más de 15 líneas? → sugerir extracción
3. ¿Se retorna null en algún sitio? → usar Optional o excepción
4. ¿El controller expone entidades JPA directamente? → usar DTOs (skill `api-response`)
5. ¿Los nombres describen exactamente lo que hace el método?
6. ¿Hay más de 2 niveles de indentación? → extraer método

Formato de respuesta:
🔴 PROBLEMA: [qué está mal] → [cómo arreglarlo con código]
🟡 MEJORA: [qué se puede simplificar]
✅ CORRECTO: [qué está bien]
