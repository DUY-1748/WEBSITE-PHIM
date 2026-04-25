import { createMovieCard } from './components/movie_card.js';
import { MovieCardTop10 } from './components/rankingMovie.js';
import { renderMovieDetail } from './components/movieDetail.js';
import { renderWatchingPage } from './components/watchingMovie.js';
import { renderSearchSuggestions } from './components/suggestionMovie.js';

/**
 * HÀM XỬ LÝ ĐỊNH TUYẾN TRANG (WATCH & WATCHING)
 */
const loadWatchPage = (listMovie) => {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page');
    const movieId = urlParams.get('id');

    if (!movieId) return; 

    // --- TRƯỜNG HỢP 1: TRANG CHI TIẾT (page=watch) ---
    if (page === 'watch') {
        const container = document.querySelector('.detail');
        if (!container) return;

        const movie = listMovie.find(m => String(m.tmdb_id) === String(movieId) || String(m.id) === String(movieId));
        
        if (movie) {
            const movieData = {
                ...movie,
                poster: movie.poster_path?.startsWith('http') ? movie.poster_path : `https://image.tmdb.org/t/p/w500${movie.poster_path}`,
                backdrop: movie.backdrop_path?.startsWith('http') ? movie.backdrop_path : `https://image.tmdb.org/t/p/original${movie.backdrop_path}`,
                date: movie.release_date,
                rating: movie.rating
            };

            const related = listMovie.filter(m => String(m.tmdb_id) !== String(movieId));
            container.innerHTML = ''; 
            container.appendChild(renderMovieDetail(movieData, related));
            window.scrollTo(0, 0);
        } else {
            container.innerHTML = `<h2 style="color:white; padding:100px; text-align:center;">Phim đang được cập nhật...</h2>`;
        }
    }

   // --- TRƯỜNG HỢP 2: TRANG XEM PHIM (page=watching) ---
    if (page === 'watching') {
        const container = document.getElementById('watching-page-container');
        if (!container) return;

        const movie = listMovie.find(m => String(m.tmdb_id) === String(movieId) || String(m.id) === String(movieId));
        
        if (movie) {
            const movieData = {
                ...movie,
                poster: movie.poster_path?.startsWith('http') ? movie.poster_path : `https://image.tmdb.org/t/p/w500${movie.poster_path}`,
                backdrop: movie.backdrop_path?.startsWith('http') ? movie.backdrop_path : `https://image.tmdb.org/t/p/original${movie.backdrop_path}`,
                rating: movie.rating || 0
            };

            const related = listMovie.filter(m => String(m.tmdb_id) !== String(movieId));
            container.innerHTML = '';
            container.appendChild(renderWatchingPage(movieData, related));
            window.scrollTo(0, 0);
        } else {
            container.innerHTML = `<h2 style="color:white; text-align:center; padding:100px;">Không tìm thấy dữ liệu video.</h2>`;
        }
    }
};

/**
 * FETCH DỮ LIỆU TỪ API VÀ RENDER TRANG CHỦ
 */
const apiMovie = '/WEBSITE-PHIM/api/get_movies.php';

fetch(apiMovie)
    .then(res => res.json())
    .then(data => {
        const listMovie = data;
        loadWatchPage(listMovie);
        
        const movieArray = listMovie.map(item => ({
            title: item.title,
            date: item.release_date,
            poster: item.poster_path?.startsWith('http') ? item.poster_path : `https://image.tmdb.org/t/p/w500${item.poster_path}`,
            rating: item.rating,
            overview: item.overview,
            background: item.backdrop_path ? `https://image.tmdb.org/t/p/w500${item.backdrop_path}` : '',
            tmdb_id: item.tmdb_id || item.id,
            id: item.tmdb_id || item.id 
        }));

        // Render Movie Grid 3 (Phim mới)
        const movieGrid3 = document.querySelector('.movie-grid-3');
        if (movieGrid3) {
            for (let i = Math.min(9, movieArray.length - 1); i >= 0; i--) {
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
            if (parseInt(releaseYear) === 2026 && movieGrid2 ) {
                movieGrid2.appendChild(createMovieCard(movieData));
            }
        });

        // Top Phim Rating
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
                    overview: item.overview,
                    background: `https://image.tmdb.org/t/p/w500${item.backdrop_path}`,
                    tmdb_id: item.id
                };
                const movieElement = MovieCardTop10(top10CardData, index);
                movieGrid4.appendChild(movieElement);
            });
        }

        // Xử lý Search Live
        const dataInput = document.querySelector('#search_input');
        const searchSuggestion = document.querySelector('#search-suggestions');

        if (dataInput) {
            dataInput.addEventListener('input', (event) => {
                const keyWork = event.target.value.toLowerCase().trim();
                if (keyWork === "") {
                    searchSuggestion.style.display = 'none';
                    searchSuggestion.innerHTML = ''; 
                    return; 
                }
                const Suggestion = listMovie.filter(item => item.title.toLowerCase().includes(keyWork));
                searchSuggestion.style.display = 'block';
                renderSearchSuggestions(Suggestion);
            });
        }
    });

/**
 * HIỆU ỨNG GIAO DIỆN
 */
window.addEventListener('scroll', () => {
    const header = document.getElementById('mainHeader');
    if (header) {
        header.style.background = window.scrollY > 50 ? 'rgba(5, 5, 5, 0.9)' : 'rgba(255, 255, 255, 0.05)';
    }
});

// Xử lý Logout (Nếu có nút logout ngoài màn hình)
const logoutBtn = document.getElementById('logoutBtn');
if (logoutBtn) {
    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        // Sau này sẽ gọi API PHP để hủy Session
        window.location.href = 'api/logout.php'; 
    });
}