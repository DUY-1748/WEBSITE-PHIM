export const renderWatchingPage = (movie, relatedMovies = []) => {
    const container = document.createElement('div');
    container.style.cssText = `background-color: #0b0c10; color: white; padding: 20px 0; min-height: 100vh; font-family: 'Inter', sans-serif; padding-top:60px;`;

    const user = JSON.parse(sessionStorage.getItem('user'));
    const isLoggedIn = !!user;

    // --- HELPER: ĐỊNH DẠNG THỜI GIAN ---
    const formatTime = (dateString) => {
        const date = new Date(dateString);
        return `${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')} ${date.getDate()}/${date.getMonth() + 1}/${date.getFullYear()}`;
    };

    // --- LOGIC VIDEO ---
    const videoId = movie.video_key;
    const backdropUrl = movie.backdrop_path?.startsWith('http') 
        ? movie.backdrop_path 
        : `https://image.tmdb.org/t/p/original${movie.backdrop_path}`;

    let playerHtml = videoId && videoId !== 'NULL' 
        ? `<iframe id="main-video" src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" allowfullscreen></iframe>`
        : `<div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('${backdropUrl}') no-repeat center center; background-size: cover; display: flex; align-items: center; justify-content: center;">
            <div style="background: rgba(0,0,0,0.85); padding: 30px; border-radius: 15px; text-align: center; border: 1px solid #ffc107;">
                <h2 style="color: white; font-size: 20px;">Trailer đang được cập nhật</h2>
            </div>
          </div>`;

    // --- GIAO DIỆN NHẬP BÌNH LUẬN ---
    let commentSectionHtml = isLoggedIn ? `
        <div style="background: #1a1d23; padding: 25px; border-radius: 8px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                <div style="width: 35px; height: 35px; background: #ffc107; color: black; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                    ${user.username.charAt(0).toUpperCase()}
                </div>
                <span style="font-weight: 500;">${user.username}</span>
            </div>
            <textarea id="comment_input" placeholder="Viết bình luận của bạn..." style="width: 100%; background: #0b0c10; border: 1px solid #333; border-radius: 8px; color: white; padding: 15px; min-height: 100px; resize: none; outline: none;"></textarea>
            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                <button id="btn_send_comment" style="background: #ffc107; color: black; border: none; padding: 10px 25px; border-radius: 6px; font-weight: bold; cursor: pointer;">Gửi bình luận</button>
            </div>
        </div>` : `
        <div style="background: #1a1d23; padding: 40px; border-radius: 8px; text-align: center; border: 1px dashed #333;">
            <p style="color: #aaa; margin-bottom: 20px;">Vui lòng đăng nhập để bình luận về bộ phim này.</p>
            <button style="background: #ffc107; color: black; border: none; padding: 12px 30px; border-radius: 25px; font-weight: bold; cursor: pointer;" onclick="window.location.href='index.php?page=login'">Đăng nhập ngay</button>
        </div>`;

    container.innerHTML = `
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div id="player-section" style="position: relative; padding-top: 56.25%; background: #000; border-radius: 12px; overflow: hidden;">
                ${playerHtml}
            </div>

            <div style="background: #1a1d23; padding: 25px; border-radius: 8px; margin-top: 20px;">
                <h1 style="font-size: 28px; margin-bottom: 10px;">${movie.title}</h1>
                <p style="color: #ccc; line-height: 1.8;">${movie.overview || 'Đang cập nhật nội dung...'}</p>
            </div>

            <div style="margin-top: 40px;">
                <h3 style="font-size: 20px; margin-bottom: 20px; border-left: 4px solid #ffc107; padding-left: 15px;">Bình luận</h3>
                <div id="comment_form_container">${commentSectionHtml}</div>
                <div id="comment_list" style="margin-top: 25px; display: flex; flex-direction: column; gap: 20px;">
                    </div>
            </div>

            <div style="margin-top: 40px; padding-bottom: 40px;">
                <h3 style="font-size: 20px; margin-bottom: 20px; border-left: 4px solid #ffc107; padding-left: 15px;">Đề xuất cho bạn</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)); gap: 20px;">
                    ${relatedMovies.slice(0, 6).map(item => `
                        <div class="suggest-card" onclick="window.location.href='index.php?page=watching&id=${item.id}'">
                            <img src="${item.poster_path?.startsWith('http') ? item.poster_path : `https://image.tmdb.org/t/p/w300${item.poster_path}`}" style="width: 100%; border-radius: 8px; aspect-ratio: 2/3; object-fit: cover;">
                            <p style="font-size: 13px; margin-top: 10px; font-weight: bold; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${item.title}</p>
                        </div>
                    `).join('')}
                </div>
            </div>
        </div>

        <style>
            .suggest-card { cursor: pointer; transition: 0.3s; }
            .suggest-card:hover { transform: translateY(-5px); }
            .comment-item-flex { display: flex; gap: 15px; animation: fadeIn 0.5s ease; }
            @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
            #comment_input:focus { border-color: #ffc107 !important; }
        </style>
    `;

    // --- HÀM TẢI BÌNH LUẬN TỪ DATABASE ---
    const loadComments = async () => {
        const commentList = container.querySelector('#comment_list');
        try {
            const res = await fetch(`admin/process-comment.php?movie_id=${movie.id}`);
            const comments = await res.json();
            
            if (comments.length === 0) {
                commentList.innerHTML = `<p style="color: #666; text-align: center;">Chưa có bình luận nào. Hãy là người đầu tiên!</p>`;
                return;
            }

            commentList.innerHTML = comments.map(c => `
                <div class="comment-item-flex">
                    <div style="width: 45px; height: 45px; background: #2a2e35; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #333;">
                        <span style="color: #ffc107; font-weight: bold; font-size: 18px;">${c.username.charAt(0).toUpperCase()}</span>
                    </div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <strong style="color: white; font-size: 15px;">${c.username}</strong>
                            <span style="color: #666; font-size: 12px;">${formatTime(c.created_at)}</span>
                        </div>
                        <p style="color: #ccc; font-size: 14px; margin-top: 5px; line-height: 1.5; white-space: pre-wrap;">${c.content}</p>
                    </div>
                </div>
            `).join('');
        } catch (e) {
            console.error("Lỗi load bình luận:", e);
        }
    };

    // --- XỬ LÝ SỰ KIỆN ---
    setTimeout(() => {
        loadComments(); // Load bình luận ngay khi trang mở

        const btnSend = container.querySelector('#btn_send_comment');
        const inputComment = container.querySelector('#comment_input');

        if (btnSend) {
            btnSend.onclick = async () => {
                const content = inputComment.value.trim();
                if (!content) return;

                const response = await fetch('admin/process-comment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `movie_id=${movie.id}&content=${encodeURIComponent(content)}`
                });

                const result = await response.json();
                if (result.status === 'success') {
                    inputComment.value = '';
                    loadComments(); // Tải lại danh sách để hiện bình luận mới nhất
                }
            };
        }
    }, 100);

    return container;
};