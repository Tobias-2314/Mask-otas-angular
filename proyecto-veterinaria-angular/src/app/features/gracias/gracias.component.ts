import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterLink } from '@angular/router';

@Component({
    selector: 'app-gracias',
    standalone: true,
    imports: [CommonModule, RouterLink],
    template: `
    <div class="page-container">
      <div class="container">
        <div class="gracias-card">
          <i class="fas fa-check-circle"></i>
          <h1>¡Gracias!</h1>
          <p>Hemos recibido tu mensaje correctamente.</p>
          <p>Nos pondremos en contacto contigo lo antes posible.</p>
          <button class="back-btn" routerLink="/">
            Volver al Inicio
          </button>
        </div>
      </div>
    </div>
  `,
    styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
      background-color: var(--color-bg-gray);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .gracias-card {
      background: white;
      padding: 4rem 3rem;
      border-radius: 1rem;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 500px;
      margin: 0 auto;
    }

    .gracias-card i {
      font-size: 4rem;
      color: var(--color-primary);
      margin-bottom: 1.5rem;
    }

    .gracias-card h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      margin-bottom: 1rem;
    }

    .gracias-card p {
      color: var(--color-text-gray);
      font-size: 1.1rem;
      margin-bottom: 0.5rem;
    }

    .back-btn {
      margin-top: 2rem;
      padding: 0.75rem 2rem;
      background-color: var(--color-primary);
      color: white;
      border: none;
      border-radius: 0.5rem;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .back-btn:hover {
      background-color: var(--color-primary-dark);
    }
  `]
})
export class GraciasComponent { }
