export const renderMovieDetail = (movie, relatedMovies = []) => {
    const container = document.createElement('div');
    
    // Fix lỗi undefined cho dữ liệu
    const releaseDate = movie.release_date || movie.date || 'Đang cập nhật';
    const rating = movie.rating || '8.5';
    const overview = movie.overview || 'Mô tả phim đang được cập nhật...';
    const backdropImg = movie.backdrop_path ? `https://image.tmdb.org/t/p/original${movie.backdrop_path}` : (movie.backdrop || movie.poster);

    container.style.cssText = `
        display: flex;
        flex-direction: column;
        background-color: #0b0c10;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        width: 100%;
    `;

    // 1. Phần giao diện chính (Đã bỏ cột bình luận)
    container.innerHTML = `
        <div style="position: relative; height: 600px; width: 100%; overflow: hidden;">
            <div style="
                position: absolute; inset: 0;
                background: linear-gradient(to bottom, rgba(11,12,16,0) 0%, rgba(11,12,16,0.4) 80%, #0b0c10 100%), 
                            url('${backdropImg}');
                background-size: cover; background-position: top;
                filter: brightness(0.7);
            "></div>
            
            <div style="position: absolute; bottom: 60px; left: 60px; right: 60px; z-index: 10;">
                <span style="background: #ffc107; color: black; padding: 4px 12px; border-radius: 4px; font-weight: bold; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                    Phim Chiếu Rạp
                </span>
                <h1 style="font-size: 56px; font-weight: 900; margin: 15px 0; letter-spacing: -1px; line-height: 1.1;">
                    ${movie.title}
                </h1>
                <div style="display: flex; gap: 20px; align-items: center;">
                    <button id="btn-watch-main" style="background: #ffc107; color: black; border: none; padding: 15px 40px; border-radius: 8px; font-weight: 900; font-size: 16px; cursor: pointer; transition: 0.3s; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-play"></i> XEM NGAY
                    </button>
                    <div style="display: flex; gap: 15px;">
                        <button style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; backdrop-filter: blur(5px);"><i class="far fa-heart"></i></button>
                        <button style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; width: 45px; height: 45px; border-radius: 50%; cursor: pointer; backdrop-filter: blur(5px);"><i class="fas fa-share-alt"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding: 0 60px; margin-top: 20px; max-width: 1200px;">
            <div style="display: flex; gap: 40px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 30px;">
                <p style="color: #ffc107; border-bottom: 3px solid #ffc107; padding-bottom: 15px; font-weight: bold; margin-bottom: -1px; cursor: pointer;">THÔNG TIN</p>
                <p style="color: #666; padding-bottom: 15px; cursor: pointer; transition: 0.3s;">DIỄN VIÊN</p>
            </div>
            
            <p style="font-size: 16px; color: #a0a0a0; line-height: 1.8; margin-bottom: 30px; text-align: justify;">
                ${overview}
            </p>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; background: rgba(255,255,255,0.03); padding: 25px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Ngày phát hành</span> <strong style="color: #ddd;">${releaseDate}</strong></div>
                <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Đánh giá</span> <strong style="color: #ffc107;">⭐ ${rating} / 10</strong></div>
                <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Thời lượng</span> <strong style="color: #ddd;">120 phút</strong></div>
                <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Chất lượng</span> <strong style="color: #ddd;">4K Ultra HD</strong></div>
            </div>
        </div>

      <div style="padding: 60px;">
            <h2 style="font-size: 24px; font-weight: 900; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;">
                <span style="width: 4px; height: 24px; background: #ffc107; display: inline-block; border-radius: 2px;"></span>
                ĐỀ XUẤT CHO BẠN
            </h2>
            <div id="related-grid" style="
                display: grid; 
                /* Chỉnh lại thành 6 cột cố định, mỗi cột bằng nhau */
                grid-template-columns: repeat(6, 1fr); 
                gap: 20px;
            ">
                ${relatedMovies.length > 0 ? relatedMovies.slice(0, 6).map(m => `
                    <a href="index.php?page=watch&id=${m.id}" style="text-decoration: none; color: white; transition: 0.3s; display: block;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                        <div style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 2/3; box-shadow: 0 10px 20px rgba(0,0,0,0.3);">
                            <img src="${m.poster_path ? 'https://image.tmdb.org/t/p/w500' + m.poster_path : m.poster}" style="width: 100%; height: 100%; object-fit: cover;">
                            <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); padding: 2px 8px; border-radius: 4px; font-size: 11px; color: #ffc107; font-weight: bold;">
                                ⭐ ${m.rating || '8.0'}
                            </div>
                        </div>
                        <h4 style="margin: 12px 0 5px 0; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-weight: 600;">
                            ${m.title}
                        </h4>
                        <span style="color: #555; font-size: 12px;">${m.release_date ? m.release_date.substring(0,4) : '2024'}</span>
                    </a>
                `).join('') : '<p style="color: #555;">Đang tải phim liên quan...</p>'}
            </div>
        </div>
    `;

    // 3. XỬ LÝ NÚT BẤM
    const watchBtn = container.querySelector('#btn-watch-main');
    if (watchBtn) {
        watchBtn.onclick = () => {
            const id = movie.id; 
            window.location.href = `index.php?page=watching&id=${id}`;
        };
    }

    return container;
};