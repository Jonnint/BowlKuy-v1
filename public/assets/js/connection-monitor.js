/**
 * Connection Monitor - Auto detect internet connection
 * Monitors internet connection and updates UI accordingly
 */

class ConnectionMonitor {
    constructor() {
        this.isOnline = navigator.onLine;
        this.checkInterval = 30000; // Check every 30 seconds
        this.lastCheck = 0;
        this.statusElement = null;
        
        this.init();
    }

    init() {
        // Listen to browser online/offline events
        window.addEventListener('online', () => this.handleConnectionChange(true));
        window.addEventListener('offline', () => this.handleConnectionChange(false));
        
        // Start periodic checks
        this.startPeriodicCheck();
        
        // Initial check
        this.checkConnection();
        
        // Find status element
        this.findStatusElement();
    }

    findStatusElement() {
        // Look for connection status indicator in the page
        this.statusElement = document.querySelector('[data-connection-status]');
    }

    async checkConnection() {
        try {
            // First try our API endpoint
            const response = await fetch('/api/connection/status', {
                method: 'GET',
                cache: 'no-cache',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (response.ok) {
                const data = await response.json();
                this.handleConnectionChange(data.hasInternet);
                return;
            }
        } catch (error) {
            // API failed, fallback to favicon check
        }

        try {
            // Fallback: Try to fetch a small resource
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 5000);
            
            const response = await fetch('/favicon.ico', {
                method: 'HEAD',
                cache: 'no-cache',
                signal: controller.signal
            });
            
            clearTimeout(timeoutId);
            
            const isOnline = response.ok;
            this.handleConnectionChange(isOnline);
            
        } catch (error) {
            this.handleConnectionChange(false);
        }
    }

    handleConnectionChange(isOnline) {
        if (this.isOnline !== isOnline) {
            this.isOnline = isOnline;
            this.updateUI();
            this.showNotification();
        }
    }

    updateUI() {
        // Update status indicator if exists
        if (this.statusElement) {
            const indicator = this.statusElement.querySelector('.status-dot');
            const text = this.statusElement.querySelector('.status-text');
            
            if (indicator && text) {
                if (this.isOnline) {
                    indicator.className = 'w-2 h-2 bg-green-400 rounded-full animate-pulse status-dot';
                    text.textContent = 'Online Mode';
                    text.className = 'text-green-400 text-xs status-text';
                } else {
                    indicator.className = 'w-2 h-2 bg-yellow-400 rounded-full status-dot';
                    text.textContent = 'Offline Mode';
                    text.className = 'text-yellow-400 text-xs status-text';
                }
            }
        }

        // Update navbar status badge (for home page)
        const navbarStatus = document.querySelector('[data-connection-status]');
        if (navbarStatus) {
            const badge = navbarStatus.querySelector('.badge');
            const dot = navbarStatus.querySelector('.status-dot');
            const text = navbarStatus.querySelector('.status-text');
            
            if (badge && dot && text) {
                if (this.isOnline) {
                    badge.className = 'badge bg-success d-flex align-items-center gap-1';
                    dot.className = 'status-dot bg-light rounded-circle';
                    text.textContent = 'Online';
                } else {
                    badge.className = 'badge bg-warning text-dark d-flex align-items-center gap-1';
                    dot.className = 'status-dot bg-dark rounded-circle';
                    text.textContent = 'Offline';
                }
            }
        }

        // Update Google OAuth buttons visibility
        this.updateOAuthButtons();
    }

    updateOAuthButtons() {
        const oauthButtons = document.querySelectorAll('[data-oauth-button]');
        const offlineNotices = document.querySelectorAll('[data-offline-notice]');
        
        oauthButtons.forEach(button => {
            button.style.display = this.isOnline ? 'flex' : 'none';
        });
        
        offlineNotices.forEach(notice => {
            notice.style.display = this.isOnline ? 'none' : 'block';
        });
    }

    showNotification() {
        // Create toast notification
        const toast = document.createElement('div');
        toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
            this.isOnline 
                ? 'bg-green-500/90 text-white' 
                : 'bg-yellow-500/90 text-black'
        }`;
        
        toast.innerHTML = `
            <div class="flex items-center gap-2">
                <i class="fas fa-${this.isOnline ? 'wifi' : 'wifi-slash'}"></i>
                <span>${this.isOnline ? 'Kembali Online' : 'Mode Offline'}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }

    startPeriodicCheck() {
        setInterval(() => {
            this.checkConnection();
        }, this.checkInterval);
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ConnectionMonitor();
});

// Export for manual usage
window.ConnectionMonitor = ConnectionMonitor;