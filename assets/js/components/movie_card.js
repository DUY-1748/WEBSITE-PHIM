


export const createMovieCard = (movie) => {
    // 1. Tạo các Element
    const card = document.createElement('div');
    const releaseYear = movie.date ? movie.date.split('-')[0] : '2024';

    // 2. Định nghĩa toàn bộ Style bằng cssText
    
    card.style.cssText = `
        position: relative;
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 12px;
        overflow: hidden;
        background-color: #1a1a1a;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    `;

    // 3. Nội dung HTML bên trong
    
    card.innerHTML = `
        <div class="poster-wrapper" style="width: 100%; height: 100%;">
            <img src="https://image.tmdb.org/t/p/w500${movie.poster}" 
                 style="width: 100%; height: 100%; object-fit: cover; transition: 0.5s;">
            
            <div style="position: absolute; top: 10px; left: 10px; background: #ffc107; 
                        color: black; font-weight: bold; font-size: 11px; padding: 4px 8px; 
                        border-radius: 4px; border: 1px solid rgba(0,0,0,0.5); z-index: 2;">
                Movie (VietSub)
            </div>

            <div class="overlay" style="position: absolute; inset: 0; background: rgba(0,0,0,0.4); 
                        display: flex; align-items: center; justify-content: center; 
                        opacity: 0; transition: 0.3s; z-index: 1;">
                <div style="width: 50px; height: 50px; background: #ffc107; border-radius: 50%; 
                            display: flex; align-items: center; justify-content: center;">
                    <i class="ph-fill ph-play" style="font-size: 24px; color: black;"></i>
                </div>
            </div>

            <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 15px; 
                        background: linear-gradient(transparent, rgba(0,0,0,0.9)); z-index: 2;">
                <h3 style="margin: 0; color: white; font-size: 16px; white-space: nowrap; 
                           overflow: hidden; text-overflow: ellipsis;">
                    ${movie.title}
                </h3>
                <p style="margin: 5px 0 0; color: #ffc107; font-size: 13px;">
                    Phim Mới • ${releaseYear}
                </p>
            </div>
        </div>
    `;

    // 4. Xử lý hiệu ứng Hover
    card.onmouseenter = () => {
        card.style.transform = "translateY(-8px)";
        card.style.boxShadow = "0 10px 20px rgba(0,0,0,0.5)";
        card.querySelector('.overlay').style.opacity = "1";
        card.querySelector('img').style.transform = "scale(1.1)";
    };

    card.onmouseleave = () => {
        card.style.transform = "translateY(0)";
        card.style.boxShadow = "0 4px 15px rgba(0,0,0,0.3)";
        card.querySelector('.overlay').style.opacity = "0";
        card.querySelector('img').style.transform = "scale(1)";
    };

    // 5. Sự kiện Click
    card.onclick = () => {
        window.location.href = `index.php?page=watch&id=${movie.tmdb_id}`;
    };

    return card;
};