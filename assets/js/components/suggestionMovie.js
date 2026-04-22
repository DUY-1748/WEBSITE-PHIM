export const renderSearchSuggestions = (filteredMovies) => {
    const searchSuggestionBox = document.querySelector('#search-suggestions');
    
    // Kiểm tra nếu không có box thì dừng luôn
    if (!searchSuggestionBox) return;

    // Xóa sạch nội dung cũ mỗi khi gõ phím
    searchSuggestionBox.innerHTML = ''; 

    if (filteredMovies.length === 0) {
        searchSuggestionBox.style.display = 'none';
        
    }

    // 1. Style cho khung Dropdown bao ngoài
    searchSuggestionBox.style.cssText = `
        display: block !important;
        position: absolute !important;
        top: 100% !important;
        right: 90px;
        width: 26% !important;
        background: #1a1c22 !important;
        border: 1px solid #2d2f36 !important;
        border-radius: 8px !important;
        margin-top: 8px !important;
        z-index: 9999 !important;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5) !important;
        overflow: hidden !important;
    `;

    // 2. Tiêu đề "Danh sách gợi ý"
    const header = document.createElement('p');
    header.textContent = 'Danh sách gợi ý';
    header.style.cssText = `
        padding: 10px 15px !important;
        margin: 0 !important;
        color: #888 !important;
        font-size: 12px !important;
        background: #24272e !important;
        border-bottom: 1px solid #2d2f36 !important;
        text-transform: uppercase !important;
        letter-spacing: 1px !important;
    `;
    searchSuggestionBox.appendChild(header);

    // 3. Lặp qua danh sách phim (Lấy tối đa 6 phim)
    filteredMovies.slice(0, 6).forEach(movie => {
        // Xử lý tách tên và dữ liệu
        const titleParts = movie.title.split('(');
        const vnTitleText = titleParts[0].trim();
        const enTitleText = titleParts[1] ? titleParts[1].replace(')', '') : '';
        const releaseYear = movie.release_date ? movie.release_date.split('-')[0] : '2024';
        const durationText = movie.duration || '120 phút';

        // --- TẠO COMPONENT ITEM ---
        const item = document.createElement('a');
        item.href = `index.php?page=watch&id=${movie.id}`;
        item.style.cssText = `
            display: flex !important;
            align-items: center !important;
            padding: 10px 15px !important;
            text-decoration: none !important;
            border-bottom: 1px solid #24272e !important;
            transition: background 0.2s !important;
            width: 100% !important;
            box-sizing: border-box !important;
        `;
        item.onmouseover = () => item.style.backgroundColor = '#2d2f36';
        item.onmouseout = () => item.style.backgroundColor = 'transparent';

        // Poster
        const img = document.createElement('img');
        img.src = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
        img.style.cssText = `
            width: 45px !important;
            height: 65px !important;
            object-fit: cover !important;
            border-radius: 4px !important;
            margin-right: 15px !important;
            flex-shrink: 0 !important;
        `;

        // Khung thông tin
        const info = document.createElement('div');
        info.style.cssText = `
            display: flex !important;
            flex-direction: column !important;
            overflow: hidden !important;
        `;

        // Tên tiếng Việt
        const titleVN = document.createElement('p');
        titleVN.textContent = vnTitleText;
        titleVN.style.cssText = `
            color: #f5b50a !important;
            font-size: 15px !important;
            font-weight: bold !important;
            margin: 0 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        `;

        // Tên tiếng Anh
        const titleEN = document.createElement('span');
        titleEN.textContent = enTitleText;
        titleEN.style.cssText = `
            color: #ccc !important;
            font-size: 11px !important;
            margin: 2px 0 !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
        `;

        // Năm và thời lượng
        const meta = document.createElement('span');
        meta.textContent = `${releaseYear} • ${durationText}`;
        meta.style.cssText = `
            color: #777 !important;
            font-size: 11px !important;
            margin-top: 2px !important;
        `;

        // Lắp ráp các thành phần
        info.appendChild(titleVN);
        if (enTitleText) info.appendChild(titleEN);
        info.appendChild(meta);

        item.appendChild(img);
        item.appendChild(info);

        searchSuggestionBox.appendChild(item);
    });
};