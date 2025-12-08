# 🚀 Script de Setup Rápido

Write-Host "🐾 MASK!OTAS Backend - Setup Rápido" -ForegroundColor Cyan
Write-Host "====================================`n" -ForegroundColor Cyan

# 1. Crear archivo .env
Write-Host "📝 Creando archivo .env..." -ForegroundColor Yellow
$envContent = @"
DATABASE_HOST=localhost
DATABASE_PORT=5432
DATABASE_USER=postgres
DATABASE_PASSWORD=2314
DATABASE_NAME=maskotas_db

JWT_SECRET=maskotas-super-secret-jwt-key-change-in-production-12345
JWT_EXPIRATION=24h

PORT=3000
NODE_ENV=development

CORS_ORIGIN=http://localhost:4200
"@

$envContent | Out-File -FilePath ".env" -Encoding UTF8
Write-Host "✅ Archivo .env creado`n" -ForegroundColor Green

# 2. Instalar dependencias
Write-Host "📦 Instalando dependencias npm..." -ForegroundColor Yellow
npm install

# 3. Verificar PostgreSQL
Write-Host "`n🔍 Verificar que PostgreSQL está instalado y corriendo" -ForegroundColor Yellow
Write-Host "   Si no tienes PostgreSQL:" -ForegroundColor Gray
Write-Host "   - Descarga desde: https://www.postgresql.org/download/" -ForegroundColor Gray
Write-Host "   - O usa Docker: docker run --name postgres -e POSTGRES_PASSWORD=postgres -p 5432:5432 -d postgres`n" -ForegroundColor Gray

# 4. Crear base de datos
Write-Host "📊 Para crear la base de datos, ejecuta:" -ForegroundColor Yellow
Write-Host "   createdb maskotas_db" -ForegroundColor Cyan
Write-Host "   (o créala desde pgAdmin/DBeaver)`n" -ForegroundColor Gray

# 5. Instrucciones finales
Write-Host "✨ Setup completado! Próximos pasos:" -ForegroundColor Green
Write-Host "`n1. Crear la base de datos 'maskotas_db' en PostgreSQL" -ForegroundColor White
Write-Host "2. Ejecutar: npm run start:dev" -ForegroundColor White
Write-Host "3. El servidor iniciará en: http://localhost:3000" -ForegroundColor White
Write-Host "4. Poblar datos iniciales: POST http://localhost:3000/api/location/seed`n" -ForegroundColor White

Write-Host "📚 Documentación completa en README.md" -ForegroundColor Cyan
