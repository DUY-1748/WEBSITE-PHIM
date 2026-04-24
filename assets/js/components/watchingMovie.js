export const renderWatchingPage = (movie, relatedMovies = []) => {
    const container = document.createElement('div');
    container.style.cssText = `background-color: #0b0c10; color: white; padding: 20px 0; min-height: 100vh; font-family: 'Inter', sans-serif; padding-top:60px;`;

    // --- XỬ LÝ LOGIC VIDEO ---
    const videoId = movie.video_key; // Lấy từ Database
    const backdropUrl = movie.backdrop_path?.startsWith('http') 
        ? movie.backdrop_path 
        : `https://image.tmdb.org/t/p/original${movie.backdrop_path}`;

    let playerHtml = '';
    if (videoId && videoId !== 'NULL') {
        playerHtml = `
            <iframe 
                id="main-video"
                src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1" 
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; margin-top:60px;" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>`;
    } else {
        playerHtml = `
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('${backdropUrl}') no-repeat center center; 
                        background-size: cover; display: flex; align-items: center; justify-content: center;">
                <div style="background: rgba(0,0,0,0.85); padding: 30px; border-radius: 15px; text-align: center; border: 1px solid #ffc107; max-width: 80%;">
                    <i class="fas fa-play-circle" style="font-size: 50px; color: #ffc107; margin-bottom: 15px;"></i>
                    <h2 style="margin: 0; color: white; font-size: 20px;">Trailer đang được cập nhật</h2>
                    <p style="color: #aaa; font-size: 14px; margin-top: 10px;">Chúng mình đang nỗ lực tìm kiếm video tốt nhất cho bộ phim này.</p>
                </div>
            </div>`;
    }

    container.innerHTML = `
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div id="player-section" style="position: relative; padding-top: 56.25%; background: #000; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.6);">
                ${playerHtml}
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; background: #1a1d23; padding: 15px; margin-top: 15px; border-radius: 8px; border-bottom: 2px solid #2a2e35;">
                <div style="display: flex; gap: 10px;">
                    <button class="btn-action"><i class="fas fa-expand"></i> Rạp phim</button>
                    <button class="btn-action" onclick="location.reload()"><i class="fas fa-sync"></i> Làm mới</button>
                    <div style="display: flex; align-items: center; gap: 8px; margin-left: 10px;">
                        <span style="font-size: 12px; color: #aaa;">Tự động chuyển tập</span>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn-action"><i class="fas fa-bookmark"></i> Xem sau</button>
                    <button class="btn-action"><i class="fas fa-heart"></i> Yêu thích</button>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 20px; margin-top: 20px;">
                <div style="background: #1a1d23; padding: 20px; border-radius: 8px;">
                    <h3 class="section-title">Nguồn phát</h3>
                    <button class="server-btn active">▶ Server 1 </button>
                    <button class="server-btn" style="opacity: 0.5;">Server 2</button>
                </div>
                <div style="background: #1a1d23; padding: 20px; border-radius: 8px;">
                    <h3 class="section-title">Danh sách tập</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <button class="ep-btn active">Full Trailer</button>
                        <button class="ep-btn" style="opacity: 0.4;">2</button>
                        <button class="ep-btn" style="opacity: 0.4;">3</button>
                    </div>
                </div>
            </div>

            <div style="background: #1a1d23; padding: 25px; border-radius: 8px; margin-top: 20px;">
                <h1 style="font-size: 28px; margin-bottom: 10px;">${movie.title}</h1>
                <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                    <span class="badge">${movie.release_date ? movie.release_date.split('-')[0] : '2026'}</span>
                    <span class="badge">4K UltraHD</span>
                    <span class="badge" style="color: #ffc107; border-color: #ffc107;">⭐ ${movie.rating}/10</span>
                </div>
                <p style="color: #ccc; font-size: 15px; line-height: 1.8;">${movie.overview || 'Đang cập nhật nội dung...'}</p>
            </div>

            <div style="margin-top: 40px;">
                <h3 style="font-size: 20px; margin-bottom: 20px; border-left: 4px solid #ffc107; padding-left: 15px;">Bình luận</h3>
                <div style="background: #1a1d23; padding: 40px; border-radius: 8px; text-align: center; border: 1px dashed #333;">
                    <p style="color: #aaa; margin-bottom: 20px;">Vui lòng đăng nhập để bình luận về bộ phim này.</p>
                    <button style="background: #ffc107; color: black; border: none; padding: 12px 30px; border-radius: 25px; font-weight: bold; cursor: pointer; transition: 0.3s;"
                            onclick="alert('Chức năng đăng nhập đang phát triển')">
                        Đăng nhập ngay
                    </button>
                    <p style="color: #666; font-size: 13px; margin-top: 30px;">Chưa có bình luận nào. Hãy là người đầu tiên!</p>
                </div>
            </div>

            <div style="margin-top: 40px; padding-bottom: 40px;">
                <h3 style="font-size: 20px; margin-bottom: 20px; border-left: 4px solid #ffc107; padding-left: 15px;">Đề xuất cho bạn</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 20px;">
                    ${relatedMovies.slice(0, 6).map(item => {
                        const posterUrl = item.poster_path?.startsWith('http') ? item.poster_path : `https://image.tmdb.org/t/p/w300${item.poster_path}`;
                        return `
                        <div class="suggest-card" onclick="window.location.href='index.php?page=watching&id=${item.tmdb_id || item.id}'">
                            <div style="position: relative; border-radius: 8px; overflow: hidden; aspect-ratio: 2/3;">
                                <img src="${posterUrl}" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                                <div class="card-overlay"><i class="fas fa-play"></i></div>
                            </div>
                            <p style="font-size: 13px; margin-top: 10px; font-weight: bold; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.title}</p>
                        </div>`;
                    }).join('')}
                </div>
            </div>
        </div>

        <style>
            .section-title { font-size: 14px; text-transform: uppercase; color: #ffc107; margin-bottom: 15px; letter-spacing: 1px; }
            .btn-action { background: #2a2e35; color: white; border: none; padding: 10px 18px; border-radius: 6px; cursor: pointer; transition: 0.3s; font-size: 13px; display: flex; align-items: center; gap: 8px; }
            .btn-action:hover { background: #ffc107; color: black; }
            .server-btn { width: 100%; text-align: left; padding: 12px; border-radius: 6px; border: 1px solid #333; margin-bottom: 10px; cursor: pointer; font-weight: bold; background: #2a2e35; color: white; }
            .server-btn.active { background: #ffc107; color: black; border-color: #ffc107; }
            .ep-btn { min-width: 60px; padding: 10px; border-radius: 6px; border: 1px solid #333; background: #2a2e35; color: white; cursor: pointer; font-weight: bold; }
            .ep-btn.active { background: #ffc107; color: black; }
            .badge { background: #333; padding: 4px 12px; border-radius: 4px; font-size: 12px; border: 1px solid transparent; }
            .suggest-card { cursor: pointer; transition: 0.3s; }
            .suggest-card:hover { transform: translateY(-8px); }
            .card-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 193, 7, 0.4); opacity: 0; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
            .suggest-card:hover .card-overlay { opacity: 1; }
            .switch { position: relative; display: inline-block; width: 34px; height: 18px; }
            .switch input { opacity: 0; width: 0; height: 0; }
            .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #444; transition: .4s; border-radius: 34px; }
            .slider:before { position: absolute; content: ""; height: 14px; width: 14px; left: 2px; bottom: 2px; background-color: white; transition: .4s; border-radius: 50%; }
            input:checked + .slider { background-color: #ffc107; }
            input:checked + .slider:before { transform: translateX(16px); }
        </style>
    `;

    return container;
};