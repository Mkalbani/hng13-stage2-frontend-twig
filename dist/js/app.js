// Handle mobile menu toggle
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
}

// Authentication functions
function login(email, password) {
    if (email === 'demo@ticketapp.com' && password === 'Demo123!') {
        const session = {
            token: 'mock-token-' + Date.now(),
            user: { email, name: 'Demo User' },
            expiry: Date.now() + (60 * 60 * 1000) // 1 hour
        };
        localStorage.setItem('ticketapp_session', JSON.stringify(session));
        window.location.href = './dashboard/';
        return { success: true };
    }
    return { success: false, error: 'Invalid email or password' };
}

function signup(name, email, password) {
    const session = {
        token: 'mock-token-' + Date.now(),
        user: { email, name },
        expiry: Date.now() + (60 * 60 * 1000) // 1 hour
    };
    localStorage.setItem('ticketapp_session', JSON.stringify(session));
    window.location.href = './dashboard/';
    return { success: true };
}

function logout() {
    localStorage.removeItem('ticketapp_session');
    window.location.href = './auth/login/';
}

// Initialize Lucide icons
lucide.createIcons();

// Check authentication on protected routes
if (window.location.pathname.match(/\/(dashboard|tickets)/)) {
    const session = localStorage.getItem('ticketapp_session');
    if (!session) {
        window.location.href = '../auth/login/';
    } else {
        try {
            const parsed = JSON.parse(session);
            if (parsed.expiry && parsed.expiry <= Date.now()) {
                localStorage.removeItem('ticketapp_session');
                window.location.href = '../auth/login/';
            }
        } catch (e) {
            localStorage.removeItem('ticketapp_session');
            window.location.href = '../auth/login/';
        }
    }
}