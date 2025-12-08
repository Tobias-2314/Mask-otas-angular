import { Entity, Column, PrimaryColumn } from 'typeorm';

@Entity('countries')
export class Country {
    @PrimaryColumn({ type: 'varchar', length: 3 })
    code: string;

    @Column()
    name: string;
}
