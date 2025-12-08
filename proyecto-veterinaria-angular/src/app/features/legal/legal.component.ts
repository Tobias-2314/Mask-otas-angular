import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-legal',
  standalone: true,
  imports: [CommonModule],
  template: `
    <div class="page-container">
      <div class="container">
        <h1>Información Legal</h1>
        
        <section id="privacidad">
          <h2>Política de Privacidad</h2>
          <p>En MASK!OTAS nos tomamos muy en serio la privacidad de nuestros clientes...</p>
          <p>Esta política describe cómo recopilamos, usamos y protegemos tu información personal.</p>
        </section>

        <section id="legal">
          <h2>Aviso Legal</h2>
          <p>De conformidad con lo dispuesto en la normativa vigente...</p>
          <ul>
            <li>Titular: MASK!OTAS S.L.</li>
            <li>CIF: B-12345678</li>
            <li>Domicilio: C/ delis Sants Just i Pastor, 70, 46940 Manises, València</li>
            <li>Email: info&#64;MASK!OTAS.com</li>
          </ul>
        </section>

        <section id="cookies">
          <h2>Política de Cookies</h2>
          <p>Utilizamos cookies para mejorar la experiencia de usuario en nuestro sitio web...</p>
          <p>Al navegar por este sitio web, aceptas el uso de cookies según lo descrito en esta política.</p>
        </section>
      </div>
    </div>
  `,
  styles: [`
    .page-container {
      min-height: calc(100vh - 200px);
      padding: 4rem 0;
      background-color: white;
    }

    h1 {
      font-size: 2.5rem;
      color: var(--color-primary);
      text-align: center;
      margin-bottom: 3rem;
    }

    section {
      margin-bottom: 3rem;
      padding: 2rem;
      background-color: var(--color-bg-light);
      border-radius: 0.5rem;
    }

    h2 {
      color: var(--color-primary);
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }

    p {
      color: var(--color-text-gray);
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    ul {
      color: var(--color-text-gray);
      line-height: 1.8;
    }
  `]
})
export class LegalComponent { }
