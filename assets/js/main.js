/*js*/
import { createMovieCard } from './components/movie_card.js';
import { MovieCardTop10 } from './components/rankingMovie.js';
import { renderMovieDetail } from './components/movieDetail.js';
import { renderWatchingPage } from './components/watchingMovie.js';

/**
 * HÀM XỬ LÝ ĐỊNH TUYẾN TRANG (WATCH & WATCHING)
 */
import { renderSearchSuggestions } from './components/suggestionMovie.js';

const loadWatchPage = (listMovie) => {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page');
    const movieId = urlParams.get('id');

    if (!movieId) return; 

    // --- TRƯỜNG HỢP 1: TRANG CHI TIẾT (page=watch) ---
    if (page === 'watch') {
        const container = document.querySelector('.detail');
        if (!container) return;

        // Tìm phim: Ưu tiên tìm theo tmdb_id vì URL của bạn dùng ID TMDB (1084187)
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
            
            // Truyền movieData đã được chuẩn hóa ảnh
            container.appendChild(renderWatchingPage(movieData, related));
            
            window.scrollTo(0, 0);
            console.log("Đã render trang xem phim cho ID:", movieId);
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
        
        // Gọi hàm xử lý định tuyến trang watch/watching
        loadWatchPage(listMovie);
        
        // Chuẩn hóa dữ liệu cho các Movie Card ở trang chủ
        const movieArray = listMovie.map(item => ({
            title: item.title,
            date: item.release_date,
            poster: item.poster_path?.startsWith('http') ? item.poster_path : `https://image.tmdb.org/t/p/w500${item.poster_path}`,
            rating: item.rating,
            overview: item.overview,
            background: item.backdrop_path ? `https://image.tmdb.org/t/p/w500${item.backdrop_path}` : '',
            tmdb_id: item.tmdb_id || item.id, // Đảm bảo lấy đúng ID để gán vào link
            id: item.tmdb_id || item.id 
        }));

        // Render Movie Grid 3 (Top phim mới)
        const movieGrid3 = document.querySelector('.movie-grid-3');
        if (movieGrid3) {
            for (let i = Math.min(9, movieArray.length); i >= 0  ; i--) {
                movieGrid3.appendChild(createMovieCard(movieArray[i]));
            }
        }

        // Render các Grid khác và trang All Movie
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

        // Top Phim Hôm Nay (Dựa trên rating)
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
                    background: `https://image.tmdb.org/t/p/w500${item.background_path}`,
                    tmdb_id: item.id
                };
                loadWatchPage(top10Data)
                const movieElement = MovieCardTop10(top10CardData, index);
                movieGrid4.appendChild(movieElement);
            });
        }
       


        // xử lý search before enter event 

        const dataInput = document.querySelector('#search_input');
        const searchSuggestion = document.querySelector('#search-suggestions');

        dataInput.addEventListener('input',(event) => {
            const keyWork = event.target.value.toLowerCase().trim();
            if (keyWork === "") {
                searchSuggestion.style.display = 'none';
                searchSuggestion.innerHTML = ''; // Xóa sạch nội dung bên trong
                return; 
            }
            if (!listMovie || listMovie.length === 0) {
                console.error("Dữ liệu listMovie đang rỗng, không thể search live!");
                return;
            }
            const Suggestion = listMovie.filter(item => {
                return item.title.toLowerCase().includes(keyWork);
               
            });

        console.log("Kết quả tìm được:", Suggestion);
        renderSearchSuggestions(Suggestion);
        });
        

       
                
        
    })
    











/**
 * CÁC HIỆU ỨNG GIAO DIỆN (HEADER, MODAL)
 */
// Header Scroll Effect
window.addEventListener('scroll', () => {
    const header = document.getElementById('mainHeader');
    if (header) {
        header.style.background = window.scrollY > 50 ? 'rgba(5, 5, 5, 0.9)' : 'rgba(255, 255, 255, 0.05)';
    }
});

// Modal Logic
const loginBtn = document.getElementById('loginBtn');
const authModal = document.getElementById('authModal');
const closeModal = document.getElementById('closeModal');
const loginForm = document.getElementById('loginForm');
const userMenu = document.getElementById('userMenu');
const logoutBtn = document.getElementById('logoutBtn');

if (loginBtn && authModal) {
    loginBtn.addEventListener('click', () => authModal.classList.add('active'));
}

if (closeModal) {
    closeModal.addEventListener('click', () => authModal.classList.remove('active'));
}

// Chuyển đổi Đăng nhập / Đăng ký
const authViewsContainer = document.getElementById('authViews');
const switchToRegisterBtn = document.getElementById('switchToRegister');
const switchToLoginBtn = document.getElementById('switchToLogin');

if (switchToRegisterBtn && switchToLoginBtn && authViewsContainer) {
    switchToRegisterBtn.addEventListener('click', () => authViewsContainer.classList.add('show-register'));
    switchToLoginBtn.addEventListener('click', () => authViewsContainer.classList.remove('show-register'));
}

// Xử lý Login giả định
if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const passInput = document.getElementById('passInput').value;
        if (passInput === '123') {
            authModal.classList.remove('active');
            loginBtn.style.display = 'none';
            userMenu.style.display = 'block';
        }
    });
}

if (logoutBtn) {
    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        userMenu.style.display = 'none';
        loginBtn.style.display = 'block';
    });
}