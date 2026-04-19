// assets/js/components/rankingMovie.js

export const MovieCardTop10 = (movie, index) => {
    // 1. Tạo biến Topmovie là một DOM Element chuẩn
    const Topmovie = document.createElement('div');
    // Class chính (Thêm w-full để nó co giãn theo Grid)
    Topmovie.className = "relative group flex-shrink-0 w-full min-w-[170px] sm:w-[190px] cursor-pointer transition-all duration-300";

    // 2. Nội dung HTML bên trong (Sử dụng Template String cho gọn)
    // Các Class Tailwind đã được tinh chỉnh theo mẫu ảnh
    Topmovie.innerHTML = `
        <span class="absolute -bottom-8 -left-3 text-7xl font-black text-yellow-500 italic z-20 select-none drop-shadow-[0_2px_15px_rgba(0,0,0,1)] opacity-90">
            ${index + 1}
        </span>

        <div class="relative rounded-2xl overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.6)] border border-black/20 aspect-[2/3] z-10 transition-transform duration-300 group-hover:scale-105">
            <img 
                src="${movie.poster}" 
                alt="${movie.title}" 
                class="w-full h-full object-cover"
                loading="lazy"
            >
            <div class="absolute bottom-2 right-2 flex gap-1 z-10">
                <span class="bg-green-600/90 backdrop-blur-sm text-[9px] px-2 py-0.5 rounded font-bold text-white shadow-md">T.Minh</span>
                <span class="bg-blue-600/90 backdrop-blur-sm text-[9px] px-2 py-0.5 rounded font-bold text-white shadow-md">HT</span>
            </div>
        </div>

        <div class="mt-4 pl-8 group-hover:opacity-60 transition-opacity">
            <h3 class="text-white text-sm font-semibold truncate transition-colors group-hover:text-yellow-500">
                ${movie.title}
            </h3>
            <p class="text-gray-400 text-xs mt-1 font-medium truncate">
                ${movie.latest_episode || 'Tập mới'} / ${movie.quality || 'HD'}
            </p>
        </div>

        <div class="absolute top-1/2 left-full ml-5 -translate-y-1/2 w-[300px] bg-[#1a1c24] rounded-2xl p-6 shadow-[0_20px_50px_rgba(0,0,0,0.9)] 
                    border border-white/10
                    opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                    scale-95 group-hover:scale-100 transition-all duration-300 z-[100] 
                    pointer-events-none group-hover:pointer-events-auto">
            
            <div class="absolute inset-0 bg-cover bg-center opacity-10 rounded-2xl" style="background-image: url('${movie.poster}')"></div>
            
            <div class="relative z-10">
                <h3 class="text-white font-black text-xl leading-tight mb-1 truncate">${movie.title}</h3>
                <p class="text-yellow-500 text-[11px] font-medium italic mb-5">Làng Phim Exclusive</p>

                <div class="flex items-center gap-2 mb-5">
                    <button class="bg-yellow-500 hover:bg-yellow-400 text-black px-5 py-2.5 rounded-lg text-sm font-black flex items-center gap-2 transition-transform active:scale-95">
                        <i class="fas fa-play"></i> Xem ngay
                    </button>
                    <button class="bg-white/10 hover:bg-white/20 text-white p-2.5 rounded-lg text-sm transition-colors" title="Thêm vào yêu thích">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="bg-white/10 hover:bg-white/20 text-white p-2.5 rounded-lg text-sm transition-colors" title="Thông tin chi tiết">
                        <i class="fas fa-info-circle"></i>
                    </button>
                </div>

                <div class="flex flex-wrap gap-2 mb-4">
                    <span class="bg-yellow-500/10 text-yellow-500 px-2 py-0.5 rounded border border-yellow-500/30 text-[11px] font-bold shadow-inner">⭐ ${movie.rating || '8.9'}</span>
                    <span class="bg-white/5 text-gray-300 px-2 py-0.5 rounded text-[11px] font-medium">${movie.releaseYear || '2026'}</span>
                    <span class="bg-white/5 text-gray-300 px-2 py-0.5 rounded text-[11px] font-medium">UltraHD</span>
                    <span class="bg-white/5 text-gray-300 px-2 py-0.5 rounded text-[11px] font-medium">Full: ${movie.totalEpisodes || '30'} Tập</span>
                </div>
                
                <p class="text-gray-400 text-xs leading-relaxed line-clamp-3 mb-4">
                    ${movie.overview || 'Chưa có mô tả cho bộ phim này. Vui lòng cập nhật sau...'}
                </p>
                
                <div class="pt-3 border-t border-white/5">
                    <p class="text-[10px] text-gray-500">Thể loại: <span class="text-gray-300">Hành động, Phiêu lưu, Viễn tưởng</span></p>
                </div>
            </div>
        </div>
    `;

    
    return Topmovie;
};