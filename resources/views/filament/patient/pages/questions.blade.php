<style>
    /* Styling untuk kotak soal */
    .soal-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .soal-box {
        width: 80px;
        height: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        font-size: 1.5rem;
    }

    /* Warna untuk status jawaban */
    .jawab {
        background-color: #4ed36b; /* Hijau */
    }

    .tidak-jawab {
        background-color: #ce4a4a; /* Merah */
    }

    .belum-dijawab {
        background-color: #F6E05E; /* Kuning */
    }
</style>
<div class="mt-2 mb-2">
    <div class="soal-group">
        <!-- Daftar Soal -->
        <?php
        $totalSoal = 50; // Ubah jumlah soal sesuai kebutuhan
        $statusJawaban = array("jawab", "tidak-jawab", "belum-dijawab", "jawab", "tidak-jawab", "belum-dijawab", "jawab", "tidak-jawab", "belum-dijawab");
        for ($i = 1; $i <= $totalSoal; $i++) {
            $status = isset($statusJawaban[$i - 1]) ? $statusJawaban[$i - 1] : "belum-dijawab";
            ?>
        <div class="soal-box <?php echo $status; ?>"><?php echo $i; ?></div>
        <?php } ?>
            <!-- Akhir Daftar Soal -->
    </div>
</div>
