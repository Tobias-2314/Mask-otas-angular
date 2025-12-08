import { Injectable, ConflictException } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { NewsletterSubscription } from './newsletter.entity';
import { SubscribeDto } from './dto/subscribe.dto';

@Injectable()
export class NewsletterService {
    constructor(
        @InjectRepository(NewsletterSubscription)
        private newsletterRepository: Repository<NewsletterSubscription>,
    ) { }

    async subscribe(subscribeDto: SubscribeDto) {
        const existing = await this.newsletterRepository.findOne({
            where: { email: subscribeDto.email },
        });

        if (existing && existing.is_active) {
            throw new ConflictException('Email already subscribed');
        }

        if (existing && !existing.is_active) {
            existing.is_active = true;
            await this.newsletterRepository.save(existing);
            return { success: true, message: 'Subscription reactivated' };
        }

        const subscription = this.newsletterRepository.create(subscribeDto);
        await this.newsletterRepository.save(subscription);

        return {
            success: true,
            message: 'Successfully subscribed to newsletter',
        };
    }

    async findAll() {
        return this.newsletterRepository.find({
            where: { is_active: true },
            order: { subscribed_at: 'DESC' },
        });
    }
}
