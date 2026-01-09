import { Component, OnInit, ChangeDetectionStrategy, ChangeDetectorRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { ReviewsService, Review, CreateReviewDto } from '../../core/services/reviews.service';
import { NotificationService } from '../../core/services/notification.service';

@Component({
  selector: 'app-reviews',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  changeDetection: ChangeDetectionStrategy.OnPush,
  template: `
    <div class="reviews-container">
      <!-- Sección de Reseñas Existentes -->
      <section class="reviews-display">
        <h2><i class="fas fa-star"></i> Lo que dicen nuestros clientes</h2>
        
        @if (loadingReviews) {
          <div class="loading">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Cargando reseñas...</p>
          </div>
        } @else if (reviews.length > 0) {
          <div class="reviews-grid">
            @for (review of reviews; track review.id) {
              <div class="review-card">
                <div class="review-header">
                  <div class="customer-info">
                    <div class="avatar">
                      <i class="fas fa-user"></i>
                    </div>
                    <div>
                      <h4>{{ review.customer_name }}</h4>
                      @if (review.pet_name) {
                        <p class="pet-name"><i class="fas fa-paw"></i> {{ review.pet_name }}</p>
                      }
                    </div>
                  </div>
                  <div class="rating">
                    @for (star of [1,2,3,4,5]; track star) {
                      <i class="fas fa-star" [class.filled]="star <= review.rating"></i>
                    }
                  </div>
                </div>
                <p class="comment">{{ review.comment }}</p>
                @if (review.service_type) {
                  <span class="service-badge">{{ getServiceLabel(review.service_type) }}</span>
                }
                <span class="date">{{ formatDate(review.created_at) }}</span>
              </div>
            }
          </div>
        } @else {
          <div class="no-reviews">
            <i class="fas fa-comments"></i>
            <p>Sé el primero en dejar una reseña</p>
          </div>
        }
      </section>

      <!-- Formulario para Nueva Reseña -->
      <section class="add-review">
        <h3><i class="fas fa-pen"></i> Comparte tu experiencia</h3>
        
        <form [formGroup]="reviewForm" (ngSubmit)="onSubmit()">
          <div class="form-group">
            <label for="customer_name">
              <i class="fas fa-user"></i> Tu nombre *
            </label>
            <input 
              type="text" 
              id="customer_name"
              formControlName="customer_name"
              placeholder="Ej: María García"
              [class.error]="reviewForm.get('customer_name')?.invalid && reviewForm.get('customer_name')?.touched">
          </div>

          <div class="form-group">
            <label for="pet_name">
              <i class="fas fa-paw"></i> Nombre de tu mascota
            </label>
            <input 
              type="text" 
              id="pet_name"
              formControlName="pet_name"
              placeholder="Ej: Max">
          </div>

          <div class="form-group">
            <label for="service_type">
              <i class="fas fa-briefcase-medical"></i> Servicio recibido
            </label>
            <select id="service_type" formControlName="service_type">
              <option value="">Selecciona un servicio</option>
              <option value="consulta">Consulta General</option>
              <option value="vacunacion">Vacunación</option>
              <option value="peluqueria">Peluquería</option>
              <option value="emergencia">Emergencia</option>
            </select>
          </div>

          <div class="form-group">
            <label>
              <i class="fas fa-star"></i> Calificación *
            </label>
            <div class="rating-selector">
              @for (star of [1,2,3,4,5]; track star) {
                <button 
                  type="button"
                  class="star-btn"
                  [class.selected]="star <= (reviewForm.get('rating')?.value || 0)"
                  (click)="setRating(star)">
                  <i class="fas fa-star"></i>
                </button>
              }
            </div>
            @if (reviewForm.get('rating')?.invalid && reviewForm.get('rating')?.touched) {
              <span class="error-message">Por favor selecciona una calificación</span>
            }
          </div>

          <div class="form-group">
            <label for="comment">
              <i class="fas fa-comment"></i> Tu opinión *
            </label>
            <textarea 
              id="comment"
              formControlName="comment"
              rows="4"
              placeholder="Cuéntanos sobre tu experiencia..."
              [class.error]="reviewForm.get('comment')?.invalid && reviewForm.get('comment')?.touched"></textarea>
          </div>

          <button 
            type="submit" 
            class="btn-submit"
            [disabled]="reviewForm.invalid || isSubmitting">
            @if (isSubmitting) {
              <i class="fas fa-spinner fa-spin"></i> Enviando...
            } @else {
              <i class="fas fa-paper-plane"></i> Enviar Reseña
            }
          </button>
        </form>
      </section>
    </div>
  `,
  styles: [`
    .reviews-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem;
    }

    .reviews-display {
      margin-bottom: 4rem;
    }

    .reviews-display h2 {
      text-align: center;
      color: var(--color-primary);
      font-size: 2rem;
      margin-bottom: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .loading, .no-reviews {
      text-align: center;
      padding: 3rem;
      color: #666;
    }

    .loading i, .no-reviews i {
      font-size: 3rem;
      color: var(--color-primary);
      margin-bottom: 1rem;
    }

    .reviews-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
      gap: 2rem;
    }

    .review-card {
      background: white;
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .review-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    }

    .review-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 1rem;
    }

    .customer-info {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.5rem;
    }

    .customer-info h4 {
      margin: 0;
      color: #333;
    }

    .pet-name {
      margin: 0.25rem 0 0 0;
      color: #666;
      font-size: 0.875rem;
    }

    .rating {
      display: flex;
      gap: 0.25rem;
    }

    .rating i {
      color: #ddd;
      font-size: 1.2rem;
    }

    .rating i.filled {
      color: #ffc107;
    }

    .comment {
      color: #555;
      line-height: 1.6;
      margin: 1rem 0;
    }

    .service-badge {
      display: inline-block;
      padding: 0.25rem 0.75rem;
      background: var(--color-primary);
      color: white;
      border-radius: 1rem;
      font-size: 0.875rem;
      margin-right: 0.5rem;
    }

    .date {
      color: #999;
      font-size: 0.875rem;
    }

    /* Formulario */
    .add-review {
      background: white;
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .add-review h3 {
      color: var(--color-primary);
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: #333;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.75rem;
      border: 2px solid #e0e0e0;
      border-radius: 0.5rem;
      font-size: 1rem;
      transition: border-color 0.3s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: var(--color-primary);
    }

    .form-group input.error,
    .form-group textarea.error {
      border-color: #f44336;
    }

    .rating-selector {
      display: flex;
      gap: 0.5rem;
    }

    .star-btn {
      background: none;
      border: none;
      font-size: 2rem;
      color: #ddd;
      cursor: pointer;
      transition: all 0.3s;
    }

    .star-btn:hover,
    .star-btn.selected {
      color: #ffc107;
      transform: scale(1.2);
    }

    .error-message {
      color: #f44336;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: block;
    }

    .btn-submit {
      width: 100%;
      padding: 1rem;
      background: var(--color-primary);
      color: white;
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

    .btn-submit:hover:not(:disabled) {
      background: var(--color-primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 150, 136, 0.3);
    }

    .btn-submit:disabled {
      opacity: 0.6;
      cursor: not-allowed;
    }

    @media (max-width: 768px) {
      .reviews-grid {
        grid-template-columns: 1fr;
      }
    }
  `]
})
export class ReviewsComponent implements OnInit {
  reviews: Review[] = [];
  displayedReviews: Review[] = [];
  reviewForm: FormGroup;
  loadingReviews = false;
  isSubmitting = false;

  // Paginación
  currentPage = 1;
  itemsPerPage = 6;
  totalPages = 1;

  services = [
    { value: 'consulta', label: 'Consulta General' },
    { value: 'vacunacion', label: 'Vacunación' },
    { value: 'peluqueria', label: 'Peluquería' },
    { value: 'emergencia', label: 'Emergencia' }
  ];

  constructor(
    private fb: FormBuilder,
    private reviewsService: ReviewsService,
    private notificationService: NotificationService,
    private cdr: ChangeDetectorRef
  ) {
    this.reviewForm = this.fb.group({
      customer_name: ['', [Validators.required, Validators.minLength(2)]],
      pet_name: [''],
      service_type: [''],
      rating: [0, [Validators.required, Validators.min(1), Validators.max(5)]],
      comment: ['', [Validators.required, Validators.minLength(10)]]
    });
  }

  ngOnInit(): void {
    this.loadReviews();
  }

  loadReviews(): void {
    this.loadingReviews = true;
    this.reviewsService.getReviews().subscribe({
      next: (reviews) => {
        this.reviews = reviews;
        this.totalPages = Math.ceil(reviews.length / this.itemsPerPage);
        this.updateDisplayedReviews();
        this.loadingReviews = false;
        this.cdr.markForCheck(); // Forzar detección de cambios con OnPush
      },
      error: (error) => {
        console.error('Error cargando reseñas:', error);
        this.loadingReviews = false;
        this.cdr.markForCheck(); // Forzar detección de cambios incluso en error
      }
    });
  }

  updateDisplayedReviews(): void {
    const startIndex = (this.currentPage - 1) * this.itemsPerPage;
    const endIndex = startIndex + this.itemsPerPage;
    this.displayedReviews = this.reviews.slice(startIndex, endIndex);
  }

  nextPage(): void {
    if (this.currentPage < this.totalPages) {
      this.currentPage++;
      this.updateDisplayedReviews();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }

  previousPage(): void {
    if (this.currentPage > 1) {
      this.currentPage--;
      this.updateDisplayedReviews();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  }

  goToPage(page: number): void {
    this.currentPage = page;
    this.updateDisplayedReviews();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }

  get pages(): number[] {
    return Array.from({ length: this.totalPages }, (_, i) => i + 1);
  }

  setRating(rating: number): void {
    this.reviewForm.patchValue({ rating });
  }

  onSubmit(): void {
    if (this.reviewForm.valid) {
      this.isSubmitting = true;
      const reviewData: CreateReviewDto = this.reviewForm.value;

      this.reviewsService.createReview(reviewData).subscribe({
        next: (response) => {
          this.isSubmitting = false;
          this.notificationService.showSuccess('¡Gracias por tu reseña! Se ha enviado correctamente.');
          this.reviewForm.reset();
          this.reviewForm.patchValue({ rating: 0 });
          this.loadReviews(); // Recargar reseñas
        },
        error: (error) => {
          this.isSubmitting = false;
          console.error('Error al enviar reseña:', error);
          this.notificationService.showError('Error al enviar la reseña. Por favor, inténtalo de nuevo.');
        }
      });
    }
  }

  getServiceLabel(value: string): string {
    const service = this.services.find(s => s.value === value);
    return service ? service.label : value;
  }

  formatDate(date: Date): string {
    const d = new Date(date);
    const options: Intl.DateTimeFormatOptions = {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    };
    return d.toLocaleDateString('es-ES', options);
  }
}
