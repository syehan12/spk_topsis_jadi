<?php 

include('config.php');
include('fungsi.php');

if (isset($_POST['submit'])) {
    $jenis = $_POST['jenis'];

    // jumlah kriteria
    if ($jenis == 'kriteria') {
        $n = getJumlahKriteria();
    } else {
        $n = getJumlahAlternatif();
    }

    // memetakan nilai ke dalam bentuk matrik
    $matrik = array();
    $urut = 0;

    for ($x = 0; $x <= ($n - 2); $x++) {
        for ($y = ($x + 1); $y <= ($n - 1); $y++) {
            $urut++;
            $pilih = "pilih" . $urut;
            $bobot = "bobot" . $urut;
            $per = "per" . $urut;

            // Ambil nilai 'per' dari form input
            $nilai_per = $_POST[$per]; // Mengambil nilai 'per' dari input form

            if ($_POST[$pilih] == 1) {
                $matrik[$x][$y] = $_POST[$bobot];
                $matrik[$y][$x] = $nilai_per; // Menggunakan nilai dari kolom 'per'
            } else {
                $matrik[$x][$y] = $nilai_per; // Menggunakan nilai dari kolom 'per'
                $matrik[$y][$x] = $_POST[$bobot];
            }

            // Input data perbandingan berdasarkan jenis (kriteria atau alternatif)
            if ($jenis == 'kriteria') {
                inputDataPerbandinganKriteria($x, $y, $matrik[$x][$y], $nilai_per);
            } else {
                inputDataPerbandinganAlternatif($x, $y, ($jenis - 1), $matrik[$x][$y]);
            }
        }
    }

    // diagonal --> bernilai 1
    for ($i = 0; $i <= ($n - 1); $i++) {
        $matrik[$i][$i] = 1;
    }

    // inisialisasi jumlah tiap kolom dan baris kriteria
    $jmlmpb = array();
    $jmlmnk = array();
    for ($i = 0; $i <= ($n - 1); $i++) {
        $jmlmpb[$i] = 0;
        $jmlmnk[$i] = 0;
    }

    // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
    for ($x = 0; $x <= ($n - 1); $x++) {
        for ($y = 0; $y <= ($n - 1); $y++) {
            $value = $matrik[$x][$y];
            $jmlmpb[$y] += $value;
        }
    }

    // menghitung jumlah pada baris kriteria tabel nilai kriteria
    for ($x = 0; $x <= ($n - 1); $x++) {
        for ($y = 0; $y <= ($n - 1); $y++) {
            $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
            $value = $matrikb[$x][$y];
            $jmlmnk[$x] += $value;
        }

        // nilai priority vektor
        $pv[$x] = $jmlmnk[$x] / $n;

        // memasukkan nilai priority vektor ke dalam tabel
        if ($jenis == 'kriteria') {
            $id_kriteria = getKriteriaID($x);
            inputKriteriaPV($id_kriteria, $pv[$x]);
        } else {
            $id_kriteria = getKriteriaID($jenis - 1);
            $id_alternatif = getAlternatifID($x);
            inputAlternatifPV($id_alternatif, $id_kriteria, $pv[$x]);
        }
    }

    // cek konsistensi
    $eigenvektor = getEigenVector($jmlmpb, $jmlmnk, $n);
    $consIndex = getConsIndex($jmlmpb, $jmlmnk, $n);
    $consRatio = getConsRatio($jmlmpb, $jmlmnk, $n);

    if ($jenis == 'kriteria') {
        include('output.php');
    } else {
        include('bobot_hasil.php');
    }
}

// Fungsi untuk mendapatkan nilai 'per' berdasarkan id
function getNilaiPer($id_per) {
    global $conn; // Gunakan koneksi database
    $query = "SELECT per FROM perbandingan_kriteria WHERE id = $id_per LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['per'];
    } else {
        return 1; // Default jika tidak ada nilai
    }
}
?>
