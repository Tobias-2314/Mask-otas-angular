import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';

export interface CreateContactDto {
    name: string;
    email: string;
    phone?: string;
    subject: string;
    message: string;
}

export interface ContactResponse {
    message: string;
    contact: {
        id: number;
        name: string;
        email: string;
        phone?: string;
        subject: string;
        message: string;
        createdAt: string;
    };
}

@Injectable({
    providedIn: 'root'
})
export class ContactService {
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) { }

    submitContact(data: CreateContactDto): Observable<ContactResponse> {
        return this.http.post<ContactResponse>(`${this.apiUrl}/contact`, data);
    }
}
