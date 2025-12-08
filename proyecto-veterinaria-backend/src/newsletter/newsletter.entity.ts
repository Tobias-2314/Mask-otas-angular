import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    CreateDateColumn,
} from 'typeorm';

@Entity('newsletter_subscriptions')
export class NewsletterSubscription {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column({ unique: true })
    email: string;

    @Column({ default: true })
    is_active: boolean;

    @CreateDateColumn()
    subscribed_at: Date;
}
