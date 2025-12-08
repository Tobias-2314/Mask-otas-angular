import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { environment } from '../../../environments/environment';

export interface CreateAppointmentDto {
    petName: string;
    petType: string;
    serviceType: string;
    appointmentDate: string;
    notes?: string;
}

export interface Appointment {
    id: number;
    petName: string;
    petType: string;
    serviceType: string;
    appointmentDate: string;
    notes?: string;
    status: string;
    userId: number;
    createdAt: string;
    updatedAt: string;
}

export interface UpdateAppointmentDto {
    petName?: string;
    petType?: string;
    serviceType?: string;
    appointmentDate?: string;
    notes?: string;
    status?: string;
}

@Injectable({
    providedIn: 'root'
})
export class AppointmentsService {
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) { }

    createAppointment(data: CreateAppointmentDto): Observable<Appointment> {
        return this.http.post<Appointment>(`${this.apiUrl}/appointments`, data);
    }

    getUserAppointments(): Observable<Appointment[]> {
        return this.http.get<Appointment[]>(`${this.apiUrl}/appointments`);
    }

    getAppointmentById(id: number): Observable<Appointment> {
        return this.http.get<Appointment>(`${this.apiUrl}/appointments/${id}`);
    }

    updateAppointment(id: number, data: UpdateAppointmentDto): Observable<Appointment> {
        return this.http.patch<Appointment>(`${this.apiUrl}/appointments/${id}`, data);
    }

    deleteAppointment(id: number): Observable<void> {
        return this.http.delete<void>(`${this.apiUrl}/appointments/${id}`);
    }
}
