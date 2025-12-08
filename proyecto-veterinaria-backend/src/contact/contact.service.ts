import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Contact } from './contact.entity';
import { CreateContactDto } from './dto/create-contact.dto';

@Injectable()
export class ContactService {
    constructor(
        @InjectRepository(Contact)
        private contactRepository: Repository<Contact>,
    ) { }

    async create(createContactDto: CreateContactDto) {
        const contact = this.contactRepository.create(createContactDto);
        await this.contactRepository.save(contact);

        return {
            success: true,
            message: 'Message sent successfully',
        };
    }

    async findAll() {
        return this.contactRepository.find({
            order: { created_at: 'DESC' },
        });
    }
}
