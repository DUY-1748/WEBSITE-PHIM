export const renderMovieDetail = (movie, relatedMovies) => {
    const container = document.createElement('div');
    
    // Fix lỗi undefined cho ngày tháng
    const releaseDate = movie.date || 'Đang cập nhật';
    const rating = movie.rating || '8.5';

    container.style.cssText = `
        display: flex;
        flex-direction: column;
        background-color: #0b0c10;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        width: 100%;
    `;

    // CHỈ GÁN INNERHTML MỘT LẦN DUY NHẤT
    container.innerHTML = `
        <div style="position: relative; height: 600px; width: 100%; overflow: hidden;">
            <div style="
                position: absolute; inset: 0;
                background: linear-gradient(to bottom, rgba(11,12,16,0) 0%, rgba(11,12,16,0.4) 80%, #0b0c10 100%), 
                            url('${movie.backdrop || movie.poster}');
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

        <div style="display: grid; grid-template-columns: 3fr 2fr; gap: 50px; padding: 0 60px; margin-top: 20px;">
            <div>
                <div style="display: flex; gap: 40px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 30px;">
                    <p style="color: #ffc107; border-bottom: 3px solid #ffc107; padding-bottom: 15px; font-weight: bold; margin-bottom: -1px; cursor: pointer;">THÔNG TIN</p>
                    <p style="color: #666; padding-bottom: 15px; cursor: pointer; transition: 0.3s;">DIỄN VIÊN</p>
                    <p style="color: #666; padding-bottom: 15px; cursor: pointer; transition: 0.3s;">BÌNH LUẬN</p>
                </div>
                
                <p style="font-size: 16px; color: #a0a0a0; line-height: 1.8; margin-bottom: 30px; text-align: justify;">
                    ${movie.overview || 'Mô tả phim đang được cập nhật...'}
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; background: rgba(255,255,255,0.03); padding: 25px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                    <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Ngày phát hành</span> <strong style="color: #ddd;">${releaseDate}</strong></div>
                    <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Đánh giá</span> <strong style="color: #ffc107;">⭐ ${rating} / 10</strong></div>
                    <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Thời lượng</span> <strong style="color: #ddd;">120 phút</strong></div>
                    <div><span style="color: #555; display: block; font-size: 12px; text-transform: uppercase;">Chất lượng</span> <strong style="color: #ddd;">4K Ultra HD</strong></div>
                </div>
            </div>

            <div>
                <div style="background: #15161d; border-radius: 16px; padding: 30px; border: 1px solid rgba(255,255,255,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    <h3 style="margin-top: 0; margin-bottom: 25px; font-size: 20px; display: flex; align-items: center; gap: 10px;">
                        <i class="ph-bold ph-chat-centered-text" style="color: #ffc107;"></i> Bình luận
                    </h3>
                    <div style="background: #0b0c10; border-radius: 12px; padding: 15px; border: 1px solid #25262b;">
                        <textarea placeholder="Chia sẻ cảm nghĩ của bạn..." style="width: 100%; background: transparent; border: none; color: white; height: 100px; resize: none; outline: none; font-size: 14px;"></textarea>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #25262b;">
                            <span style="font-size: 12px; color: #555;">0 / 1000</span>
                            <button style="background: #ffc107; color: black; border: none; padding: 8px 25px; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s;">Gửi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="padding: 60px;">
            <h2 style="font-size: 24px; font-weight: 900; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;">
                <span style="width: 4px; height: 24px; background: #ffc107; display: inline-block; border-radius: 2px;"></span>
                PHIM ĐỀ XUẤT
            </h2>
            <div class="related-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 25px;">
            </div>
        </div>
    `;

    // XỬ LÝ NÚT BẤM VÀ HIỆU ỨNG (Sau khi innerHTML đã ổn định)
    const watchBtn = container.querySelector('#btn-watch-main');
    if (watchBtn) {
        watchBtn.style.transition = "0.3s all ease";

        // Hiệu ứng nổi lên khi rê chuột
        watchBtn.onmouseover = () => {
            watchBtn.style.transform = "scale(1.05) translateY(-5px)";
            watchBtn.style.filter = "brightness(1.1)";
            watchBtn.style.boxShadow = "0 10px 20px rgba(255, 193, 7, 0.3)";
        };

        watchBtn.onmouseout = () => {
            watchBtn.style.transform = "scale(1) translateY(0)";
            watchBtn.style.filter = "brightness(1)";
            watchBtn.style.boxShadow = "none";
        };
        
        // Sự kiện click để sang trang xem phim
        watchBtn.onclick = () => {
            // movie.tmdb_id hoặc movie.id tùy thuộc vào Database của bạn
            const id = movie.tmdb_id || movie.id; 
            window.location.href = `index.php?page=watching&id=${id}`;
        };
    }

    return container;
};