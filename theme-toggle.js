/**
 * THEME TOGGLE FUNCTIONALITY
 * Handles light/dark theme switching with localStorage persistence
 */

class ThemeManager {
    constructor() {
        this.themeToggle = document.getElementById('themeToggle');
        this.body = document.body;
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.loadTheme();
    }

    setupEventListeners() {
        // Theme toggle button
        if (this.themeToggle) {
            this.themeToggle.addEventListener('click', () => this.toggleTheme());
        }

        // Watch for system theme changes
        if (window.matchMedia) {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');
            prefersDark.addEventListener('change', (e) => {
                if (!localStorage.getItem('premiumprint-theme')) {
                    e.matches ? this.enableDarkTheme() : this.enableLightTheme();
                }
            });
        }
    }

    loadTheme() {
        const savedTheme = localStorage.getItem('premiumprint-theme');
        const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            this.enableDarkTheme();
        } else {
            this.enableLightTheme();
        }
    }

    toggleTheme() {
        if (this.body.classList.contains('dark-theme')) {
            this.enableLightTheme();
        } else {
            this.enableDarkTheme();
        }
    }

    enableDarkTheme() {
        this.body.classList.add('dark-theme');
        this.updateButtonIcon('dark');
        localStorage.setItem('premiumprint-theme', 'dark');
        this.updateMetaThemeColor('#1a1a2e');
        this.dispatchThemeChangeEvent('dark');
    }

    enableLightTheme() {
        this.body.classList.remove('dark-theme');
        this.updateButtonIcon('light');
        localStorage.setItem('premiumprint-theme', 'light');
        this.updateMetaThemeColor('#ffffff');
        this.dispatchThemeChangeEvent('light');
    }

    updateButtonIcon(theme) {
        if (!this.themeToggle) return;

        const icon = this.themeToggle.querySelector('i');
        if (!icon) return;

        // Remove all possible icon classes
        ['bi-moon', 'bi-sun', 'bi-moon-fill', 'bi-sun-fill'].forEach(cls => {
            icon.classList.remove(cls);
        });

        // Add appropriate icon
        if (theme === 'dark') {
            icon.classList.add('bi-sun');
        } else {
            icon.classList.add('bi-moon');
        }

        // Update button title
        this.themeToggle.setAttribute('title', theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode');
    }

    updateMetaThemeColor(color) {
        // Update meta theme-color for mobile browsers
        let metaThemeColor = document.querySelector('meta[name="theme-color"]');
        if (!metaThemeColor) {
            metaThemeColor = document.createElement('meta');
            metaThemeColor.name = 'theme-color';
            document.head.appendChild(metaThemeColor);
        }
        metaThemeColor.content = color;
    }

    dispatchThemeChangeEvent(theme) {
        const event = new CustomEvent('themeChange', { detail: { theme } });
        document.dispatchEvent(event);
    }
}

// Initialize theme manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.themeManager = new ThemeManager();
    
    // Add theme class to HTML element for better specificity
    document.documentElement.classList.add('theme-loaded');
});