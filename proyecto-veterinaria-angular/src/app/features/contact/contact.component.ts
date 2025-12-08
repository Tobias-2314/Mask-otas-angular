import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { ContactService } from '../../core/services/contact.service';
import { NotificationService } from '../../core/services/notification.service';

@Component({
  selector: 'app-contact',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  template: `
    <div class="page-container">
      <section class="contact-section">
        <div class="container">
          <h1>Contacto</h1>
          <div class="contact-grid">
            <div class="contact-form-container">
              <h2>Envíanos un mensaje</h2>
              <form [formGroup]="contactForm" (ngSubmit)="onSubmit()">
                <div class="form-group">
                  <label for="name">Nombre</label>
                  <input type="text" id="name" formControlName="name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" formControlName="email" required>
                </div>
                <div class="form-group">
                  <label for="phone">Teléfono (opcional)</label>
                  <input type="tel" id="phone" formControlName="phone">
                </div>
                <div class="form-group">
                  <label for="subject">Asunto</label>
                  <input type="text" id="subject" formControlName="subject" required>
                </div>
                <div class="form-group">
                  <label for="message">Mensaje</label>
                  <textarea id="message" formControlName="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-btn" [disabled]="!contactForm.valid || isSubmitting">
                  {{ isSubmitting ? 'Enviando...' : 'Enviar Mensaje' }}
                </button>
              </form>
            </div>
            <div class="contact-info">
              <h2>Información de Contacto</h2>
              <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <p>C/ dels Sants Just i Pastor, 70<br>46940 Manises, València</p>
              </div>
              <div class="info-item">
                <i class="fas fa-phone"></i>
                <p>+34 123 456 789</p>
              </div>
              <div class="info-item">
                <i class="fas fa-envelope"></i>
                <p>info&#64;MASK!OTAS.com</p>
              </div>
              <div class="info-item">
                <i class="fas fa-clock"></i>
                <p>Lunes - Viernes: 9:00 - 20:00<br>
                Sábados: 10:00 - 15:00<br>
                Domingos: Emergencias</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  `,
  styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
      background-color: var(--color-bg-gray);
    }

    .contact-section h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 3rem;
    }

    .contact-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 2rem;
    }

    @media (min-width: 768px) {
      .contact-grid {
        grid-template-columns: 1fr 1fr;
      }
    }

    .contact-form-container,
    .contact-info {
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    h2 {
      color: var(--color-primary);
      margin-bottom: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 1rem;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--color-primary);
    }

    .submit-btn {
      width: 100%;
      padding: 0.75rem 1.5rem;
      background-color: var(--color-primary);
      color: white;
      border: none;
      border-radius: 0.5rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .submit-btn:hover:not(:disabled) {
      background-color: var(--color-primary-dark);
    }

    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    .info-item {
      display: flex;
      gap: 1rem;
      margin-bottom: 1.5rem;
      align-items: flex-start;
    }

    .info-item i {
      font-size: 1.5rem;
      color: var(--color-primary);
      margin-top: 0.25rem;
    }

    .info-item p {
      margin: 0;
      color: var(--color-text-gray);
      line-height: 1.6;
    }
  `]
})
export class ContactComponent {
  contactForm: FormGroup;
  isSubmitting = false;

  constructor(
    private fb: FormBuilder,
    private router: Router,
    private contactService: ContactService,
    private notificationService: NotificationService
  ) {
    this.contactForm = this.fb.group({
      name: ['', Validators.required],
      email: ['', [Validators.required, Validators.email]],
      phone: [''],
      subject: ['', Validators.required],
      message: ['', Validators.required]
    });
  }

  onSubmit(): void {
    if (this.contactForm.valid) {
      this.isSubmitting = true;
      this.contactService.submitContact(this.contactForm.value).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess('¡Mensaje enviado! Nos pondremos en contacto contigo pronto.');
          this.contactForm.reset();
          setTimeout(() => {
            this.router.navigate(['/gracias']);
          }, 1000);
        },
        error: (error) => {
          this.isSubmitting = false;
          this.notificationService.showError(error.message || 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.');
        }
      });
    }
  }
}
