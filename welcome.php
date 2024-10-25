<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voice-Driven E-Library</title>
    <link rel="stylesheet" href="HomeStyles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="digital-library.png" type="image/x-icon">
</head>
<body>
    <nav>
        <div class="container">
            <div class="logo">
                <img src="./digital-library.png" alt="lib">
                ISTE-Library
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#featured-books">Featured</a></li>
                <li><a href="#categories">Categories</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="<?php echo 'index.html'; ?>">Login</a></li>
            </ul>
            <button id="theme-toggle" aria-label="Toggle dark/light theme">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="theme-icon light"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="theme-icon dark"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
            </button>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    </nav>

    <header id="home">
        <div class="container">
            <div class="hero-content">
                <h1>Voice-Driven E-Library</h1>
                <p>An accessible library for everyone</p>
                <a href="#search-section" class="btn-primary">Start Exploring</a>
            </div>
            <div class="hero-image">
                <div class="hero-3d">
                    <div class="book-3d" tabindex="0" role="img" aria-label="3D Interactive Book - Voice-Driven E-Library">
                        <div class="face front">
                            <div class="corner corner-tl"></div>
                            <div class="corner corner-tr"></div>
                            <div class="corner corner-bl"></div>
                            <div class="corner corner-br"></div>
                            <div class="book-content">
                                <div class="book-title">Voice-Driven E-Library</div>
                                <div class="book-author">An accessible library for everyone</div>
                            </div>
                        </div>
                        <div class="pages-container">
                            <div class="page page1"></div>
                            <div class="page page2"></div>
                            <div class="page page3"></div>
                            <div class="page page4"></div>
                            <div class="page page5"></div>
                        </div>
                        <div class="face back">
                            <div class="corner corner-tl"></div>
                            <div class="corner corner-tr"></div>
                            <div class="corner corner-bl"></div>
                            <div class="corner corner-br"></div>
                            <p>Discover the future of accessible reading</p>
                        </div>
                        <div class="face spine">
                            <span>Voice-Driven E-Library</span>
                        </div>
                        <div class="face top"></div>
                        <div class="face bottom"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <section id="search-section">
                <h2>Search for Books</h2>
                <div class="search-container">
                    <input type="text" id="search-input" placeholder="Search for books..." aria-label="Search for books">
                    <button id="search-button" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <span class="sr-only">Search</span>
                    </button>
                    <button id="voice-search-button" aria-label="Voice Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 0-3 3v7a3 3 0 0 0 6 0V5a3 3 0 0 0-3-3Z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" x2="12" y1="19" y2="22"></line></svg>
                        <span class="sr-only">Voice Search</span>
                    </button>
                </div>
            </section>
            <section id="results-section">
                <h2>Search Results</h2>
                <div id="results-container">
                    <!-- Search results will be dynamically inserted here -->
                </div>
            </section>

            
            <section id="voice-commands">
                <h2>Voice Commands</h2>
                <ul>
                    <li>"Search for [book title]"</li>
                    <li>"Open book [number]"</li>
                    <li>"Go back to results"</li>
                    <li>"Read book summary"</li>
                </ul>
            </section>

            <section id="featured-books">
                <h2>Featured Books</h2>
                <div class="book-carousel">
                    <div class="book-card">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Book Cover" class="book-cover">
                        <h3>The Great Gatsby</h3>
                        <p>F. Scott Fitzgerald</p>
                        <button class="btn-secondary">Read More</button>
                    </div>
                    <div class="book-card">
                        <img src="https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80" alt="Book Cover" class="book-cover">
                        <h3>To Kill a Mockingbird</h3>
                        <p>Harper Lee</p>
                        <button class="btn-secondary">Read More</button>
                    </div>
                    <div class="book-card">
                        <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Book Cover" class="book-cover">
                        <h3>1984</h3>
                        <p>George Orwell</p>
                        <button class="btn-secondary">Read More</button>
                    </div>
                </div>
            </section>

            <section id="categories">
                <h2>Book Categories</h2>
                <div class="category-grid">
                    <a href="#" class="category-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 16 4-4-4-4"></path><path d="m6 8-4 4 4 4"></path><path d="m14.5 4-5 16"></path></svg>
                        <span>Science Fiction</span>
                    </a>
                    <a href="#" class="category-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        <span>Mystery</span>
                    </a>
                    <a href="#" class="category-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
                        <span>Romance</span>
                    </a>
                    <a href="#" class="category-card">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        <span>Non-Fiction</span>
                    </a>
                </div>
            </section>

         

            <section id="about">
                <h2>About Our E-Library</h2>
                <div class="about-content">
                    <div class="about-text">
                        <p>Our voice-driven e-library is designed to make reading accessible to everyone, regardless of physical abilities. With advanced voice recognition technology, users can easily navigate our vast collection of books, search for titles, and enjoy reading without barriers.</p>
                        <p>We believe that knowledge should be accessible to all, and our mission is to break down the barriers that prevent people from enjoying literature and learning.</p>
                    </div>
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Person using voice commands with a computer" width="400" height="300">
                    </div>
                </div>
            </section>

            <section id="contact">
                <h2>Contact Us</h2>
                <form id="contact-form">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </section>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 Voice-Driven E-Library. All rights reserved.</p>
        </div>
    </footer>

    <div class="words">
        <p id="p">Speech will appear here</p>
    </div>
    <p id="error"></p>
    
    <script> 
        const speechSynth = window.speechSynthesis;
        // Speech Recognition
        let speech = true; 
        window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition; 
  
        const recognition = new SpeechRecognition(); 
        recognition.interimResults = true; 
        const words = document.querySelector('.words'); 
  
        recognition.addEventListener('result', e => { 
            var transcript = Array.from(e.results) 
                .map(result => result[0]) 
                .map(result => result.transcript) 
                .join(''); 
          
            document.getElementById("p").innerHTML = transcript; 
            if(transcript.includes("speech")){
                const menu = "Say Search, and book name, to search for a book. say open book, book number to open a book. say play audio ,then audioname to play the audio. say speech to repeat the menu options"
                
                if (!speechSynth.speaking && enteredText.trim().length) {
                document.getElementById("error").textContent = "";
                const newUtter = new SpeechSynthesisUtterance(menu);
                speechSynth.speak(newUtter);
            }
        }else if(transcript.includes("search")){
            const wordsArray = transcript.split(" ");
            console.log(wordsArray);
            var bookname = "";
            for(var i = 1; i< wordsArray.length; i++){
                bookname += wordsArray[i] + " ";
            }
            console.log(bookname);
            
                
            }

                
                
            }

            // console.log(transcript); 
        ); 
          
        // Start recognition on button click
            if (speech) { 
                recognition.start(); 
                recognition.addEventListener('end', recognition.start); 
            }


        // Text to Speech
        const enteredText = "Welcome to the e-library. say speech, to get  navigation menu";

        document.querySelector("body").addEventListener("dblclick", () => {
            if (!speechSynth.speaking && enteredText.trim().length) {
                document.getElementById("error").textContent = "";
                const newUtter = new SpeechSynthesisUtterance(enteredText);
                speechSynth.speak(newUtter);
            }
        });

    </script>
    <!-- already done -->
    <script>
    
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
prefersDarkScheme.addListener((e) => {
    const newTheme = e.matches ? 'dark' : 'light';
    setTheme(newTheme);
});

// Rest of your JavaScript code for voice recognition and search functionality
// ...
    </script>
</body> 
</body>
</html>
