import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, of, forkJoin } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import { environment } from '../../../environments/environment';

export interface TimeSlot {
    id: string;
    time: string;
    available: boolean;
    doctorName?: string;
}

export interface AvailableDay {
    date: string;
    dayOfWeek: string;
    slots: TimeSlot[];
}

export interface AvailableSlotsResponse {
    days: AvailableDay[];
}

export interface BookedAppointment {
    preferred_date: string;
    preferred_time: string;
}

@Injectable({
    providedIn: 'root'
})
export class AvailableSlotsService {
    private apiUrl = environment.apiUrl;

    constructor(private http: HttpClient) { }

    /**
     * Obtiene todas las citas reservadas del backend
     */
    private getBookedAppointments(): Observable<BookedAppointment[]> {
        return this.http.get<any[]>(`${this.apiUrl}/appointments/all`).pipe(
            map(appointments => appointments.map(apt => ({
                preferred_date: apt.preferred_date,
                preferred_time: apt.preferred_time
            }))),
            catchError(() => of([]))
        );
    }

    /**
     * Obtiene los horarios disponibles para un rango de fechas
     * @param startDate Fecha de inicio (formato: YYYY-MM-DD)
     * @param endDate Fecha de fin (formato: YYYY-MM-DD)
     * @param serviceType Tipo de servicio (opcional)
     */
    getAvailableSlots(startDate: string, endDate: string, serviceType?: string): Observable<AvailableSlotsResponse> {
        console.log(`🔍 Consultando horarios: ${startDate} a ${endDate}`);

        // Generar todos los horarios posibles para el rango de fechas
        const allSlots = this.generateAllPossibleSlots(startDate, endDate);

        // Consultar los slots ocupados de la base de datos
        return this.http.get<any[]>(`${this.apiUrl}/appointments/time-slots`, {
            params: { startDate, endDate }
        }).pipe(
            map(bookedSlots => {
                console.log(`✅ Respuesta del servidor:`, bookedSlots);
                // Marcar los slots ocupados
                return this.markOccupiedSlots(allSlots, bookedSlots);
            }),
            catchError((error) => {
                console.error('❌ Error al consultar time-slots:', error);
                // Si falla, mostrar todos como disponibles
                return of(allSlots);
            })
        );
    }

    /**
     * Verifica si un horario específico está disponible
     */
    checkSlotAvailability(date: string, time: string): Observable<{ available: boolean }> {
        return this.getBookedAppointments().pipe(
            map(appointments => {
                const isBooked = appointments.some(apt =>
                    apt.preferred_date === date && apt.preferred_time === time
                );
                return { available: !isBooked };
            }),
            catchError(() => of({ available: true }))
        );
    }

    /**
     * Reserva temporalmente un horario (para evitar doble reserva)
     */
    reserveSlot(date: string, time: string): Observable<{ success: boolean; reservationId: string }> {
        // TODO: Implementar cuando el backend esté listo
        // return this.http.post<{ success: boolean; reservationId: string }>(`${this.apiUrl}/appointments/reserve-slot`, { date, time });

        return of({ success: true, reservationId: `temp-${Date.now()}` });
    }

    /**
     * Genera todos los horarios posibles para un rango de fechas
     */
    private generateAllPossibleSlots(startDate: string, endDate: string): AvailableSlotsResponse {
        const days: AvailableDay[] = [];
        const start = new Date(startDate);
        const end = new Date(endDate);

        const dayNames = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        const doctors = ['Dr. García', 'Dra. Martínez', 'Dr. López'];

        // Horarios de trabajo: 9:00 - 20:00
        const workingHours = [
            '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '12:00', '12:30', '13:00', '13:30', '14:00', '14:30',
            '15:00', '15:30', '16:00', '16:30', '17:00', '17:30',
            '18:00', '18:30', '19:00', '19:30'
        ];

        // Crear una copia de la fecha para evitar mutaciones
        const currentDate = new Date(start);

        while (currentDate <= end) {
            const dayOfWeek = currentDate.getDay();

            // No trabajamos domingos
            if (dayOfWeek !== 0) {
                const dateStr = currentDate.toISOString().split('T')[0];
                const slots: TimeSlot[] = [];

                // Sábados solo medio día (9:00 - 14:00)
                const availableHours = dayOfWeek === 6
                    ? workingHours.filter(h => parseInt(h.split(':')[0]) < 14)
                    : workingHours;

                availableHours.forEach((time, index) => {
                    const doctor = doctors[index % doctors.length];

                    slots.push({
                        id: `${dateStr}-${time}`,
                        time,
                        available: true, // Por defecto todos disponibles
                        doctorName: doctor
                    });
                });

                days.push({
                    date: dateStr,
                    dayOfWeek: dayNames[dayOfWeek],
                    slots
                });
            }

            // Avanzar al siguiente día
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return { days };
    }

    /**
     * Marca los slots ocupados basándose en los datos de la BD
     */
    private markOccupiedSlots(allSlots: AvailableSlotsResponse, bookedSlots: any[]): AvailableSlotsResponse {
        console.log('📊 Slots de la BD:', bookedSlots);

        const days = allSlots.days.map(day => {
            const slots = day.slots.map(slot => {
                // Normalizar fecha para comparación
                const dayDateNormalized = day.date; // Ya está en formato YYYY-MM-DD

                // Buscar si este slot está en la BD y está ocupado
                const dbSlot = bookedSlots.find(bs => {
                    // Normalizar la fecha de la BD (puede venir como Date object o string)
                    const dbDate = typeof bs.slot_date === 'string'
                        ? bs.slot_date.split('T')[0]
                        : new Date(bs.slot_date).toISOString().split('T')[0];

                    const match = dbDate === dayDateNormalized && bs.slot_time === slot.time;

                    if (match) {
                        console.log(`🔒 Slot ocupado encontrado: ${dbDate} ${bs.slot_time} (${bs.current_bookings}/${bs.max_capacity})`);
                    }

                    return match;
                });

                return {
                    ...slot,
                    available: dbSlot ? dbSlot.current_bookings < dbSlot.max_capacity : true
                };
            });

            return { ...day, slots };
        });

        return { days };
    }

    /**
     * Obtiene los próximos N días laborables
     */
    getNextWorkingDays(count: number = 7): string[] {
        const days: string[] = [];
        const today = new Date();
        let current = new Date(today);

        while (days.length < count) {
            current.setDate(current.getDate() + 1);
            const dayOfWeek = current.getDay();

            // Excluir domingos
            if (dayOfWeek !== 0) {
                days.push(current.toISOString().split('T')[0]);
            }
        }

        return days;
    }

    /**
     * Formatea una fecha para mostrar
     */
    formatDate(dateStr: string): string {
        const date = new Date(dateStr + 'T00:00:00'); // Evitar problemas de zona horaria
        const options: Intl.DateTimeFormatOptions = {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };
        return date.toLocaleDateString('es-ES', options);
    }
}
