import { Controller, Post, Get, Delete, Patch, Body, Param, UseGuards, Request } from '@nestjs/common';
import { ReviewsService } from './reviews.service';
import { CreateReviewDto } from './dto/create-review.dto';
import { JwtAuthGuard } from '../auth/jwt-auth.guard';

@Controller('reviews')
export class ReviewsController {
    constructor(private reviewsService: ReviewsService) { }

    @Post()
    async create(@Body() createReviewDto: CreateReviewDto) {
        return this.reviewsService.create(createReviewDto);
    }

    @Post('create-table')
    async createTable() {
        return this.reviewsService.createTable();
    }

    @Get()
    async findAll() {
        return this.reviewsService.findAll();
    }

    @Get('stats')
    async getStats() {
        return this.reviewsService.getStats();
    }

    @UseGuards(JwtAuthGuard)
    @Get('admin/all')
    async findAllForAdmin() {
        return this.reviewsService.findAllForAdmin();
    }

    @Get(':id')
    async findOne(@Param('id') id: string) {
        return this.reviewsService.findOne(id);
    }

    @UseGuards(JwtAuthGuard)
    @Patch(':id/approve')
    async approve(@Param('id') id: string) {
        return this.reviewsService.approve(id);
    }

    @UseGuards(JwtAuthGuard)
    @Patch(':id/hide')
    async hide(@Param('id') id: string) {
        return this.reviewsService.hide(id);
    }

    @UseGuards(JwtAuthGuard)
    @Delete(':id')
    async delete(@Param('id') id: string) {
        return this.reviewsService.delete(id);
    }
}
