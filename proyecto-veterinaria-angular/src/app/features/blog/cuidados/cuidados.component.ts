import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
    selector: 'app-cuidados',
    standalone: true,
    imports: [CommonModule],
    template: `
    <div class="page-container">
      <article class="blog-article">
        <div class="container">
          <h1>Cuidados Básicos para tu Cachorro</h1>
          <div class="blog-content">
            <p>Cuando traes un cachorro a casa, es importante establecer rutinas y cuidados básicos desde el principio. Esto ayudará a tu mascota a  crecer sana y feliz.</p>
            <p>La alimentación es fundamental. Los cachorros necesitan comida especialmente formulada para su edad, rica en proteínas y nutrientes esenciales.</p>
            <p>La socialización temprana es crucial. Expone a tu cachorro a diferentes personas, animales y entornos de forma gradual y positiva.</p>
            <p>Las visitas regulares al veterinario son imprescindibles para mantener al día las vacunas y prevenir enfermedades.</p>
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
export class CuidadosComponent { }
