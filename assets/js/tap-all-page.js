const coinCountElement = document.getElementById('coin_count');
const maxTapCoinElement = document.getElementById('max_tap');


let coins = 0;
let taps = 0;
let isSyncingTap = false; // Flag untuk menandai apakah sedang dalam proses sinkronisasi
let isSyncingCoin = false; // Flag untuk menandai apakah sedang dalam proses sinkronisasi

function formatNumberCoin(num){
    // Format angka menjadi ribuan dengan dua desimal
    const formattedCoins = new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(num);

    // Cek apakah dua digit di belakang koma adalah 0
    if (formattedCoins.endsWith(',00')) {
        // Jika ya, hapus dua digit di belakang koma
        const integerPart = formattedCoins.slice(0, -3);
        return integerPart.replace('.', ',');
    } else {
        return formattedCoins.replace('.', ',').replace(',', '.');
    }
}


// Fungsi untuk mengambil nilai MAX_COIN dari database
async function getMaxCoinValue() {
    try {
        const response = await fetch('get_add_coin.php'); // Ganti dengan URL endpoint API untuk mengambil nilai ADD_COIN
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return parseFloat(data.max_coin, 10);
    } catch (error) {
        console.error('Error fetching MAX_COIN value:', error);
        return 1; // Nilai default jika gagal mengambil dari database
    }
}

async function getProfitPerOur() {
    try{
        const response = await fetch('get_profit_per_our.php');
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return parseFloat(data.coin_per_our, 10);
    } catch (error) {
        console.error('Error fetching MAX_COIN value:', error);
        return 0; // Nilai default jika gagal mengambil dari database
    }
}

// Fungsi untuk menyimpan nilai koin ke localStorage
function setCoinsToStorage(coins) {
    localStorage.setItem('coins', coins);
}

// Fungsi untuk mengambil nilai koin dari localStorage
function getCoinsFromStorage() {
    const storedCoins = localStorage.getItem('coins');
    // Jika storedCoins adalah null atau string kosong, kembalikan 0
    if (!storedCoins) {
        return 0;
    }

    // Konversi storedCoins menjadi angka menggunakan parseInt
    return parseFloat(storedCoins, 10);
}

// Fungsi untuk menyimpan nilai koin ke localStorage
function setLastTapToStorage(lastTapCoins) {
    localStorage.setItem('last_tap', lastTapCoins);
}

// Fungsi untuk mengambil nilai last tap dari localStorage
function getLastTapFromStorage() {
    const storedLastCoins = localStorage.getItem('last_tap');
    // Jika storedCoins adalah null atau string kosong, kembalikan 0
    if (!storedLastCoins) {
        return 0;
    }

    // Konversi storedCoins menjadi angka menggunakan parseInt
    return parseFloat(storedLastCoins, 10);
}

// Fungsi untuk memperbarui tampilan koin dan melakukan sinkronisasi
async function updateCoins(newCoins) {
    coins = newCoins;
    setCoinsToStorage(coins);

    if (!isSyncingCoin) {
        isSyncingCoin = true;
        try {
            const response = await fetch('update_coin_sql.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    coins
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        } catch (error) {
            console.error('Error updating coins:', error);
        } finally {
            isSyncingCoin = false;
        }
    }
}

// Fungsi untuk memperbarui tampilan tap dan melakukan sinkronisasi
async function updateLastTapCoins(lastTapCoins, max) {
    lastTap = lastTapCoins;
    setLastTapToStorage(lastTap);
    

    if (!isSyncingTap) {
        isSyncingTap = true;
        try {
            const response = await fetch('update_tap_sql.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    lastTap
                })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
        } catch (error) {
            console.error('Error updating taps:', error);
        } finally {
            isSyncingTap = false;
        }
    }
}

async function init() {
    // Ambil nilai MAX_COIN dari database
    const maxCoinValue = await getMaxCoinValue();
    // Ambil nilai PROFIT_PER_OUR dari database
    const profitPerOur = await getProfitPerOur();
    const profitPerSec = profitPerOur/60/60;


    taps = getLastTapFromStorage();
    updateLastTapCoins(taps, maxCoinValue);
    
    // Inisialisasi nilai koin dari localStorage
    coins = getCoinsFromStorage();
    updateCoins(coins);

    // tambah kesempatan tap tiap 3 detik jika di bawah maxtap
    setInterval(() => {
        taps = getLastTapFromStorage();
        if(taps < maxCoinValue){
            updateLastTapCoins(taps + 1, maxCoinValue);
        }
    }, 3000);


    setInterval(() => {
        if(profitPerSec > 0){
            coins = getCoinsFromStorage();
            updateCoins(coins + profitPerSec);
        }
    }, 2000);
}

init();