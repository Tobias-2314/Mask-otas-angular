import { Module } from '@nestjs/common';
import { ConfigModule, ConfigService } from '@nestjs/config';
import { TypeOrmModule } from '@nestjs/typeorm';
import { AuthModule } from './auth/auth.module';
import { UsersModule } from './users/users.module';
import { AppointmentsModule } from './appointments/appointments.module';
import { LocationModule } from './location/location.module';
import { ContactModule } from './contact/contact.module';
import { NewsletterModule } from './newsletter/newsletter.module';
import { ReviewsModule } from './reviews/reviews.module';

// Importar entidades explícitamente
import { User } from './users/user.entity';
import { Country } from './location/country.entity';
import { City } from './location/city.entity';
import { Appointment } from './appointments/appointment.entity';
import { TimeSlot } from './appointments/time-slot.entity';
import { Contact } from './contact/contact.entity';
import { NewsletterSubscription } from './newsletter/newsletter.entity';
import { Review } from './reviews/review.entity';

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
                type: 'mysql',
                host: configService.get('DATABASE_HOST'),
                port: +configService.get<number>('DATABASE_PORT') || 3306,
                username: configService.get('DATABASE_USER'),
                password: configService.get('DATABASE_PASSWORD'),
                database: configService.get('DATABASE_NAME'),
                entities: [User, Country, City, Appointment, TimeSlot, Contact, NewsletterSubscription, Review],
                synchronize: true, // Activado para desarrollo para crear tablas automáticamente en MySQL
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
        ReviewsModule,
    ],
})
export class AppModule { }
