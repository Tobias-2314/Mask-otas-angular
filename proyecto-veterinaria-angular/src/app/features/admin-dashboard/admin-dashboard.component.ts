import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReviewsService, Review } from '../../core/services/reviews.service';
import { NotificationService } from '../../core/services/notification.service';

@Component({
  selector: 'app-admin-dashboard',
  standalone: true,
  imports: [CommonModule],
  template: `
    <div class="page-container">
      <div class="container">
        <h1>Dashboard Administrativo</h1>
        
        <!-- Navegación de Pestañas -->
        <div class="admin-tabs">
            <button 
                class="tab-btn" 
                [class.active]="activeTab === 'dashboard'"
                (click)="activeTab = 'dashboard'">
                <i class="fas fa-chart-line"></i> Resumen
            </button>
            <button 
                class="tab-btn" 
                [class.active]="activeTab === 'reviews'"
                (click)="loadReviews()">
                <i class="fas fa-comments"></i> Gestión de Reseñas
            </button>
        </div>

        <!-- Pestaña: Dashboard -->
        @if (activeTab === 'dashboard') {
            <div class="stats-grid">
              <div class="stat-card">
                <h3>Total Reseñas</h3>
                <p class="stat-number">{{ stats.totalReviews }}</p>
              </div>
              <div class="stat-card">
                <h3>Rating Promedio</h3>
                <p class="stat-number">{{ stats.averageRating }}</p>
              </div>
              <div class="stat-card">
                <h3>Reseñas Pendientes</h3>
                <p class="stat-number">{{ stats.pendingReviews }}</p>
              </div>
            </div>
        }

        <!-- Pestaña: Gestión de Reseñas -->
        @if (activeTab === 'reviews') {
            <div class="reviews-management">
                <div class="table-header">
                    <h2>Administrar Reseñas</h2>
                    <button class="btn-refresh" (click)="loadReviews()">
                        <i class="fas fa-sync-alt"></i> Actualizar
                    </button>
                </div>

                @if (loading) {
                    <div class="loading">
                        <i class="fas fa-spinner fa-spin"></i> Cargando datos...
                    </div>
                } @else {
                    <div class="table-responsive">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Servicio</th>
                                    <th>Rating</th>
                                    <th>Comentario</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for (review of reviews; track review.id) {
                                    <tr>
                                        <td>{{ review.created_at | date:'shortDate' }}</td>
                                        <td>
                                            <div class="customer-cell">
                                                <span class="name">{{ review.customer_name }}</span>
                                                @if (review.pet_name) {
                                                    <span class="pet">{{ review.pet_name }}</span>
                                                }
                                            </div>
                                        </td>
                                        <td>{{ review.service_type || '-' }}</td>
                                        <td>
                                            <div class="rating-cell">
                                                @for (star of [1,2,3,4,5]; track star) {
                                                    <i class="fas fa-star" [class.filled]="star <= review.rating"></i>
                                                }
                                            </div>
                                        </td>
                                        <td class="comment-cell" [title]="review.comment">
                                            {{ review.comment }}
                                        </td>
                                        <td>
                                            @if (review.is_visible) {
                                                <span class="badge approved">Visible</span>
                                            } @else {
                                                <span class="badge hidden">Oculto</span>
                                            }
                                        </td>
                                        <td>
                                            <div class="actions">
                                                @if (!review.is_visible) {
                                                    <button class="btn-icon approve" title="Aprobar" (click)="approveReview(review.id)">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                } @else {
                                                    <button class="btn-icon hide" title="Ocultar" (click)="hideReview(review.id)">
                                                        <i class="fas fa-eye-slash"></i>
                                                    </button>
                                                }
                                                <button class="btn-icon delete" title="Eliminar" (click)="deleteReview(review.id)">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                }
                            </tbody>
                        </table>
                    </div>
                }
            </div>
        }
      </div>
    </div>
  `,
  styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
      background-color: var(--color-bg-gray);
    }

    h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 2rem;
    }

    /* Tabs */
    .admin-tabs {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .tab-btn {
        padding: 0.75rem 1.5rem;
        background: white;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
        color: #666;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .tab-btn.active {
        background: var(--color-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    /* Stats */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .stat-card {
      background: white;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      text-align: center;
    }

    .stat-card h3 {
      color: var(--color-primary);
      margin-bottom: 1rem;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: bold;
      color: var(--color-primary);
      margin: 0;
    }

    /* Table */
    .reviews-management {
        background: white;
        border-radius: 0.5rem;
        padding: 1.5rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th, .admin-table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .admin-table th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: 600;
    }

    .customer-cell {
        display: flex;
        flex-direction: column;
    }

    .customer-cell .pet {
        font-size: 0.85rem;
        color: #666;
    }

    .rating-cell {
        display: flex;
        gap: 2px;
        color: #ddd;
    }

    .rating-cell .filled {
        color: #ffc107;
    }

    .comment-cell {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        color: #555;
    }

    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .badge.approved {
        background-color: #dcfce7;
        color: #166534;
    }

    .badge.hidden {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-icon.approve {
        background-color: #dcfce7;
        color: #166534;
    }

    .btn-icon.hide {
        background-color: #fff7ed;
        color: #9a3412;
    }

    .btn-icon.delete {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .btn-icon:hover {
        transform: scale(1.1);
    }
  `]
})
export class AdminDashboardComponent implements OnInit {
  activeTab = 'dashboard';
  reviews: Review[] = [];
  loading = false;
  stats = {
    totalReviews: 0,
    averageRating: 0,
    pendingReviews: 0
  };

  constructor(
    private reviewsService: ReviewsService,
    private notificationService: NotificationService
  ) { }

  ngOnInit(): void {
    this.loadStats();
  }

  loadStats(): void {
    this.reviewsService.getReviewStats().subscribe(stats => {
      this.stats.totalReviews = stats.total;
      this.stats.averageRating = stats.average;
      // TODO: Agregar endpoint para conteo de pendientes en backend
    });
  }

  loadReviews(): void {
    this.activeTab = 'reviews';
    this.loading = true;
    this.reviewsService.getAllReviewsForAdmin().subscribe({
      next: (data) => {
        this.reviews = data;
        this.loading = false;
      },
      error: (err) => {
        console.error('Error al cargar reseñas', err);
        this.loading = false;
      }
    });
  }

  approveReview(id: string): void {
    this.reviewsService.approveReview(id).subscribe({
      next: () => {
        this.notificationService.showSuccess('Reseña aprobada');
        this.loadReviews();
        this.loadStats();
      },
      error: () => this.notificationService.showError('Error al aprobar reseña')
    });
  }

  hideReview(id: string): void {
    this.reviewsService.hideReview(id).subscribe({
      next: () => {
        this.notificationService.showSuccess('Reseña ocultada');
        this.loadReviews();
        this.loadStats();
      },
      error: () => this.notificationService.showError('Error al ocultar reseña')
    });
  }

  deleteReview(id: string): void {
    if (confirm('¿Estás seguro de que quieres eliminar esta reseña?')) {
      this.reviewsService.deleteReview(id).subscribe({
        next: () => {
          this.notificationService.showSuccess('Reseña eliminada');
          this.loadReviews();
          this.loadStats();
        },
        error: () => this.notificationService.showError('Error al eliminar reseña')
      });
    }
  }
}
