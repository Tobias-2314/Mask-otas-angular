import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
    selector: 'app-services',
    standalone: true,
    imports: [CommonModule],
    template: `
    <div class="page-container">
      <section class="services-detail">
        <div class="container">
          <h1>Nuestros Servicios</h1>
          
          <div id="revision" class="service-section">
            <h2><i class="fas fa-heartbeat"></i> Consultas y Chequeos</h2>
            <p>Ofrecemos consultas veterinarias completas con profesionales experimentados. Realizamos chequeos regulares, diagnósticos y tratamientos personalizados para mantener a tu mascota en óptimo estado de salud.</p>
            <ul>
              <li>Consultas generales</li>
              <li>Chequeos preventivos</li>
              <li>Diagnóstico y tratamiento</li>
              <li>Seguimiento personalizado</li>
            </ul>
          </div>

          <div id="vacunacion" class="service-section">
            <h2><i class="fas fa-syringe"></i> Vacunación</h2>
            <p>Contamos con un completo programa de vacunación para proteger a tu mascota contra enfermedades comunes. Nuestro calendario de vacunación está adaptado a las necesidades específicas de cada animal.</p>
            <ul>
              <li>Vacunas obligatorias</li>
              <li>Vacunas optativas</li>
              <li>Cartilla de vacunación</li>
              <li>Recordatorios automáticos</li>
            </ul>
          </div>

          <div id="peluqueria" class="service-section">
            <h2><i class="fas fa-cut"></i> Peluquería Canina y Felina</h2>
            <p>Servicios profesionales de grooming para mantener a tu mascota limpia, saludable y hermosa. Utilizamos productos de alta calidad y técnicas especializadas.</p>
            <ul>
              <li>Baño y secado</li>
              <li>Corte de pelo</li>
              <li>Corte de uñas</li>
              <li>Limpieza de oídos</li>
            </ul>
          </div>
        </div>
      </section>
    </div>
  `,
    styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
    }

    .services-detail h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 3rem;
    }

    .service-section {
      background: white;
      padding: 2rem;
      margin-bottom: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .service-section h2 {
      color: var(--color-primary);
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }

    .service-section p {
      color: var(--color-text-gray);
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    .service-section ul {
      list-style: none;
      padding-left: 0;
    }

    .service-section li {
      padding: 0.5rem 0;
      padding-left: 1.5rem;
      position: relative;
    }

    .service-section li::before {
      content: "✓";
      position: absolute;
      left: 0;
      color: var(--color-primary);
      font-weight: bold;
    }
  `]
})
export class ServicesComponent { }
