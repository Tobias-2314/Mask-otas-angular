import { Injectable, UnauthorizedException, ConflictException } from '@nestjs/common';
import { JwtService } from '@nestjs/jwt';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import * as bcrypt from 'bcrypt';
import { User } from '../users/user.entity';
import { RegisterDto, LoginDto } from './dto/auth.dto';

@Injectable()
export class AuthService {
    constructor(
        @InjectRepository(User)
        private usersRepository: Repository<User>,
        private jwtService: JwtService,
    ) { }

    async register(registerDto: RegisterDto) {
        // Check if user exists
        const existingUser = await this.usersRepository.findOne({
            where: { email: registerDto.email },
        });

        if (existingUser) {
            throw new ConflictException('Email already registered');
        }

        // Hash password
        const hashedPassword = await bcrypt.hash(registerDto.password, 10);

        // Create user
        const user = this.usersRepository.create({
            ...registerDto,
            password: hashedPassword,
        });

        await this.usersRepository.save(user);

        // Remove password from response
        const { password, ...result } = user;

        return {
            success: true,
            message: 'User registered successfully',
            user: result,
        };
    }

    async login(loginDto: LoginDto) {
        const user = await this.usersRepository.findOne({
            where: { email: loginDto.email },
            relations: ['city'],
        });

        if (!user) {
            throw new UnauthorizedException('Invalid credentials');
        }

        const isPasswordValid = await bcrypt.compare(loginDto.password, user.password);

        if (!isPasswordValid) {
            throw new UnauthorizedException('Invalid credentials');
        }

        // Update last login
        user.last_login = new Date();
        await this.usersRepository.save(user);

        // Generate JWT token
        const payload = { email: user.email, sub: user.id };
        const access_token = this.jwtService.sign(payload);

        const { password, ...userWithoutPassword } = user;

        return {
            success: true,
            access_token,
            user: userWithoutPassword,
        };
    }

    async validateUser(email: string): Promise<User | null> {
        return this.usersRepository.findOne({
            where: { email },
            relations: ['city'],
        });
    }
}
