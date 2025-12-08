import { Module } from '@nestjs/common';
import { TypeOrmModule } from '@nestjs/typeorm';
import { LocationController } from './location.controller';
import { LocationService } from './location.service';
import { Country } from './country.entity';
import { City } from './city.entity';

@Module({
    imports: [TypeOrmModule.forFeature([Country, City])],
    controllers: [LocationController],
    providers: [LocationService],
})
export class LocationModule { }
