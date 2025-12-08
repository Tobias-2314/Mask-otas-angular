import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
    selector: 'app-ejercicios',
    standalone: true,
    imports: [CommonModule],
    template: `
    <div class="page-container">
      <article class="blog-article">
        <div class="container">
          <h1>Ejercicios Recomendados</h1>
          <div class="blog-content">
            <p>El ejercicio regular es esencial para la salud física y mental de tu mascota. Ayuda a prevenir la obesidad y el aburrimiento.</p>
            <p>Los perros necesitan paseos diarios, idealmente 2-3 veces al día. La duración depende de la raza y edad de tu perro.</p>
            <p>Los gatos también necesitan ejercicio. Juguetes interactivos y sesiones de juego ayudan a mantenerlos activos.</p>
            <p>Recuerda adaptar el nivel de ejercicio a la edad y condición física de tu mascota. Consulta con tu veterinario antes de iniciar nuevas rutinas.</p>
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
export class EjerciciosComponent { }
