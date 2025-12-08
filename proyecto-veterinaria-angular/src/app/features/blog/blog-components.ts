import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

const BLOG_TEMPLATE = (title: string, description: string, content: string[]) => `
  <div class="page-container">
    <article class="blog-article">
      <div class="container">
        <h1>${title}</h1>
        <div class="blog-content">
          ${content.map(p => `<p>${p}</p>`).join('')}
        </div>
      </div>
    </article>
  </div>
`;

const BLOG_STYLES = `
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
`;

@Component({
    selector: 'app-cuidados',
    standalone: true,
    imports: [CommonModule],
    template: BLOG_TEMPLATE(
        'Cuidados Básicos para tu Cachorro',
        'Aprende los aspectos fundamentales para el cuidado de tu nuevo amigo',
        [
            'Cuando traes un cachorro a casa, es important establecer rutinas y cuidados básicos desde el principio. Esto ayudará a tu mascota a crecer sana y feliz.',
            'La alimentación es fundamental. Los cachorros necesitan comida especialmente formulada para su edad, rica en proteínas y nutrientes esenciales.',
            'La socialización temprana es crucial. Expone a tu cachorro a diferentes personas, animales y entornos de forma gradual y positiva.',
            'Las visitas regulares al veterinario son imprescindibles para mantener al día las vacunas y prevenir enfermedades.'
        ]
    ),
    styles: [BLOG_STYLES]
})
export class CuidadosComponent { }

@Component({
    selector: 'app-nutricion',
    standalone: true,
    imports: [CommonModule],
    template: BLOG_TEMPLATE(
        'Guía de Nutrición para Mascotas',
        'Descubre la mejor alimentación para cada etapa de vida',
        [
            'Una nutrición adecuada es la base de la salud de tu mascota. Cada etapa de vida requiere diferentes necesidades nutricionales.',
            'Los cachorros necesitan alimentos ricos en proteínas y calcio para su desarrollo. Los adultos requieren una dieta balanceada para mantener su peso ideal.',
            'Las mascotas mayores pueden beneficiarse de alimentos con menos calorías pero más fibra y nutrientes específicos para sus articulaciones.',
            'Consulta siempre con tu veterinario para determinar la mejor dieta según la raza, tamaño y condición de salud de tu mascota.'
        ]
    ),
    styles: [BLOG_STYLES]
})
export class NutricionComponent { }

@Component({
    selector: 'app-ejercicios',
    standalone: true,
    imports: [CommonModule],
    template: BLOG_TEMPLATE(
        'Ejercicios Recomendados',
        'Mantén a tu mascota activa y saludable',
        [
            'El ejercicio regular es esencial para la salud física y mental de tu mascota. Ayuda a prevenir la obesidad y el aburrimiento.',
            'Los perros necesitan paseos diarios, idealmente 2-3 veces al día. La duración depende de la raza y edad de tu perro.',
            'Los gatos también necesitan ejercicio. Juguetes interactivos y sesiones de juego ayudan a mantenerlos activos.',
            'Recuerda adaptar el nivel de ejercicio a la edad y condición física de tu mascota. Consulta con tu veterinario antes de iniciar nuevas rutinas.'
        ]
    ),
    styles: [BLOG_STYLES]
})
export class EjerciciosComponent { }
