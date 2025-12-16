import { Controller, Post, Get, Body, Param, UseGuards, Request, Query } from '@nestjs/common';
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

    @Get('time-slots')
    async getTimeSlots(@Query('startDate') startDate: string, @Query('endDate') endDate: string) {
        return this.appointmentsService.getTimeSlots(startDate, endDate);
    }

    @UseGuards(JwtAuthGuard)
    @Get('my-appointments')
    async getMyAppointments(@Request() req) {
        return this.appointmentsService.findByUser(req.user.id);
    }

    @Get('all')
    async getAllAppointments() {
        return this.appointmentsService.findAll();
    }

    @Get(':id')
    async findOne(@Param('id') id: string) {
        return this.appointmentsService.findOne(id);
    }
}
