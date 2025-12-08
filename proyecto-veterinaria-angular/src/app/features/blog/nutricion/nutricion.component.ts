import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
    selector: 'app-nutricion',
    standalone: true,
    imports: [CommonModule],
    template: `
    <div class="page-container">
      <article class="blog-article">
        <div class="container">
          <h1>Guía de Nutrición para Mascotas</h1>
          <div class="blog-content">
            <p>Una nutrición adecuada es la base de la salud de tu mascota. Cada etapa de vida requiere diferentes necesidades nutricionales.</p>
            <p>Los cachorros necesitan alimentos ricos en proteínas y calcio para su desarrollo. Los adultos requieren una dieta balanceada para mantener su peso ideal.</p>
            <p>Las mascotas mayores pueden beneficiarse de alimentos con menos calorías pero más fibra y nutrientes específicos para sus articulaciones.</p>
            <p>Consulta siempre con tu veterinario para determinar la mejor dieta según la raza, tamaño y condición de salud de tu mascota.</p>
          </div>
        </div>
      </article>
    </div>
  `,
    styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
      background-color: white;
    }

    .blog-article h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 2rem;
    }

    .blog-content {
      max-width: 800px;
      margin: 0 auto;
    }

    .blog-content p {
      color: var(--color-text-gray);
      line-height: 1.8;
      margin-bottom: 1.5rem;
      font-size: 1.1rem;
    }
  `]
})
export class NutricionComponent { }
