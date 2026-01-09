import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Review } from './review.entity';
import { CreateReviewDto } from './dto/create-review.dto';

@Injectable()
export class ReviewsService {
    constructor(
        @InjectRepository(Review)
        private reviewsRepository: Repository<Review>,
    ) { }

    async create(createReviewDto: CreateReviewDto, userId?: string) {
        const review = this.reviewsRepository.create({
            ...createReviewDto,
            user_id: userId,
            is_approved: true, // Auto-aprobar por ahora
            is_visible: true,
        });

        await this.reviewsRepository.save(review);

        return {
            success: true,
            message: 'Review created successfully',
            review,
        };
    }

    async createTable() {
        await this.reviewsRepository.query(`
            CREATE TABLE IF NOT EXISTS reviews (
                id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
                customer_name VARCHAR(255) NOT NULL,
                rating INTEGER NOT NULL,
                comment TEXT NOT NULL,
                pet_name VARCHAR(255),
                service_type VARCHAR(50),
                is_approved TINYINT(1) DEFAULT 1,
                is_visible TINYINT(1) DEFAULT 1,
                user_id CHAR(36),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT chk_rating CHECK (rating >= 1 AND rating <= 5),
                CONSTRAINT fk_reviews_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
            );
            
            CREATE INDEX idx_reviews_visible ON reviews(is_visible, is_approved);
            CREATE INDEX idx_reviews_created ON reviews(created_at);
            CREATE INDEX idx_reviews_rating ON reviews(rating);
        `);
        return { message: 'Tabla reviews creada correctamente' };
    }

    async findAll() {
        return this.reviewsRepository.find({
            where: { is_visible: true, is_approved: true },
            order: { created_at: 'DESC' },
        });
    }

    async getStats() {
        const reviews = await this.reviewsRepository.find({
            where: { is_visible: true, is_approved: true },
        });

        if (reviews.length === 0) {
            return { average: 0, total: 0 };
        }

        const total = reviews.length;
        const sum = reviews.reduce((acc, review) => acc + review.rating, 0);
        const average = Math.round((sum / total) * 10) / 10; // Redondear a 1 decimal

        return { average, total };
    }

    async findAllForAdmin() {
        return this.reviewsRepository.find({
            relations: ['user'],
            order: { created_at: 'DESC' },
        });
    }

    async findOne(id: string) {
        return this.reviewsRepository.findOne({
            where: { id },
            relations: ['user'],
        });
    }

    async approve(id: string) {
        await this.reviewsRepository.update(id, { is_approved: true, is_visible: true });
        return { success: true, message: 'Review approved' };
    }

    async hide(id: string) {
        await this.reviewsRepository.update(id, { is_visible: false });
        return { success: true, message: 'Review hidden' };
    }

    async delete(id: string) {
        await this.reviewsRepository.delete(id);
        return { success: true, message: 'Review deleted' };
    }
}
