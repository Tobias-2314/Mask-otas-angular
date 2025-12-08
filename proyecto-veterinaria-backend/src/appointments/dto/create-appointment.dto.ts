import { IsString, IsEmail, IsNotEmpty, IsDateString, IsOptional, IsIn } from 'class-validator';

export class CreateAppointmentDto {
    @IsString()
    @IsNotEmpty()
    owner_name: string;

    @IsEmail()
    @IsNotEmpty()
    email: string;

    @IsString()
    @IsNotEmpty()
    phone: string;

    @IsString()
    @IsNotEmpty()
    pet_name: string;

    @IsString()
    @IsIn(['perro', 'gato', 'otro'])
    pet_type: string;

    @IsString()
    @IsIn(['consulta', 'vacunacion', 'peluqueria', 'emergencia'])
    service_type: string;

    @IsDateString()
    preferred_date: string;

    @IsString()
    @IsNotEmpty()
    preferred_time: string;

    @IsString()
    @IsOptional()
    notes?: string;
}
