import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Appointment } from './appointment.entity';
import { CreateAppointmentDto } from './dto/create-appointment.dto';

@Injectable()
export class AppointmentsService {
    constructor(
        @InjectRepository(Appointment)
        private appointmentsRepository: Repository<Appointment>,
    ) { }

    async create(createAppointmentDto: CreateAppointmentDto, userId?: string) {
        const appointment = this.appointmentsRepository.create({
            ...createAppointmentDto,
            user_id: userId,
            status: 'pending',
        });

        await this.appointmentsRepository.save(appointment);

        return {
            success: true,
            message: 'Appointment created successfully',
            appointment,
        };
    }

    async findAll() {
        return this.appointmentsRepository.find({
            relations: ['user'],
            order: { created_at: 'DESC' },
        });
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
