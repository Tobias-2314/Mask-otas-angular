import { NestFactory } from '@nestjs/core';
import { ValidationPipe } from '@nestjs/common';
import { AppModule } from './app.module';

async function bootstrap() {
    const app = await NestFactory.create(AppModule);

    // Enable CORS
    app.enableCors({
        origin: (origin, callback) => {
            // Permitir cualquier localhost en desarrollo
            if (!origin || origin.startsWith('http://localhost:')) {
                callback(null, true);
            } else {
                callback(null, process.env.CORS_ORIGIN || 'http://localhost:4200');
            }
        },
        credentials: true,
    });

    // Global validation pipe
    app.useGlobalPipes(new ValidationPipe({
        whitelist: true,
        transform: true,
        forbidNonWhitelisted: true,
    }));

    // Global prefix for all routes
    app.setGlobalPrefix('api');

    const port = process.env.PORT || 3000;
    await app.listen(port);

    console.log(`🚀 Backend corriendo en: http://localhost:${port}/api`);
    console.log(`📊 Base de datos: ${process.env.DATABASE_HOST}:${process.env.DATABASE_PORT}`);
}

bootstrap();
