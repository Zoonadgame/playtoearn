document.addEventListener("DOMContentLoaded", async function () {
    const coinCountElement = document.getElementById('coin_count');
    const maxTapCoinElement = document.getElementById('max_tap');
    const tapButton = document.getElementById('tap_button');
    const numberAdd = document.getElementById('number-add');

    let coins = 0;
    let taps = 0;
    let isSyncingTap = false; // Flag untuk sinkronisasi tap
    let isSyncingCoin = false; // Flag untuk sinkronisasi coin

    function formatNumberCoin(num) {
        const formattedCoins = new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2,
            useGrouping: true,
            thousandSeparator: ',',
            decimalSeparator: '.'
        }).format(num);

        return formattedCoins;

    }

    async function getAddCoinValue() {
        try {
            const response = await fetch('get_add_coin.php');
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return parseFloat(data.add_coin, 10);
        } catch (error) {
            console.error('Error fetching ADD_COIN value:', error);
            return 1;
        }
    }

    async function getMaxCoinValue() {
        try {
            const response = await fetch('get_add_coin.php');
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return parseFloat(data.max_coin, 10);
        } catch (error) {
            console.error('Error fetching MAX_COIN value:', error);
            return 1;
        }
    }

    async function getProfitPerOur() {
        try {
            const response = await fetch('get_profit_per_our.php');
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return parseFloat(data.coin_per_our, 10);
        } catch (error) {
            console.error('Error fetching PROFIT_PER_HOUR value:', error);
            return 0;
        }
    }

    async function getBonusCoin() {
        try {
            const response = await fetch('get_bonus_coin.php');
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return parseFloat(data.total, 10);
        } catch (error) {
            console.error('Error fetching BONUS_COIN value:', error);
            return 0;
        }
    }

    async function getSpendCoin() {
        try {
            const response = await fetch('get_spend_coin.php');
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            return parseFloat(data.total, 10);
        } catch (error) {
            console.error('Error fetching SPEND_COIN value:', error);
            return 0;
        }
    }

    function setCoinsToStorage(coins) {
        localStorage.setItem('coins', coins);
    }

    function getCoinsFromStorage() {
        const storedCoins = localStorage.getItem('coins');
        return storedCoins ? parseFloat(storedCoins, 10) : 0;
    }

    function setLastTapToStorage(lastTapCoins) {
        localStorage.setItem('last_tap', lastTapCoins);
    }

    function getLastTapFromStorage() {
        const storedLastCoins = localStorage.getItem('last_tap');
        return storedLastCoins ? parseFloat(storedLastCoins, 10) : 0;
    }

    async function updateCoins(newCoins) {
        coins = newCoins;
        const spendCoin = await getSpendCoin();
        const bonusCoin = await getBonusCoin();
        coinCountElement.textContent = formatNumberCoin((coins + bonusCoin) - spendCoin);
        setCoinsToStorage(coins);

        if (!isSyncingCoin) {
            isSyncingCoin = true;
            try {
                await fetch('update_coin_sql.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        coins
                    })
                });
            } catch (error) {
                console.error('Error updating coins:', error);
            } finally {
                isSyncingCoin = false;
            }
        }
    }

    async function updateLastTapCoins(lastTapCoins, max) {
        lastTap = lastTapCoins;
        maxTapCoinElement.textContent = formatNumberCoin(lastTap) + "/" + formatNumberCoin(max);
        setLastTapToStorage(lastTap);

        if (!isSyncingTap) {
            isSyncingTap = true;
            try {
                await fetch('update_tap_sql.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        lastTap
                    })
                });
            } catch (error) {
                console.error('Error updating taps:', error);
            } finally {
                isSyncingTap = false;
            }
        }
    }

    async function init() {
        const addCoinValue = await getAddCoinValue();
        const maxCoinValue = await getMaxCoinValue();
        const profitPerOur = await getProfitPerOur();
        const profitPerSec = profitPerOur / 3600;

        tapButton.addEventListener('click', () => {
            taps = getLastTapFromStorage();
            if (taps > 0 && taps >= addCoinValue) {
                updateLastTapCoins(taps - addCoinValue, maxCoinValue);
                coins = getCoinsFromStorage();
                updateCoins(coins + addCoinValue);

                numberAdd.textContent = "+" + addCoinValue;
                numberAdd.classList.add('animate-number');
            }
            setTimeout(() => {
                numberAdd.classList.remove('animate-number');
                numberAdd.textContent = '';
            }, 500);
        });

        taps = getLastTapFromStorage();
        updateLastTapCoins(taps, maxCoinValue);

        coins = getCoinsFromStorage();
        updateCoins(coins);

        setInterval(() => {
            taps = getLastTapFromStorage();
            if (taps < maxCoinValue) {
                updateLastTapCoins(taps + 1, maxCoinValue);
            }
        }, 3000);

        setInterval(() => {
            if (profitPerSec > 0) {
                coins = getCoinsFromStorage();
                updateCoins(coins + profitPerSec);
            }
        }, 2000);
    }

    init();
});