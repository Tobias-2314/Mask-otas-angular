import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    CreateDateColumn,
    UpdateDateColumn,
    Index,
} from 'typeorm';

@Entity('time_slots')
@Index(['slot_date', 'slot_time'], { unique: true })
export class TimeSlot {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column({ type: 'date' })
    slot_date: Date;

    @Column({ type: 'time' })
    slot_time: string;

    @Column({ type: 'int', default: 3 })
    max_capacity: number; // Máximo de citas por horario

    @Column({ type: 'int', default: 0 })
    current_bookings: number; // Citas actuales reservadas

    @Column({ type: 'varchar', length: 100, nullable: true })
    doctor_name: string;

    @CreateDateColumn()
    created_at: Date;

    @UpdateDateColumn()
    updated_at: Date;

    // Método helper para verificar disponibilidad
    get isAvailable(): boolean {
        return this.current_bookings < this.max_capacity;
    }

    get availableSpots(): number {
        return this.max_capacity - this.current_bookings;
    }
}
