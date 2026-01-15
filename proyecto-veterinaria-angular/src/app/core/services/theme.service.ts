import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable, of } from 'rxjs';
import { map, tap, catchError } from 'rxjs/operators';
import { environment } from '../../../environments/environment';

export interface AppSettings {
    site_name?: string;
    primary_color?: string;
    logo_url?: string;
    [key: string]: any;
}

@Injectable({
    providedIn: 'root'
})
export class ThemeService {
    private apiUrl = environment.apiUrl;

    private logoSubject = new BehaviorSubject<string>('assets/images/logo.png');
    public logo$ = this.logoSubject.asObservable();

    private siteNameSubject = new BehaviorSubject<string>('MASK!OTAS');
    public siteName$ = this.siteNameSubject.asObservable();

    private primaryColorSubject = new BehaviorSubject<string>('#009688');
    public primaryColor$ = this.primaryColorSubject.asObservable();

    constructor(private http: HttpClient) { }

    loadTheme(): void {
        this.http.get<any>(`${this.apiUrl}/settings`).pipe(
            tap(settings => this.applySettings(settings)),
            catchError(err => {
                console.error('Failed to load theme settings', err);
                return of({});
            })
        ).subscribe();
    }

    private applySettings(settings: AppSettings): void {
        if (settings.primary_color) {
            document.documentElement.style.setProperty('--color-primary', settings.primary_color);
            this.primaryColorSubject.next(settings.primary_color);
        }

        if (settings.logo_url) {
            // Handle relative vs absolute paths
            const logo = settings.logo_url.startsWith('http') || settings.logo_url.startsWith('assets')
                ? settings.logo_url
                : `${this.apiUrl.replace('/api', '')}${settings.logo_url}`;
            this.logoSubject.next(logo);
        }

        if (settings.site_name) {
            this.siteNameSubject.next(settings.site_name);
            document.title = settings.site_name;
        }
    }

    updateSettings(settings: { key: string, value: string }[]): Observable<any> {
        return this.http.post(`${this.apiUrl}/settings`, { settings }).pipe(
            tap(() => {
                // Convert array back to object for applySettings
                const settingsObj: any = {};
                settings.forEach(s => settingsObj[s.key] = s.value);
                this.applySettings(settingsObj);
            })
        );
    }

    uploadLogo(file: File): Observable<{ url: string }> {
        const formData = new FormData();
        formData.append('logo', file);

        return this.http.post<{ url: string }>(`${this.apiUrl}/settings/logo`, formData).pipe(
            tap(response => {
                this.applySettings({ logo_url: response.url });
            })
        );
    }
}
