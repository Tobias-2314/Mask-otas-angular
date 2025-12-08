import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { AppointmentsService } from '../../core/services/appointments.service';
import { NotificationService } from '../../core/services/notification.service';

@Component({
  selector: 'app-appointments',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  template: `
    <div class="page-container">
      <section class="appointments-section">
        <div class="container">
          <h1>Reservar Cita</h1>
          <div class="appointment-form-container">
            <form [formGroup]="appointmentForm" (ngSubmit)="onSubmit()">
              <div class="form-row">
                <div class="form-group">
                  <label for="petName">Nombre de la Mascota</label>
                  <input type="text" id="petName" formControlName="petName" required>
                </div>
                <div class="form-group">
                  <label for="petType">Tipo de Mascota</label>
                  <select id="petType" formControlName="petType" required>
                    <option value="">Selecciona...</option>
                    <option value="perro">Perro</option>
                    <option value="gato">Gato</option>
                    <option value="otro">Otro</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="serviceType">Tipo de Servicio</label>
                  <select id="serviceType" formControlName="serviceType" required>
                    <option value="">Selecciona...</option>
                    <option value="consulta">Consulta General</option>
                    <option value="vacunacion">Vacunación</option>
                    <option value="peluqueria">Peluquería</option>
                    <option value="emergencia">Emergencia</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="appointmentDate">Fecha y Hora</label>
                  <input type="datetime-local" id="appointmentDate" formControlName="appointmentDate" required>
                </div>
              </div>

              <div class="form-group">
                <label for="notes">Notas Adicionales</label>
                <textarea id="notes" formControlName="notes" rows="4" 
                  placeholder="Describe cualquier síntoma, comportamiento o información relevante..."></textarea>
              </div>

              <button type="submit" class="submit-btn" [disabled]="!appointmentForm.valid || isSubmitting">
                {{ isSubmitting ? 'Reservando...' : 'Reservar Cita' }}
              </button>
            </form>
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

    .appointments-section h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 3rem;
    }

    .appointment-form-container {
      max-width: 800px;
      margin: 0 auto;
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-row {
      display: grid;
      grid-template-columns: 1fr;
      gap: 1.5rem;
      margin-bottom: 0;
    }

    @media (min-width: 768px) {
      .form-row {
        grid-template-columns: 1fr 1fr;
      }
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem;
      border: 1px solid #d1d5db;
      border-radius: 0.375rem;
      font-size: 1rem;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(0, 150, 136, 0.1);
    }

    .submit-btn {
      width: 100%;
      padding: 1rem 2rem;
      background-color: var(--color-primary);
      color: white;
      border: none;
      border-radius: 0.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
    }

    .submit-btn:hover:not(:disabled) {
      background-color: var(--color-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);
    }

    .submit-btn:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }
  `]
})
export class AppointmentsComponent {
  appointmentForm: FormGroup;
  isSubmitting = false;

  constructor(
    private fb: FormBuilder,
    private router: Router,
    private appointmentsService: AppointmentsService,
    private notificationService: NotificationService
  ) {
    this.appointmentForm = this.fb.group({
      petName: ['', Validators.required],
      petType: ['', Validators.required],
      serviceType: ['', Validators.required],
      appointmentDate: ['', Validators.required],
      notes: ['']
    });
  }

  onSubmit(): void {
    if (this.appointmentForm.valid) {
      this.isSubmitting = true;
      this.appointmentsService.createAppointment(this.appointmentForm.value).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess('¡Cita reservada exitosamente! Nos pondremos en contacto contigo pronto.');
          this.appointmentForm.reset();
          setTimeout(() => {
            this.router.navigate(['/gracias']);
          }, 1000);
        },
        error: (error) => {
          this.isSubmitting = false;
          this.notificationService.showError(error.message || 'Error al reservar la cita. Por favor, inténtalo de nuevo.');
        }
      });
    }
  }
}
