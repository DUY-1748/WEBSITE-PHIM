// assets/js/components/movie_card.js

export const createMovieCard = (movie) => {
    // 1. Tạo Container chính
    const card = document.createElement('div');
    const releaseYear = movie.date ? movie.date.split('-')[0] : '2024';

    // Định dạng Card (Cần có relative để Popup căn theo nó)
    card.style.cssText = `
        position: relative;
        width: 190px;
        flex-shrink: 0;
        aspect-ratio: 2/3;
        border-radius: 12px;
        background-color: #1a1a1a;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1;
    `;

    // 2. Nội dung HTML bao gồm cả Card và Popup ẩn
    card.innerHTML = `
        <div class="poster-wrapper" style="width: 100%; height: 100%; border-radius: 12px; overflow: hidden; position: relative; border: 1px solid rgba(255,255,255,0.05);">
            <img src="${movie.poster}" 
                 style="width: 100%; height: 100%; object-fit: cover; transition: 0.5s;">
            
            <div style="position: absolute; top: 10px; left: 10px; background: #ffc107; 
                        color: black; font-weight: bold; font-size: 10px; padding: 3px 8px; 
                        border-radius: 4px; z-index: 2;">
                VietSub
            </div>

            <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 15px; 
                        background: linear-gradient(transparent, rgba(0,0,0,0.9)); z-index: 2;">
                <h3 style="margin: 0; color: white; font-size: 14px; white-space: nowrap; 
                           overflow: hidden; text-overflow: ellipsis; font-family: sans-serif;">
                    ${movie.title}
                </h3>
            </div>
        </div>

        <div class="movie-popup" style="
            position: absolute;
            top: 50%;
            left: -20%;
            transform: translateY(-50%) translateX(15px);
            width: 260px;
            background: #1a1c24;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.8);
            border: 1px solid rgba(255,255,255,0.1);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 999;
            pointer-events: none;
        ">
            <div style="position: absolute; inset: 0; background-image: url('${movie.poster}'); 
                        background-size: cover; background-position: center; opacity: 0.1; border-radius: 16px;"></div>
            
            <div style="position: relative; z-index: 10; font-family: sans-serif;">
                <h3 style="color: white; font-weight: 800; font-size: 16px; margin: 0; line-height: 1.2;">${movie.title}</h3>
                <p style="color: #ffc107; font-size: 11px; margin: 5px 0 15px 0;">Làng Phim Streaming</p>

                <div style="display: flex; gap: 6px; margin-bottom: 12px;">
                    <span style="background: rgba(255, 193, 7, 0.1); color: #ffc107; padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: bold; border: 1px solid rgba(255, 193, 7, 0.2);">⭐ ${movie.rating || 'N/A'}</span>
                    <span style="background: rgba(255,255,255,0.05); color: #ccc; padding: 2px 6px; border-radius: 4px; font-size: 10px;">${releaseYear}</span>
                    <span style="background: rgba(255,255,255,0.05); color: #ccc; padding: 2px 6px; border-radius: 4px; font-size: 10px;">HD</span>
                </div>
                
                <p style="color: #aaa; font-size: 11px; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 15px;">
                    ${movie.overview || 'Nội dung phim đang được cập nhật...'}
                </p>

                <button style="width: 100%; background: #ffc107; color: black; border: none; padding: 8px; border-radius: 6px; font-size: 12px; font-weight: bold; cursor: pointer;">
                    ▶ Xem ngay
                </button>
            </div>
        </div>
    `;

    // 3. Xử lý hiệu ứng Hover bằng JS
    const popup = card.querySelector('.movie-popup');
    const img = card.querySelector('img');

    card.onmouseenter = () => {
        card.style.zIndex = "100"; // Đưa lên trên để không bị card khác che popup
        popup.style.opacity = "1";
        popup.style.visibility = "visible";
        popup.style.transform = "translateY(-50%) translateX(0)"; // Trượt vào
        img.style.transform = "scale(1.1)";
    };

    card.onmouseleave = () => {
        card.style.zIndex = "1";
        popup.style.opacity = "0";
        popup.style.visibility = "hidden";
        popup.style.transform = "translateY(-50%) translateX(15px)"; // Trượt ra
        img.style.transform = "scale(1)";
    };

    // 4. Sự kiện Click chuyển hướng
    card.onclick = () => {
        window.location.href = `index.php?page=watch&id=${movie.tmdb_id}`;
    };

    return card;
};