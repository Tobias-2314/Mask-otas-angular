import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    CreateDateColumn,
    ManyToOne,
    JoinColumn,
} from 'typeorm';
import { User } from '../users/user.entity';

@Entity('reviews')
export class Review {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column()
    customer_name: string;

    @Column({ type: 'int' })
    rating: number; // 1-5 estrellas

    @Column({ type: 'text' })
    comment: string;

    @Column({ nullable: true })
    pet_name: string;

    @Column({ type: 'varchar', length: 50, nullable: true })
    service_type: string; // consulta, vacunacion, peluqueria, emergencia

    @Column({ type: 'boolean', default: false })
    is_approved: boolean; // Para moderación

    @Column({ type: 'boolean', default: true })
    is_visible: boolean; // Para mostrar/ocultar

    @ManyToOne(() => User, { nullable: true })
    @JoinColumn({ name: 'user_id' })
    user: User;

    @Column({ nullable: true })
    user_id: string;

    @CreateDateColumn()
    created_at: Date;
}
