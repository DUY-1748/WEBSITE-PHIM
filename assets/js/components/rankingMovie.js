// assets/js/components/rankingMovie.js

export const MovieCardTop10 = (movie, index) => {
    const Topmovie = document.createElement('div');
    
    // 1. Style cho Container chính (thay thế class relative, group, flex-shrink-0...)
    Topmovie.style.cssText = `
        position: relative;
        flex-shrink: 0;
        width: 250px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-right: 24px;
    `;

    Topmovie.innerHTML = `
        <span style="
            position: absolute;
            bottom: -32px;
            left: -12px;
            font-size: 72px;
            font-weight: 900;
            color: #eab308;
            font-style: italic;
            z-index: 20;
            user-select: none;
            filter: drop-shadow(0 2px 10px rgba(0,0,0,1));
            opacity: 0.9;
            font-family: sans-serif;
        ">
            ${index + 1}
        </span>

        <div class="poster-container" style="
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
            border: 1px solid rgba(0,0,0,0.2);
            aspect-ratio: 2/3;
            z-index: 10;
            transition: transform 0.3s ease;
        ">
            <img 
                src="${movie.poster}" 
                style="width: 100%; height: 100%; object-fit: cover;"
                loading="lazy"
            >
            <div style="position: absolute; bottom: 8px; right: 8px; display: flex; gap: 4px; z-index: 10;">
                <span style="background: rgba(22, 163, 74, 0.9); padding: 2px 8px; border-radius: 4px; font-size: 9px; font-weight: bold; color: white;">T.Minh</span>
                <span style="background: rgba(37, 99, 235, 0.9); padding: 2px 8px; border-radius: 4px; font-size: 9px; font-weight: bold; color: white;">HT</span>
            </div>
        </div>

        <div style="margin-top: 16px; padding-left: 32px;">
            <h3 style="color: white; font-size: 14px; font-weight: 600; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: sans-serif;">
                ${movie.title}
            </h3>
            <p style="color: #9ca3af; font-size: 12px; margin-top: 4px; font-family: sans-serif;">
                Tập mới / HD
            </p>
        </div>

        <div class="movie-popup" style="
            position: absolute;
            top: 50%;
            left: -30%;
            margin-left: 20px;
            transform: translateY(-50%) scale(0.95);
            width: 280px;
            background: #1a1c24;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.9);
            border: 1px solid rgba(255,255,255,0.1);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 100;
            pointer-events: none;
        ">
            <div style="
                position: absolute;
                inset: 0;
                background-image: url('${movie.poster}');
                background-size: cover;
                background-position: center;
                opacity: 0.1;
                border-radius: 16px;
            "></div>
            
            <div style="position: relative; z-index: 10; font-family: sans-serif;">
                <h3 style="color: white; font-weight: 800; font-size: 18px; margin: 0; line-height: 1.2;">${movie.title}</h3>
                <p style="color: #eab308; font-size: 11px; font-style: italic; margin: 4px 0 20px 0;">Làng Phim Exclusive</p>

                <div style="display: flex; gap: 8px; margin-bottom: 20px;">
                    <button class="btn-play" style="background: #eab308; color: black; border: none; padding: 10px 20px; border-radius: 8px; font-size: 12px; font-weight: 900; cursor: pointer;">
                        ▶ Xem ngay
                    </button>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                    <span style="background: rgba(234, 179, 8, 0.1); color: #eab308; padding: 2px 8px; border-radius: 4px; border: 1px solid rgba(234, 179, 8, 0.3); font-size: 11px; font-weight: bold;">⭐ ${movie.rating || '8.9'}</span>
                    <span style="background: rgba(255,255,255,0.05); color: #d1d5db; padding: 2px 8px; border-radius: 4px; font-size: 11px;">2026</span>
                    <span style="background: rgba(255,255,255,0.05); color: #d1d5db; padding: 2px 8px; border-radius: 4px; font-size: 11px;">UltraHD</span>
                </div>
                
                <p style="color: #9ca3af; font-size: 12px; line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 16px;">
                    ${movie.overview || 'Nội dung đang được cập nhật...'}
                </p>
            </div>
        </div>
    `;

    // 2. Xử lý hiệu ứng Hover bằng JavaScript (Vì style.cssText không hỗ trợ :hover)
    const popup = Topmovie.querySelector('.movie-popup');
    const poster = Topmovie.querySelector('.poster-container');

    Topmovie.onmouseenter = () => {
        popup.style.opacity = "1";
        popup.style.visibility = "visible";
        popup.style.transform = "translateY(-50%) scale(1)";
        poster.style.transform = "scale(1.05)";
    };

    Topmovie.onmouseleave = () => {
        popup.style.opacity = "0";
        popup.style.visibility = "hidden";
        popup.style.transform = "translateY(-50%) scale(0.95)";
        poster.style.transform = "scale(1)";
    };

    // 3. Xử lý sự kiện click chuyển hướng
    const btnPlay = Topmovie.querySelector('.btn-play');
    btnPlay.onclick = (e) => {
        e.stopPropagation();
        window.location.href = `index.php?page=watch&id=${movie.tmdb_id}`;
    };

    return Topmovie;
};