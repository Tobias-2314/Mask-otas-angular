import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import { environment } from '../../../environments/environment';

export interface Country {
    code: string;
    name: string;
}

export interface City {
    id: number;
    name: string;
    countryCode: string;
}

@Injectable({
    providedIn: 'root'
})
export class LocationService {
    private apiUrl = environment.apiUrl;

    // Datos de respaldo si la API no está disponible
    private fallbackCountries: Country[] = [
        { code: 'ESP', name: 'España' },
        { code: 'USA', name: 'Estados Unidos' },
        { code: 'MEX', name: 'México' },
        { code: 'ARG', name: 'Argentina' },
        { code: 'COL', name: 'Colombia' },
        { code: 'FRA', name: 'Francia' },
        { code: 'GBR', name: 'Reino Unido' },
        { code: 'DEU', name: 'Alemania' },
        { code: 'ITA', name: 'Italia' },
        { code: 'PRT', name: 'Portugal' }
    ];

    private fallbackCities: { [key: string]: City[] } = {
        'ESP': [
            { id: 1, name: 'Madrid', countryCode: 'ESP' },
            { id: 2, name: 'Barcelona', countryCode: 'ESP' },
            { id: 3, name: 'Valencia', countryCode: 'ESP' },
            { id: 4, name: 'Sevilla', countryCode: 'ESP' },
            { id: 5, name: 'Zaragoza', countryCode: 'ESP' }
        ]
    };

    constructor(private http: HttpClient) { }

    getCountries(): Observable<Country[]> {
        return this.http.get<Country[]>(`${this.apiUrl}/location/countries`)
            .pipe(
                catchError(error => {
                    console.warn('Error al cargar países, usando datos de respaldo:', error);
                    return of(this.fallbackCountries);
                })
            );
    }

    getCitiesByCountry(countryCode: string): Observable<City[]> {
        return this.http.get<City[]>(`${this.apiUrl}/location/cities/${countryCode}`)
            .pipe(
                catchError(error => {
                    console.warn('Error al cargar ciudades, usando datos de respaldo:', error);
                    return of(this.fallbackCities[countryCode] || []);
                })
            );
    }
}
