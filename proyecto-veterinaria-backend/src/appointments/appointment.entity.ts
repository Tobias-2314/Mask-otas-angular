import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    CreateDateColumn,
    ManyToOne,
    JoinColumn,
} from 'typeorm';
import { User } from '../users/user.entity';

@Entity('appointments')
export class Appointment {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column()
    owner_name: string;

    @Column()
    email: string;

    @Column()
    phone: string;

    @Column()
    pet_name: string;

    @Column({ type: 'varchar', length: 50 })
    pet_type: string; // perro, gato, otro

    @Column({ type: 'varchar', length: 100 })
    service_type: string; // consulta, vacunacion, peluqueria, emergencia

    @Column({ type: 'date' })
    preferred_date: Date;

    @Column({ type: 'time' })
    preferred_time: string;

    @Column({ type: 'text', nullable: true })
    notes: string;

    @Column({ type: 'varchar', length: 20, default: 'pending' })
    status: string; // pending, confirmed, cancelled, completed

    @ManyToOne(() => User, { nullable: true })
    @JoinColumn({ name: 'user_id' })
    user: User;

    @Column({ nullable: true })
    user_id: string;

    @CreateDateColumn()
    created_at: Date;
}
