/*js*/

// Header Scroll Effect (Glassmorphism solidifies)
window.addEventListener('scroll', () => {
    const header = document.getElementById('mainHeader');
    if (window.scrollY > 50) {
        header.style.background = 'rgba(5, 5, 5, 0.9)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.05)';
    }
});

// Modal Logic
const loginBtn = document.getElementById('loginBtn');
const authModal = document.getElementById('authModal');
const closeModal = document.getElementById('closeModal');
const loginForm = document.getElementById('loginForm');

const userMenu = document.getElementById('userMenu');
const logoutBtn = document.getElementById('logoutBtn');

loginBtn.addEventListener('click', () => {
    authModal.classList.add('active');
});

closeModal.addEventListener('click', () => {
    authModal.classList.remove('active');
});

authModal.addEventListener('click', (e) => {
    if (e.target === authModal) {
        authModal.classList.remove('active');
    }
});

// Auth View Transition Logic
const authViewsContainer = document.getElementById('authViews');
const switchToRegisterBtn = document.getElementById('switchToRegister');
const switchToLoginBtn = document.getElementById('switchToLogin');

if (switchToRegisterBtn && switchToLoginBtn && authViewsContainer) {
    switchToRegisterBtn.addEventListener('click', () => {
        authViewsContainer.classList.add('show-register');
    });

    switchToLoginBtn.addEventListener('click', () => {
        authViewsContainer.classList.remove('show-register');
    });
}

// Fake Form Validation & Login Flow
loginForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const emailInput = document.getElementById('emailInput').value;
    const passInput = document.getElementById('passInput').value;

    let isValid = true;

    if (!emailInput) {
        document.getElementById('emailGroup').classList.add('input-error');
        isValid = false;
    } else {
        document.getElementById('emailGroup').classList.remove('input-error');
    }

    // Simulate wrong password error if not 123
    if (passInput !== '123') {
        document.getElementById('passwordGroup').classList.add('input-error');
        isValid = false;
    } else {
        document.getElementById('passwordGroup').classList.remove('input-error');
    }

    if (isValid) {
        // Success Login Simulation
        authModal.classList.remove('active');
        loginBtn.style.display = 'none';
        userMenu.style.display = 'block'; // Show Member Dropdown
    }
});

// Logout Flow
logoutBtn.addEventListener('click', (e) => {
    e.preventDefault();
    userMenu.style.display = 'none';
    loginBtn.style.display = 'block';

    // Clear inputs
    document.getElementById('emailInput').value = '';
    document.getElementById('passInput').value = '';
});




