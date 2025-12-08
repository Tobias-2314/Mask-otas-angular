import { Controller, Get, Param, Post } from '@nestjs/common';
import { LocationService } from './location.service';

@Controller('location')
export class LocationController {
    constructor(private locationService: LocationService) { }

    @Get('countries')
    async getCountries() {
        return this.locationService.getCountries();
    }

    @Get('cities/:countryCode')
    async getCities(@Param('countryCode') countryCode: string) {
        return this.locationService.getCitiesByCountry(countryCode);
    }

    @Post('seed')
    async seedData() {
        return this.locationService.seedData();
    }
}
