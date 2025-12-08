import { Module } from '@nestjs/common';
import { ConfigModule, ConfigService } from '@nestjs/config';
import { TypeOrmModule } from '@nestjs/typeorm';
import { AuthModule } from './auth/auth.module';
import { UsersModule } from './users/users.module';
import { AppointmentsModule } from './appointments/appointments.module';
import { LocationModule } from './location/location.module';
import { ContactModule } from './contact/contact.module';
import { NewsletterModule } from './newsletter/newsletter.module';

// Importar entidades explícitamente
import { User } from './users/user.entity';
import { Country } from './location/country.entity';
import { City } from './location/city.entity';
import { Appointment } from './appointments/appointment.entity';
import { Contact } from './contact/contact.entity';
import { NewsletterSubscription } from './newsletter/newsletter.entity';

@Module({
    imports: [
        // Configuration
        ConfigModule.forRoot({
            isGlobal: true,
            envFilePath: '.env',
        }),

        // Database
        TypeOrmModule.forRootAsync({
            imports: [ConfigModule],
            useFactory: (configService: ConfigService) => ({
                type: 'postgres',
                host: configService.get('DATABASE_HOST'),
                port: +configService.get<number>('DATABASE_PORT'),
                username: configService.get('DATABASE_USER'),
                password: configService.get('DATABASE_PASSWORD'),
                database: configService.get('DATABASE_NAME'),
                entities: [User, Country, City, Appointment, Contact, NewsletterSubscription],
                synchronize: false, // Desactivado - usando tablas creadas manualmente
                logging: configService.get('NODE_ENV') === 'development',
            }),
            inject: [ConfigService],
        }),

        // Feature modules
        AuthModule,
        UsersModule,
        AppointmentsModule,
        LocationModule,
        ContactModule,
        NewsletterModule,
    ],
})
export class AppModule { }
