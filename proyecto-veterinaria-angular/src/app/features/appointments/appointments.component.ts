import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { Router } from '@angular/router';
import { AppointmentsService } from '../../core/services/appointments.service';
import { NotificationService } from '../../core/services/notification.service';
import { AvailableSlotsService, AvailableDay, TimeSlot } from '../../core/services/available-slots.service';
import { AuthService } from '../../core/services/auth.service';

@Component({
  selector: 'app-appointments',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  template: `
    <div class="page-container">
      <section class="appointments-section">
        <div class="container">
          <h1>Reservar Cita</h1>
          
          @if (!authService.isLoggedIn) {
            <div class="login-required">
              <i class="fas fa-lock"></i>
              <h3>Inicia sesión para reservar una cita</h3>
              <p>Necesitas tener una cuenta para poder gestionar tus citas veterinarias</p>
              <button class="btn-primary" (click)="goToLogin()">Iniciar Sesión</button>
            </div>
          } @else {
            <div class="appointment-form-container">
              <!-- Paso 1: Seleccionar servicio -->
              <div class="step-indicator">
                <div class="step" [class.active]="currentStep >= 1" [class.completed]="currentStep > 1">
                  <span class="step-number">1</span>
                  <span class="step-label">Servicio</span>
                </div>
                <div class="step" [class.active]="currentStep >= 2" [class.completed]="currentStep > 2">
                  <span class="step-number">2</span>
                  <span class="step-label">Horario</span>
                </div>
                <div class="step" [class.active]="currentStep >= 3">
                  <span class="step-number">3</span>
                  <span class="step-label">Detalles</span>
                </div>
              </div>

              <form [formGroup]="appointmentForm" (ngSubmit)="onSubmit()">
                <!-- Paso 1: Información del servicio -->
                @if (currentStep === 1) {
                  <div class="form-step">
                    <h2>Información del Servicio</h2>
                    
                    <div class="form-row">
                      <div class="form-group">
                        <label for="petName">Nombre de la Mascota</label>
                        <input type="text" id="petName" formControlName="petName" 
                               placeholder="Ej: Max" required>
                      </div>
                      <div class="form-group">
                        <label for="petType">Tipo de Mascota</label>
                        <select id="petType" formControlName="petType" required>
                          <option value="">Selecciona...</option>
                          <option value="perro">🐕 Perro</option>
                          <option value="gato">🐈 Gato</option>
                          <option value="otro">🐾 Otro</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="serviceType">Tipo de Servicio</label>
                      <div class="service-cards">
                        <div class="service-card" 
                             *ngFor="let service of services"
                             [class.selected]="appointmentForm.get('serviceType')?.value === service.value"
                             (click)="selectService(service.value)">
                          <i [class]="service.icon"></i>
                          <h4>{{ service.label }}</h4>
                          <p>{{ service.description }}</p>
                        </div>
                      </div>
                    </div>

                    <button type="button" class="btn-next" 
                            [disabled]="!appointmentForm.get('petName')?.valid || !appointmentForm.get('petType')?.valid || !appointmentForm.get('serviceType')?.valid"
                            (click)="nextStep()">
                      Continuar <i class="fas fa-arrow-right"></i>
                    </button>
                  </div>
                }

                <!-- Paso 2: Seleccionar horario -->
                @if (currentStep === 2) {
                  <div class="form-step">
                    <h2>Selecciona Fecha y Hora</h2>
                    
                    @if (loadingSlots) {
                      <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i>
                        <p>Cargando horarios disponibles...</p>
                      </div>
                    } @else {
                      <!-- Selector de Mes y Año -->
                      <div class="month-selector">
                        <button type="button" class="btn-month-nav" (click)="changeMonth(-1)">
                          <i class="fas fa-chevron-left"></i>
                        </button>
                        <h3>{{ months[selectedMonth] }} {{ selectedYear }}</h3>
                        <button type="button" class="btn-month-nav" (click)="changeMonth(1)">
                          <i class="fas fa-chevron-right"></i>
                        </button>
                      </div>

                      <!-- Lista de Días Disponibles -->
                      @if (availableDates.length > 0) {
                        <div class="available-dates-section">
                          <h4><i class="fas fa-calendar-check"></i> Días con horarios disponibles:</h4>
                          <div class="dates-grid">
                            @for (date of availableDates; track date) {
                              <button type="button" 
                                      class="date-button"
                                      [class.selected]="selectedDate === date"
                                      (click)="selectDay(date)">
                                <span class="date-day">{{ date.split('-')[2] }}</span>
                                <span class="date-month">{{ getMonthName(date) }}</span>
                              </button>
                            }
                          </div>
                        </div>

                        <!-- Horarios del Día Seleccionado -->
                        @if (selectedDate && availableTimesForSelectedDate.length > 0) {
                          <div class="times-section">
                            <h4><i class="fas fa-clock"></i> Horarios disponibles para {{ formatDate(selectedDate) }}:</h4>
                            <div class="time-slots">
                              @for (slot of availableTimesForSelectedDate; track slot.id) {
                                <button type="button" 
                                        class="time-slot available"
                                        [class.selected]="selectedSlot?.id === slot.id"
                                        (click)="selectTimeSlot(selectedDate, slot)">
                                  <span class="time">{{ slot.time }}</span>
                                  <span class="doctor">{{ slot.doctorName }}</span>
                                </button>
                              }
                            </div>
                          </div>
                        } @else if (selectedDate) {
                          <div class="no-times-message">
                            <i class="fas fa-info-circle"></i>
                            <p>No hay horarios disponibles para este día</p>
                          </div>
                        }
                      } @else {
                        <div class="no-dates-message">
                          <i class="fas fa-calendar-times"></i>
                          <p>No hay horarios disponibles en {{ months[selectedMonth] }} {{ selectedYear }}</p>
                          <p class="hint">Prueba con otro mes</p>
                        </div>
                      }
                    }

                    <div class="step-buttons">
                      <button type="button" class="btn-back" (click)="previousStep()">
                        <i class="fas fa-arrow-left"></i> Atrás
                      </button>
                      <button type="button" class="btn-next" 
                              [disabled]="!selectedSlot"
                              (click)="nextStep()">
                        Continuar <i class="fas fa-arrow-right"></i>
                      </button>
                    </div>
                  </div>
                }

                <!-- Paso 3: Detalles finales -->
                @if (currentStep === 3) {
                  <div class="form-step">
                    <h2>Confirma tu Cita</h2>
                    
                    <div class="appointment-summary">
                      <div class="summary-item">
                        <i class="fas fa-paw"></i>
                        <div>
                          <strong>Mascota:</strong>
                          <span>{{ appointmentForm.get('petName')?.value }} ({{ appointmentForm.get('petType')?.value }})</span>
                        </div>
                      </div>
                      <div class="summary-item">
                        <i class="fas fa-stethoscope"></i>
                        <div>
                          <strong>Servicio:</strong>
                          <span>{{ getServiceLabel(appointmentForm.get('serviceType')?.value) }}</span>
                        </div>
                      </div>
                      <div class="summary-item">
                        <i class="fas fa-calendar-check"></i>
                        <div>
                          <strong>Fecha y Hora:</strong>
                          <span>{{ selectedSlot ? formatDate(selectedDate!) + ' a las ' + selectedSlot.time : '' }}</span>
                        </div>
                      </div>
                      @if (selectedSlot?.doctorName) {
                        <div class="summary-item">
                          <i class="fas fa-user-md"></i>
                          <div>
                            <strong>Veterinario:</strong>
                            <span>{{ selectedSlot?.doctorName }}</span>
                          </div>
                        </div>
                      }
                    </div>

                    <div class="form-group">
                      <label for="notes">Notas Adicionales (Opcional)</label>
                      <textarea id="notes" formControlName="notes" rows="4" 
                        placeholder="Describe cualquier síntoma, comportamiento o información relevante..."></textarea>
                    </div>

                    <div class="step-buttons">
                      <button type="button" class="btn-back" (click)="previousStep()">
                        <i class="fas fa-arrow-left"></i> Atrás
                      </button>
                      <button type="submit" class="btn-submit" [disabled]="!appointmentForm.valid || isSubmitting">
                        <i class="fas fa-check-circle"></i>
                        {{ isSubmitting ? 'Reservando...' : 'Confirmar Cita' }}
                      </button>
                    </div>
                  </div>
                }
              </form>
            </div>
          }
        </div>
      </section>
    </div>
  `,
  styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    }

    .appointments-section h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 3rem;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }

    .login-required {
      max-width: 500px;
      margin: 0 auto;
      background: white;
      padding: 3rem;
      border-radius: 1rem;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .login-required i {
      font-size: 4rem;
      color: var(--color-primary);
      margin-bottom: 1.5rem;
    }

    .login-required h3 {
      font-size: 1.5rem;
      margin-bottom: 1rem;
      color: #333;
    }

    .login-required p {
      color: #666;
      margin-bottom: 2rem;
    }

    .btn-primary {
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

    .btn-primary:hover {
      background-color: var(--color-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);
    }

    .appointment-form-container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .step-indicator {
      display: flex;
      justify-content: space-between;
      margin-bottom: 3rem;
      position: relative;
    }

    .step-indicator::before {
      content: '';
      position: absolute;
      top: 20px;
      left: 0;
      right: 0;
      height: 2px;
      background: #e0e0e0;
      z-index: 0;
    }

    .step {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.5rem;
      position: relative;
      z-index: 1;
      flex: 1;
    }

    .step-number {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #e0e0e0;
      color: #999;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      transition: all 0.3s;
    }

    .step.active .step-number {
      background: var(--color-primary);
      color: white;
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);
    }

    .step.completed .step-number {
      background: #4caf50;
      color: white;
    }

    .step-label {
      font-size: 0.9rem;
      color: #666;
      font-weight: 500;
    }

    .step.active .step-label {
      color: var(--color-primary);
      font-weight: 600;
    }

    .form-step h2 {
      font-size: 1.8rem;
      color: #333;
      margin-bottom: 2rem;
      text-align: center;
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
      font-weight: 600;
      color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem;
      border: 2px solid #e0e0e0;
      border-radius: 0.5rem;
      font-size: 1rem;
      transition: all 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--color-primary);
      box-shadow: 0 0 0 3px rgba(0, 150, 136, 0.1);
    }

    .service-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-top: 1rem;
    }

    .service-card {
      padding: 1.5rem;
      border: 2px solid #e0e0e0;
      border-radius: 0.75rem;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s;
    }

    .service-card:hover {
      border-color: var(--color-primary);
      transform: translateY(-4px);
      box-shadow: 0 6px 20px rgba(0, 150, 136, 0.2);
    }

    .service-card.selected {
      border-color: var(--color-primary);
      background: rgba(0, 150, 136, 0.05);
      box-shadow: 0 6px 20px rgba(0, 150, 136, 0.2);
    }

    .service-card i {
      font-size: 2.5rem;
      color: var(--color-primary);
      margin-bottom: 0.75rem;
    }

    .service-card h4 {
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
      color: #333;
    }

    .service-card p {
      font-size: 0.85rem;
      color: #666;
      margin: 0;
    }

    .calendar-container {
      max-height: 600px;
      overflow-y: auto;
      padding: 1rem;
      background: #f8f9fa;
      border-radius: 0.75rem;
    }

    .load-more-container {
      text-align: center;
      margin-top: 1.5rem;
      padding: 1rem;
    }

    .btn-load-more {
      padding: 0.75rem 2rem;
      background: var(--color-primary);
      color: white;
      border: none;
      border-radius: 0.5rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-load-more:hover:not(:disabled) {
      background: var(--color-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);
    }

    .btn-load-more:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    /* Selector de Mes/Año */
    .month-selector {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 2rem;
      margin-bottom: 2rem;
      padding: 1.5rem;
      background: white;
      border-radius: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .month-selector h3 {
      margin: 0;
      font-size: 1.5rem;
      color: var(--color-primary);
      min-width: 200px;
      text-align: center;
    }

    .btn-month-nav {
      background: var(--color-primary);
      color: white;
      border: none;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .btn-month-nav:hover {
      background: var(--color-primary-dark);
      transform: scale(1.1);
    }

    /* Sección de Días Disponibles */
    .available-dates-section {
      margin-bottom: 2rem;
    }

    .available-dates-section h4 {
      color: #333;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .available-dates-section h4 i {
      color: var(--color-primary);
    }

    .dates-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .date-button {
      background: white;
      border: 2px solid #e0e0e0;
      border-radius: 0.75rem;
      padding: 1rem;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.25rem;
    }

    .date-button:hover {
      border-color: var(--color-primary);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.2);
    }

    .date-button.selected {
      background: var(--color-primary);
      border-color: var(--color-primary);
      color: white;
    }

    .date-day {
      font-size: 1.5rem;
      font-weight: 700;
    }

    .date-month {
      font-size: 0.875rem;
      opacity: 0.8;
    }

    /* Sección de Horarios */
    .times-section {
      background: white;
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .times-section h4 {
      color: #333;
      margin-bottom: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .times-section h4 i {
      color: var(--color-primary);
    }

    /* Mensajes */
    .no-times-message,
    .no-dates-message {
      text-align: center;
      padding: 3rem 2rem;
      background: white;
      border-radius: 1rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .no-times-message i,
    .no-dates-message i {
      font-size: 3rem;
      color: var(--color-primary);
      margin-bottom: 1rem;
    }

    .no-times-message p,
    .no-dates-message p {
      color: #666;
      margin: 0.5rem 0;
    }

    .no-dates-message .hint {
      color: var(--color-primary);
      font-weight: 600;
    }

    .day-section {
      margin-bottom: 2rem;
    }

    .day-header {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 1rem;
      padding: 0.75rem;
      background: white;
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .day-header i {
      color: var(--color-primary);
    }

    .day-name {
      margin-left: auto;
      font-size: 0.9rem;
      color: #666;
      font-weight: normal;
    }

    .time-slots {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 0.75rem;
    }

    .time-slot {
      padding: 0.75rem;
      border: 2px solid #e0e0e0;
      border-radius: 0.5rem;
      background: white;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
    }

    .time-slot:disabled {
      opacity: 0.5;
      cursor: not-allowed;
      background: #f5f5f5;
    }

    .time-slot.available:hover:not(:disabled) {
      border-color: var(--color-primary);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.2);
    }

    .time-slot.selected {
      border-color: var(--color-primary);
      background: var(--color-primary);
      color: white;
    }

    .time-slot .time {
      font-weight: 600;
      font-size: 1.1rem;
    }

    .time-slot .doctor {
      font-size: 0.8rem;
      color: #666;
    }

    .time-slot.selected .doctor {
      color: rgba(255,255,255,0.9);
    }

    .time-slot .unavailable-label {
      font-size: 0.75rem;
      color: #999;
    }

    .loading {
      text-align: center;
      padding: 3rem;
    }

    .loading i {
      font-size: 3rem;
      color: var(--color-primary);
      margin-bottom: 1rem;
    }

    .appointment-summary {
      background: #f8f9fa;
      padding: 1.5rem;
      border-radius: 0.75rem;
      margin-bottom: 2rem;
    }

    .summary-item {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      padding: 1rem;
      margin-bottom: 0.75rem;
      background: white;
      border-radius: 0.5rem;
    }

    .summary-item:last-child {
      margin-bottom: 0;
    }

    .summary-item i {
      font-size: 1.5rem;
      color: var(--color-primary);
      margin-top: 0.25rem;
    }

    .summary-item div {
      flex: 1;
    }

    .summary-item strong {
      display: block;
      margin-bottom: 0.25rem;
      color: #333;
    }

    .summary-item span {
      color: #666;
    }

    .step-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 2rem;
    }

    .btn-back,
    .btn-next,
    .btn-submit {
      flex: 1;
      padding: 1rem 2rem;
      border: none;
      border-radius: 0.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-back {
      background: #e0e0e0;
      color: #666;
    }

    .btn-back:hover {
      background: #d0d0d0;
    }

    .btn-next,
    .btn-submit {
      background-color: var(--color-primary);
      color: white;
    }

    .btn-next:hover:not(:disabled),
    .btn-submit:hover:not(:disabled) {
      background-color: var(--color-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);
    }

    .btn-next:disabled,
    .btn-submit:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    @media (max-width: 768px) {
      .appointment-form-container {
        padding: 1.5rem;
      }

      .step-label {
        font-size: 0.75rem;
      }

      .service-cards {
        grid-template-columns: 1fr;
      }

      .time-slots {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      }
    }
  `]
})
export class AppointmentsComponent implements OnInit {
  appointmentForm: FormGroup;
  isSubmitting = false;
  currentStep = 1;
  loadingSlots = false;
  availableDays: AvailableDay[] = [];
  selectedSlot: TimeSlot | null = null;
  selectedDate: string | null = null;

  // Nuevo diseño de selector
  selectedMonth: number = new Date().getMonth();
  selectedYear: number = new Date().getFullYear();
  availableDates: string[] = []; // Días con horarios disponibles
  availableTimesForSelectedDate: TimeSlot[] = []; // Horarios del día seleccionado
  months = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
  ];

  services = [
    {
      value: 'consulta',
      label: 'Consulta General',
      description: 'Revisión general de salud',
      icon: 'fas fa-stethoscope'
    },
    {
      value: 'vacunacion',
      label: 'Vacunación',
      description: 'Vacunas y refuerzos',
      icon: 'fas fa-syringe'
    },
    {
      value: 'peluqueria',
      label: 'Peluquería',
      description: 'Corte y aseo',
      icon: 'fas fa-cut'
    },
    {
      value: 'emergencia',
      label: 'Emergencia',
      description: 'Atención urgente',
      icon: 'fas fa-ambulance'
    }
  ];

  constructor(
    private fb: FormBuilder,
    private router: Router,
    private appointmentsService: AppointmentsService,
    private notificationService: NotificationService,
    private availableSlotsService: AvailableSlotsService,
    public authService: AuthService
  ) {
    this.appointmentForm = this.fb.group({
      petName: ['', Validators.required],
      petType: ['', Validators.required],
      serviceType: ['', Validators.required],
      appointmentDate: ['', Validators.required],
      notes: ['']
    });
  }

  ngOnInit(): void {
    // Si el usuario no está logueado, no cargar horarios
    if (!this.authService.isLoggedIn) {
      return;
    }
  }

  goToLogin(): void {
    this.router.navigate(['/single-page'], { fragment: 'login' });
  }

  selectService(value: string): void {
    this.appointmentForm.patchValue({ serviceType: value });
  }

  nextStep(): void {
    if (this.currentStep === 1) {
      // Cargar días disponibles del mes actual al pasar al paso 2
      this.loadAvailableDatesForMonth();
    }

    if (this.currentStep < 3) {
      this.currentStep++;
    }
  }

  previousStep(): void {
    if (this.currentStep > 1) {
      this.currentStep--;
    }
  }

  loadAvailableSlots(): void {
    this.loadingSlots = true;
    const today = new Date();

    // Cargar el mes completo desde hoy
    const startDate = today.toISOString().split('T')[0];
    const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
    const endDate = endOfMonth.toISOString().split('T')[0];

    const serviceType = this.appointmentForm.get('serviceType')?.value;

    this.availableSlotsService.getAvailableSlots(startDate, endDate, serviceType)
      .subscribe({
        next: (response) => {
          this.availableDays = response.days;
          this.loadingSlots = false;
        },
        error: (error) => {
          console.error('Error cargando horarios:', error);
          this.notificationService.showError('Error al cargar horarios disponibles');
          this.loadingSlots = false;
        }
      });
  }

  loadNextMonth(): void {
    if (this.availableDays.length === 0) return;

    this.loadingSlots = true;
    const lastDate = new Date(this.availableDays[this.availableDays.length - 1].date);

    // Cargar el siguiente mes
    const nextMonth = new Date(lastDate);
    nextMonth.setDate(lastDate.getDate() + 1);

    const startDate = nextMonth.toISOString().split('T')[0];
    const endOfMonth = new Date(nextMonth.getFullYear(), nextMonth.getMonth() + 1, 0);
    const endDate = endOfMonth.toISOString().split('T')[0];

    // Verificar que no exceda 1 año desde hoy
    const oneYearFromNow = new Date();
    oneYearFromNow.setFullYear(oneYearFromNow.getFullYear() + 1);

    if (nextMonth > oneYearFromNow) {
      this.notificationService.showError('No se pueden cargar citas más allá de un año');
      this.loadingSlots = false;
      return;
    }

    const serviceType = this.appointmentForm.get('serviceType')?.value;

    this.availableSlotsService.getAvailableSlots(startDate, endDate, serviceType)
      .subscribe({
        next: (response) => {
          this.availableDays = [...this.availableDays, ...response.days];
          this.loadingSlots = false;
        },
        error: (error) => {
          console.error('Error cargando horarios:', error);
          this.notificationService.showError('Error al cargar horarios disponibles');
          this.loadingSlots = false;
        }
      });
  }

  // Métodos para el nuevo diseño
  changeMonth(direction: number): void {
    this.selectedMonth += direction;
    if (this.selectedMonth > 11) {
      this.selectedMonth = 0;
      this.selectedYear++;
    } else if (this.selectedMonth < 0) {
      this.selectedMonth = 11;
      this.selectedYear--;
    }
    this.loadAvailableDatesForMonth();
  }

  loadAvailableDatesForMonth(): void {
    this.loadingSlots = true;
    this.availableDates = [];
    this.availableTimesForSelectedDate = [];
    this.selectedDate = null;

    // Obtener primer y último día del mes seleccionado
    const firstDay = new Date(this.selectedYear, this.selectedMonth, 1);
    const lastDay = new Date(this.selectedYear, this.selectedMonth + 1, 0);

    const startDate = firstDay.toISOString().split('T')[0];
    const endDate = lastDay.toISOString().split('T')[0];
    const serviceType = this.appointmentForm.get('serviceType')?.value;

    this.availableSlotsService.getAvailableSlots(startDate, endDate, serviceType)
      .subscribe({
        next: (response) => {
          this.availableDays = response.days;

          // Extraer solo las fechas que tienen al menos un horario disponible
          this.availableDates = response.days
            .filter(day => day.slots.some(slot => slot.available))
            .map(day => day.date);

          this.loadingSlots = false;
        },
        error: (error) => {
          console.error('Error cargando horarios:', error);
          this.notificationService.showError('Error al cargar horarios disponibles');
          this.loadingSlots = false;
        }
      });
  }

  selectDay(date: string): void {
    this.selectedDate = date;

    // Encontrar los horarios disponibles para este día
    const dayData = this.availableDays.find(d => d.date === date);
    if (dayData) {
      // Filtrar solo los horarios disponibles (no ocupados)
      this.availableTimesForSelectedDate = dayData.slots.filter(slot => slot.available);
    } else {
      this.availableTimesForSelectedDate = [];
    }
  }

  selectTimeSlot(date: string, slot: TimeSlot): void {
    if (!slot.available) return;

    this.selectedSlot = slot;
    this.selectedDate = date;

    // Actualizar el formulario con la fecha y hora seleccionada
    const dateTime = `${date}T${slot.time}:00`;
    this.appointmentForm.patchValue({ appointmentDate: dateTime });
  }

  formatDate(dateStr: string): string {
    return this.availableSlotsService.formatDate(dateStr);
  }

  getMonthName(dateStr: string): string {
    const monthIndex = parseInt(dateStr.split('-')[1]) - 1;
    return this.months[monthIndex].substring(0, 3);
  }

  getServiceLabel(value: string): string {
    const service = this.services.find(s => s.value === value);
    return service ? service.label : value;
  }

  onSubmit(): void {
    if (this.appointmentForm.valid && this.authService.isLoggedIn) {
      this.isSubmitting = true;

      const formValue = this.appointmentForm.value;
      const user = this.authService.currentUserValue;

      // Extraer fecha y hora del appointmentDate
      const dateTimeStr = formValue.appointmentDate; // Formato: "YYYY-MM-DDTHH:MM:SS"
      const [datePart, timePart] = dateTimeStr.split('T');
      const preferredDate = datePart; // YYYY-MM-DD
      const preferredTime = timePart.substring(0, 5); // HH:MM

      // Transformar al formato que espera el backend
      const appointmentData = {
        owner_name: user?.username || 'Usuario',
        email: user?.email || '',
        phone: '000000000',
        pet_name: formValue.petName,
        pet_type: formValue.petType,
        service_type: formValue.serviceType,
        preferred_date: preferredDate,
        preferred_time: preferredTime,
        notes: formValue.notes || ''
      };

      this.appointmentsService.createAppointment(appointmentData).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess('¡Cita reservada exitosamente! Nos pondremos en contacto contigo pronto.');
          this.appointmentForm.reset();
          this.currentStep = 1;
          this.selectedSlot = null;
          this.selectedDate = null;
          setTimeout(() => {
            this.router.navigate(['/gracias']);
          }, 1000);
        },
        error: (error) => {
          this.isSubmitting = false;
          console.error('Error al reservar cita:', error);
          this.notificationService.showError(error.message || 'Error al reservar la cita. Por favor, inténtalo de nuevo.');
        }
      });
    }
  }
}
