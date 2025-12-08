import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
    selector: 'app-admin-dashboard',
    standalone: true,
    imports: [CommonModule],
    template: `
    <div class="page-container">
      <div class="container">
        <h1>Dashboard Administrativo</h1>
        <div class="dashboard-info">
          <p>Panel de administración para gestión de datos y estadísticas.</p>
          <p><i class="fas fa-info-circle"></i> Conecta con la API del backend para obtener datos en tiempo real.</p>
        </div>
        
        <div class="stats-grid">
          <div class="stat-card">
            <h3>Total Usuarios</h3>
            <p class="stat-number">0</p>
          </div>
          <div class="stat-card">
            <h3>Citas Pendientes</h3>
            <p class="stat-number">0</p>
          </div>
          <div class="stat-card">
            <h3>Servicios Activos</h3>
            <p class="stat-number">3</p>
          </div>
        </div>
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

    .dashboard-info {
      background: white;
      padding: 1.5rem;
      border-radius: 0.5rem;
      margin-bottom: 2rem;
      text-align: center;
    }

    .dashboard-info p {
      color: var(--color-text-gray);
      margin-bottom: 0.5rem;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
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
  `]
})
export class AdminDashboardComponent implements OnInit {
    ngOnInit(): void {
        // Aquí se pueden cargar datos del dashboard desde la API
        console.log('Admin Dashboard loaded');
    }
}
