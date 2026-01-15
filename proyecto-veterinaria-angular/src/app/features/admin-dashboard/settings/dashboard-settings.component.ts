import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule, FormBuilder, FormGroup } from '@angular/forms';
import { ThemeService } from '../../../core/services/theme.service';

@Component({
    selector: 'app-dashboard-settings',
    standalone: true,
    imports: [CommonModule, FormsModule, ReactiveFormsModule],
    templateUrl: './dashboard-settings.component.html',
    styleUrls: ['./dashboard-settings.component.css']
})
export class DashboardSettingsComponent implements OnInit {
    settingsForm: FormGroup;
    logoPreview: string | null = null;
    successMessage = '';
    errorMessage = '';

    constructor(
        private fb: FormBuilder,
        private themeService: ThemeService
    ) {
        this.settingsForm = this.fb.group({
            site_name: [''],
            primary_color: ['#009688'] // Default teal
        });
    }

    ngOnInit(): void {
        this.themeService.siteName$.subscribe(name => {
            if (name) this.settingsForm.patchValue({ site_name: name }, { emitEvent: false });
        });
        this.themeService.primaryColor$.subscribe(color => {
            if (color) this.settingsForm.patchValue({ primary_color: color }, { emitEvent: false });
        });
        this.themeService.logo$.subscribe(logo => this.logoPreview = logo);
    }

    onColorChange(event: any) {
        const color = event.target.value;
        // Live preview
        document.documentElement.style.setProperty('--color-primary', color);
    }

    onLogoSelected(event: any) {
        const file = event.target.files[0];
        if (file) {
            this.themeService.uploadLogo(file).subscribe({
                next: (res) => {
                    // this.logoPreview = res.url; // Already handled by subscription to logo$
                    this.successMessage = 'Logo actualizado correctamente';
                    setTimeout(() => this.successMessage = '', 3000);
                },
                error: () => {
                    this.errorMessage = 'Error al subir el logo';
                    setTimeout(() => this.errorMessage = '', 3000);
                }
            });
        }
    }

    saveSettings() {
        const settings = [
            { key: 'site_name', value: this.settingsForm.get('site_name')?.value },
            { key: 'primary_color', value: this.settingsForm.get('primary_color')?.value }
        ];

        this.themeService.updateSettings(settings).subscribe({
            next: () => {
                this.successMessage = 'Configuración guardada';
                setTimeout(() => this.successMessage = '', 3000);
            },
            error: () => {
                this.errorMessage = 'Error al guardar configuración';
                setTimeout(() => this.errorMessage = '', 3000);
            }
        });
    }
}
