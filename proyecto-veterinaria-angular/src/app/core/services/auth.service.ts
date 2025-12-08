import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { BehaviorSubject, Observable, of } from 'rxjs';
import { tap, catchError } from 'rxjs/operators';
import { environment } from '../../../environments/environment';

export interface User {
    id?: number;
    username: string;
    email: string;
    countryCode?: string;
    cityId?: number;
    isAdmin?: boolean;
}

export interface LoginResponse {
    access_token: string;
    user: User;
}

export interface RegisterResponse {
    message: string;
    user: User;
}

export interface RegisterData {
    username: string;
    email: string;
    password: string;
    countryCode: string;
    cityId: number;
}

@Injectable({
    providedIn: 'root'
})
export class AuthService {
    private currentUserSubject = new BehaviorSubject<User | null>(null);
    public currentUser$ = this.currentUserSubject.asObservable();
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) {
        // Cargar usuario desde localStorage si existe
        const savedUser = localStorage.getItem('currentUser');
        if (savedUser) {
            this.currentUserSubject.next(JSON.parse(savedUser));
        }
    }

    get currentUserValue(): User | null {
        return this.currentUserSubject.value;
    }

    get isLoggedIn(): boolean {
        return this.currentUserSubject.value !== null && this.getToken() !== null;
    }

    getToken(): string | null {
        return localStorage.getItem('access_token');
    }

    login(email: string, password: string): Observable<any> {
        const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
        const body = { email, password };

        return this.http.post<LoginResponse>(`${this.apiUrl}/auth/login`, body, { headers })
            .pipe(
                tap(response => {
                    if (response.access_token && response.user) {
                        // Guardar token y usuario
                        localStorage.setItem('access_token', response.access_token);
                        localStorage.setItem('currentUser', JSON.stringify(response.user));
                        this.currentUserSubject.next(response.user);
                    }
                }),
                catchError(error => {
                    console.error('Error de login:', error);
                    const errorMessage = error.error?.message || 'Error de conexión con el servidor';
                    throw { success: false, message: errorMessage };
                })
            );
    }

    register(data: RegisterData): Observable<any> {
        const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

        return this.http.post<RegisterResponse>(`${this.apiUrl}/auth/register`, data, { headers })
            .pipe(
                tap(response => {
                    console.log('Registro exitoso:', response);
                }),
                catchError(error => {
                    console.error('Error de registro:', error);
                    const errorMessage = error.error?.message || 'Error de conexión con el servidor';
                    throw { success: false, message: errorMessage };
                })
            );
    }

    logout(): void {
        localStorage.removeItem('access_token');
        localStorage.removeItem('currentUser');
        this.currentUserSubject.next(null);
    }
}
