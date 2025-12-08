import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
    selector: 'app-cookie-popup',
    standalone: true,
    imports: [CommonModule],
    templateUrl: './cookie-popup.component.html',
    styleUrls: ['./cookie-popup.component.scss']
})
export class CookiePopupComponent implements OnInit {
    showPopup = false;

    ngOnInit(): void {
        const cookiesAccepted = localStorage.getItem('cookiesAccepted');
        if (!cookiesAccepted) {
            // Mostrar popup después de un pequeño delay
            setTimeout(() => {
                this.showPopup = true;
            }, 1000);
        }
    }

    acceptCookies(): void {
        localStorage.setItem('cookiesAccepted', 'true');
        this.showPopup = false;
    }

    rejectCookies(): void {
        localStorage.setItem('cookiesAccepted', 'false');
        this.showPopup = false;
    }
}
