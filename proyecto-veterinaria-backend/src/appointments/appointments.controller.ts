import { Controller, Post, Get, Body, Param, UseGuards, Request } from '@nestjs/common';
import { AppointmentsService } from './appointments.service';
import { CreateAppointmentDto } from './dto/create-appointment.dto';
import { JwtAuthGuard } from '../auth/jwt-auth.guard';

@Controller('appointments')
export class AppointmentsController {
    constructor(private appointmentsService: AppointmentsService) { }

    @Post()
    async create(@Body() createAppointmentDto: CreateAppointmentDto) {
        return this.appointmentsService.create(createAppointmentDto);
    }

    @UseGuards(JwtAuthGuard)
    @Get('my-appointments')
    async getMyAppointments(@Request() req) {
        return this.appointmentsService.findByUser(req.user.id);
    }

    @Get(':id')
    async findOne(@Param('id') id: string) {
        return this.appointmentsService.findOne(id);
    }
}
