import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';

export interface NewsletterSubscriptionDto {
    email: string;
}

export interface NewsletterResponse {
    message: string;
    subscription: {
        id: number;
        email: string;
        isActive: boolean;
        createdAt: string;
    };
}

@Injectable({
    providedIn: 'root'
})
export class NewsletterService {
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) { }

    subscribe(email: string): Observable<NewsletterResponse> {
        const data: NewsletterSubscriptionDto = { email };
        return this.http.post<NewsletterResponse>(`${this.apiUrl}/newsletter/subscribe`, data);
    }

    unsubscribe(email: string): Observable<any> {
        return this.http.post(`${this.apiUrl}/newsletter/unsubscribe`, { email });
    }
}
