import { Injectable, BadRequestException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Appointment } from './appointment.entity';
import { TimeSlot } from './time-slot.entity';
import { CreateAppointmentDto } from './dto/create-appointment.dto';

@Injectable()
export class AppointmentsService {
    constructor(
        @InjectRepository(Appointment)
        private appointmentsRepository: Repository<Appointment>,
        @InjectRepository(TimeSlot)
        private timeSlotsRepository: Repository<TimeSlot>,
    ) { }

    async create(createAppointmentDto: CreateAppointmentDto, userId?: string) {
        console.log('Creando cita con datos:', createAppointmentDto);

        // Verificar y obtener/crear el slot
        let timeSlot = await this.timeSlotsRepository.findOne({
            where: {
                slot_date: createAppointmentDto.preferred_date as any,
                slot_time: createAppointmentDto.preferred_time,
            },
        });

        // Si el slot no existe, crearlo
        if (!timeSlot) {
            timeSlot = this.timeSlotsRepository.create({
                slot_date: createAppointmentDto.preferred_date as any,
                slot_time: createAppointmentDto.preferred_time,
                max_capacity: 1, // Solo 1 cita por horario
                current_bookings: 0,
                doctor_name: this.assignDoctor(createAppointmentDto.preferred_time),
            });
            await this.timeSlotsRepository.save(timeSlot);
        }

        // Verificar disponibilidad
        if (timeSlot.current_bookings >= timeSlot.max_capacity) {
            throw new BadRequestException(
                `No hay disponibilidad para este horario. Capacidad máxima alcanzada (${timeSlot.max_capacity}/${timeSlot.max_capacity})`
            );
        }

        // Crear la cita
        const appointment = this.appointmentsRepository.create({
            ...createAppointmentDto,
            user_id: userId,
            status: 'pending',
        });

        await this.appointmentsRepository.save(appointment);

        // Incrementar el contador de reservas
        timeSlot.current_bookings += 1;
        await this.timeSlotsRepository.save(timeSlot);

        console.log('Cita guardada:', appointment);
        console.log(`Slot actualizado: ${timeSlot.current_bookings}/${timeSlot.max_capacity} reservas`);

        return {
            success: true,
            message: 'Appointment created successfully',
            appointment,
            availableSpots: timeSlot.max_capacity - timeSlot.current_bookings,
        };
    }

    private assignDoctor(time: string): string {
        const hour = parseInt(time.split(':')[0]);
        if (hour < 12) return 'Dr. García';
        if (hour < 16) return 'Dra. Martínez';
        return 'Dr. López';
    }

    async findAll() {
        const appointments = await this.appointmentsRepository.find({
            relations: ['user'],
            order: { created_at: 'DESC' },
        });

        console.log('Citas encontradas:', appointments.length);
        if (appointments.length > 0) {
            console.log('Primera cita:', {
                preferred_date: appointments[0].preferred_date,
                preferred_time: appointments[0].preferred_time
            });
        }

        return appointments;
    }

    async getAvailableSlots(startDate: string, endDate: string) {
        const slots = await this.timeSlotsRepository
            .createQueryBuilder('slot')
            .where('slot.slot_date >= :startDate', { startDate })
            .andWhere('slot.slot_date <= :endDate', { endDate })
            .orderBy('slot.slot_date', 'ASC')
            .addOrderBy('slot.slot_time', 'ASC')
            .getMany();

        return slots.map(slot => ({
            date: slot.slot_date,
            time: slot.slot_time,
            available: slot.current_bookings < slot.max_capacity,
            availableSpots: slot.max_capacity - slot.current_bookings,
            doctorName: slot.doctor_name,
        }));
    }

    async getTimeSlots(startDate: string, endDate: string) {
        const slots = await this.timeSlotsRepository
            .createQueryBuilder('slot')
            .where('slot.slot_date >= :startDate', { startDate })
            .andWhere('slot.slot_date <= :endDate', { endDate })
            .orderBy('slot.slot_date', 'ASC')
            .addOrderBy('slot.slot_time', 'ASC')
            .getMany();

        return slots;
    }

    async findOne(id: string) {
        return this.appointmentsRepository.findOne({
            where: { id },
            relations: ['user'],
        });
    }

    async findByUser(userId: string) {
        return this.appointmentsRepository.find({
            where: { user_id: userId },
            order: { created_at: 'DESC' },
        });
    }
}
