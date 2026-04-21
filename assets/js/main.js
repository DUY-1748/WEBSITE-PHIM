/*js*/
import { createMovieCard } from './components/movie_card.js';
import { MovieCardTop10 } from './components/rankingMovie.js';
import { renderMovieDetail } from './components/movieDetail.js';


const loadWatchPage = (listMovie) => {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page');
    const movieId = urlParams.get('id');
    console.log("ID từ URL:", movieId);
    console.log("Danh sách phim đang có:", listMovie);

   
    if (page === 'watch' && movieId) {
        const container = document.querySelector('.detail');
        if (!container) return;

     
        const movie = listMovie.find(m => String(m.id) === String(movieId));
        console.log("Kết quả tìm kiếm:", movie);

        if (movie) {
            
            const movieData = {
                ...movie,
                poster: movie.poster_path.startsWith('http') ? movie.poster_path : `https://image.tmdb.org/t/p/w500${movie.poster_path}`,
                backdrop: movie.backdrop_path && movie.backdrop_path.startsWith('http') ? movie.backdrop_path : `https://image.tmdb.org/t/p/original${movie.backdrop_path}`,
                date: movie.release_date,
                rating: movie.rating
            };

            const related = listMovie.filter(m => String(m.tmdb_id) !== String(movieId));
            
            container.innerHTML = ''; 
            
            container.appendChild(renderMovieDetail(movieData, related));
            
            // Cuộn lên đầu trang
            window.scrollTo(0, 0);
        } else {
            container.innerHTML = `<h2 style="color:white; padding:100px; text-align:center;">Phim đang được cập nhật...</h2>`;
        }
    }
};




const apiMovie = '/WEBSITE-PHIM/api/get_movies.php';

fetch(apiMovie)
    .then(res => res.json())
    .then(data => {
        const listMovie = data;
        loadWatchPage(listMovie);
        
        const movieArray = listMovie.map(item => ({
            title: item.title,
            date: item.release_date,
            poster: `https://image.tmdb.org/t/p/w500${item.poster_path}`,
            rating: item.rating,
            overview: item.overview,
            background: `https://image.tmdb.org/t/p/w500${item.background_path}`,
            tmdb_id: item.id
        }));

        
        const movieGrid3 = document.querySelector('.movie-grid-3');
        if (movieGrid3) {
            for (let i = 0; i < Math.min(9, movieArray.length); i++) {
                movieGrid3.appendChild(createMovieCard(movieArray[i]));
            }
        }

        
        const movieGrid1 = document.querySelector('.movie-grid');
        const movieGrid2 = document.querySelector('.movie-grid-2');
        const allMoviePage = document.querySelector('.allmovie');

        movieArray.forEach(movieData => {
            
            if (movieGrid1) movieGrid1.appendChild(createMovieCard(movieData));
            if (allMoviePage) allMoviePage.appendChild(createMovieCard(movieData));

           
            const releaseYear = movieData.date ? movieData.date.split('-')[0] : '2024';
            if (parseInt(releaseYear) < 2026 && movieGrid2) {
                movieGrid2.appendChild(createMovieCard(movieData));
            }
        });

        // Top Phim Hôm Nay 
        const movieGrid4 = document.querySelector('.movie-grid-4'); 
        if (movieGrid4) {
           
            const top10Data = [...listMovie]
                .sort((a, b) => b.rating - a.rating)
                .slice(0, 24);

            top10Data.forEach((item, index) => {
                const top10CardData = {
                    title: item.title,
                    poster: `https://image.tmdb.org/t/p/w500${item.poster_path}`,
                    rating: item.rating,
                    overview: item.overview
                };
                const movieElement = MovieCardTop10(top10CardData, index);
                movieGrid4.appendChild(movieElement);
            });
        }
       
       
                
        
    })
    .catch(err => console.error("Lỗi Fetch API:", err));























































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




