import { IsString, IsInt, Min, Max, IsNotEmpty, IsOptional } from 'class-validator';

export class CreateReviewDto {
    @IsString()
    @IsNotEmpty()
    customer_name: string;

    @IsInt()
    @Min(1)
    @Max(5)
    rating: number;

    @IsString()
    @IsNotEmpty()
    comment: string;

    @IsString()
    @IsOptional()
    pet_name?: string;

    @IsString()
    @IsOptional()
    service_type?: string;
}
