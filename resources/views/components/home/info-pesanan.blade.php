<x-home.index>
    <div class="status-container"
        style="display: flex; justify-content: space-between; align-items: center; padding: 20px; max-width: 600px; margin: 0 auto;">
        <a href="/order/belum-bayar">
            <div class="status-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                <div class="icon"
                    style="width: 50px; height: 50px; background-color: #f0ad4e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-hourglass-start" style="color: white;"></i>
                </div>
                <p style="margin-top: 5px; font-size: 14px;">Belum Dibayar</p>
            </div>
        </a>

        <a href="/order/pesanan" class="link-dark">
            <div class="status-item" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                <div class="icon"
                    style="width: 50px; height: 50px; background-color: #5bc0de; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-utensils" style="color: white;"></i>
                </div>
                <p style="margin-top: 5px; font-size: 14px;">Pesanan</p>
            </div>
        </a>

        <a href="/order/pesanan/siap" class="link-dark">
            <div class="status-item"
                style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                <div class="icon"
                    style="width: 50px; height: 50px; background-color: #5cb85c; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-truck" style="color: white;"></i>
                </div>
                <p style="margin-top: 5px; font-size: 14px;">Siap Dikirim</p>
            </div>
        </a>

        <a href="/order/pesanan/selesai" class="link-dark">
            <div class="status-item"
                style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                <div class="icon"
                    style="width: 50px; height: 50px; background-color: #d9534f; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-star" style="color: white;"></i>
                </div>
                <p style="margin-top: 5px; font-size: 14px;">Untuk Diulas</p>
            </div>
        </a>
    </div>

    
    {{ $slot }}


</x-home.index>
