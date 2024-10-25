document.addEventListener('DOMContentLoaded', function() {
    // Initialize necessary elements
    const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
    const voiceButton = document.getElementById('startVoice');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const modeDisplay = document.getElementById('currentMode');
    const form = document.getElementById('loginForm');
    const formTitle = document.getElementById('formTitle');
    const statusMessage = document.getElementById('statusMessage');
    
    let isListening = false;
    let currentMode = 'login';

    // Configure speech recognition
    recognition.continuous = true;
    recognition.interimResults = false;
    recognition.lang = 'en-US';

    // Voice button click handler
    voiceButton.addEventListener('click', toggleListening);

    function toggleListening() {
        if (isListening) {
            stopListening();
        } else {
            startListening();
        }
    }

    function startListening() {
        recognition.start();
        voiceButton.textContent = 'Listening... (Click to Stop)';
        voiceButton.classList.add('listening');
        isListening = true;
        speak('Voice control activated. Please speak a command.');
    }

    function stopListening() {
        recognition.stop();
        voiceButton.textContent = 'Start Voice Control';
        voiceButton.classList.remove('listening');
        isListening = false;
    }

    // Handle speech recognition results
    recognition.onresult = function(event) {
        const command = event.results[event.results.length - 1][0].transcript.toLowerCase().trim();
        
        // Mode switching commands
        if (command.includes('login')) {
            switchMode('login');
        } else if (command.includes('register')) {
            switchMode('register');
        } 
        // Input commands
        else if (command.includes('username')) {
            const username = command.replace('username', '').trim();
            usernameInput.value = username;
            speak('Username set to ' + username);
            updateStatus('Username set: ' + username);
        } else if (command.includes('password')) {
            const password = command.replace('password', '').trim();
            passwordInput.value = password;
            speak('Password set');
            updateStatus('Password set');
        } else if (command.includes('submit')) {
            form.dispatchEvent(new Event('submit'));
        } else {
            speak('Command not recognized. Please try again.');
            updateStatus('Command not recognized');
        }
    };

    function switchMode(mode) {
        currentMode = mode;
        modeDisplay.textContent = mode.charAt(0).toUpperCase() + mode.slice(1);
        formTitle.textContent = `Voice ${mode.charAt(0).toUpperCase() + mode.slice(1)}`;
        speak(`Switched to ${mode} mode`);
        updateStatus(`Mode switched to: ${mode}`);
    }

    // Handle speech recognition errors
    recognition.onerror = function(event) {
        console.error('Speech recognition error:', event.error);
        speak('Sorry, there was an error with voice recognition');
        updateStatus('Voice recognition error occurred');
        stopListening();
    };

    // Form submission handler
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!usernameInput.value || !passwordInput.value) {
            speak('Please provide both username and password');
            updateStatus('Please provide both username and password');
            return;
        }

        // Create form data
        const formData = new FormData();
        formData.append('username', usernameInput.value);
        formData.append('password', passwordInput.value);
        formData.append('isRegister', currentMode === 'register');

        // Send request to server
        fetch('login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            speak(data.message);
            updateStatus(data.message);
            
            if (data.success) {
                setTimeout(() => {
                    window.location.href = 'welcome.php';
                }, 1500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            speak('An error occurred. Please try again.');
            updateStatus('Server error occurred');
        });
    });

    // Helper functions
    function speak(text) {
        const utterance = new SpeechSynthesisUtterance(text);
        window.speechSynthesis.speak(utterance);
    }

    function updateStatus(message) {
        statusMessage.textContent = message;
    }
});
























const navLinks = document.querySelector('.nav-links');
const menuToggle = document.createElement('button');
menuToggle.classList.add('menu-toggle');
menuToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>';
menuToggle.setAttribute('aria-label', 'Toggle menu');

document.querySelector('nav .container').insertBefore(menuToggle, navLinks);

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('show');
});

// Close menu when clicking outside
document.addEventListener('click', (event) => {
    if (!event.target.closest('nav') && navLinks.classList.contains('show')) {
        navLinks.classList.remove('show');
    }
});

// Theme toggle functionality
const themeToggle = document.getElementById('theme-toggle');
const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

function setTheme(theme) {
    document.body.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
}

themeToggle.addEventListener('click', () => {
    const currentTheme = document.body.getAttribute('data-theme');
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    setTheme(newTheme);
});

// Set initial theme
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    setTheme(savedTheme);
} else {
    setTheme(prefersDarkScheme.matches ? 'dark' : 'light');
}

// Listen for changes in system theme
prefersDarkScheme.addEventListener((e) => {
    const newTheme = e.matches ? 'dark' : 'light';
    setTheme(newTheme);
});

// Rest of your JavaScript code for voice recognition and search functionality
// ...

