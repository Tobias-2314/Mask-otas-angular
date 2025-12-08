import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    CreateDateColumn,
} from 'typeorm';

@Entity('contacts')
export class Contact {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column()
    name: string;

    @Column()
    email: string;

    @Column()
    subject: string;

    @Column({ type: 'text' })
    message: string;

    @Column({ default: 'pending' })
    status: string; // pending, responded, archived

    @CreateDateColumn()
    created_at: Date;
}
