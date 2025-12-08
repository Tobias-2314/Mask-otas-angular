import {
    Entity,
    Column,
    PrimaryGeneratedColumn,
    CreateDateColumn,
    UpdateDateColumn,
    ManyToOne,
    JoinColumn,
} from 'typeorm';
import { City } from '../location/city.entity';

@Entity('users')
export class User {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column({ unique: true })
    email: string;

    @Column()
    username: string;

    @Column()
    password: string;

    @Column({ nullable: true, name: 'country_code' })
    countryCode: string;

    @ManyToOne(() => City, { nullable: true, eager: true })
    @JoinColumn({ name: 'city_id' })
    city: City;

    @Column({ nullable: true, name: 'city_id' })
    cityId: number;

    @CreateDateColumn()
    created_at: Date;

    @UpdateDateColumn()
    updated_at: Date;

    @Column({ type: 'timestamp', nullable: true })
    last_login: Date;
}
