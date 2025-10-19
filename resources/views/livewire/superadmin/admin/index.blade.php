<div wire:poll.1000ms>
<div class="app-content">
    <div class="container-fluid">
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4 text-center">
            <p class="text-muted mb-3">Pukul</p>

            <!-- Jam Digital LED -->
            <div class="digital-clock" id="digitalClock">00:00:00</div>
        </div>
    </div>
</div>

<style>
    .digital-clock {
        font-family: 'Courier New', Courier, monospace;
        font-size: clamp(2rem, 8vw, 4rem); /* Responsif: min 2rem, max 4rem */
        font-weight: bold;
        color: #00ff00;
        background: #000;
        padding: 10px 20px;
        border-radius: 10px;
        display: inline-block;
        letter-spacing: 3px;
        box-shadow: 0 0 20px rgba(0,255,0,0.5);
        text-shadow: 
            0 0 5px #00ff00,
            0 0 10px #00ff00,
            0 0 20px #00ff00;

        /* Mengurangi flicker */
        will-change: contents;
        transform: translateZ(0);
    }

    /* Atur agar tetap rapi di layar kecil */
    @media (max-width: 576px) {
        .digital-clock {
            padding: 10px 15px;
            letter-spacing: 2px;
        }
    }

    @media (min-width: 1200px) {
        .digital-clock {
            padding: 20px 50px;
        }
    }
</style>

<script>
    function setDigitalClock() {
        const now = new Date();
        const h = now.getHours().toString().padStart(2, '0');
        const m = now.getMinutes().toString().padStart(2, '0');
        const s = now.getSeconds().toString().padStart(2, '0');

        document.getElementById('digitalClock').textContent = `${h}:${m}:${s}`;

        requestAnimationFrame(setDigitalClock);
    }

    setDigitalClock();
</script>

</div>
