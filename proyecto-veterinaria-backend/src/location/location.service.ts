import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Country } from './country.entity';
import { City } from './city.entity';

@Injectable()
export class LocationService {
    constructor(
        @InjectRepository(Country)
        private countriesRepository: Repository<Country>,
        @InjectRepository(City)
        private citiesRepository: Repository<City>,
    ) { }

    async getCountries() {
        return this.countriesRepository.find({
            order: { name: 'ASC' },
        });
    }

    async getCitiesByCountry(countryCode: string) {
        return this.citiesRepository.find({
            where: { countryCode: countryCode },
            order: { name: 'ASC' },
            take: 100, // Limit to 100 cities
        });
    }

    async seedData() {
        // Check if data already exists
        const count = await this.countriesRepository.count();
        if (count > 0) {
            return { message: 'Data already seeded' };
        }

        // Seed some basic countries
        const countries = [
            { code: 'ESP', name: 'España' },
            { code: 'USA', name: 'Estados Unidos' },
            { code: 'MEX', name: 'México' },
            { code: 'ARG', name: 'Argentina' },
            { code: 'COL', name: 'Colombia' },
            { code: 'FRA', name: 'Francia' },
            { code: 'GBR', name: 'Reino Unido' },
            { code: 'DEU', name: 'Alemania' },
            { code: 'ITA', name: 'Italia' },
            { code: 'PRT', name: 'Portugal' },
        ];

        await this.countriesRepository.save(countries);

        // Seed some Spanish cities
        const cities = [
            { name: 'Madrid', countryCode: 'ESP' },
            { name: 'Barcelona', countryCode: 'ESP' },
            { name: 'Valencia', countryCode: 'ESP' },
            { name: 'Sevilla', countryCode: 'ESP' },
            { name: 'Zaragoza', countryCode: 'ESP' },
            { name: 'Málaga', countryCode: 'ESP' },
            { name: 'Murcia', countryCode: 'ESP' },
            { name: 'Palma', countryCode: 'ESP' },
            { name: 'Bilbao', countryCode: 'ESP' },
            { name: 'Alicante', countryCode: 'ESP' },
        ];

        await this.citiesRepository.save(cities);

        return { message: 'Data seeded successfully', countries: countries.length, cities: cities.length };
    }
}
