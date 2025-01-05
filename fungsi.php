<?php

// Database connection
include('config.php');

// Function to get Kriteria ID based on its order
function getKriteriaID($no_urut) {
    global $koneksi;
    $query = "SELECT id FROM kriteria ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $listID = [];

    while ($row = mysqli_fetch_array($result)) {
        $listID[] = $row['id'];
    }

    return $listID[$no_urut] ?? null;
}

// Function to get Alternatif ID based on its order
function getAlternatifID($no_urut) {
    global $koneksi;
    $query = "SELECT id FROM alternatif ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $listID = [];

    while ($row = mysqli_fetch_array($result)) {
        $listID[] = $row['id'];
    }

    return $listID[$no_urut] ?? null;
}

// Function to get Kriteria name based on order
function getKriteriaNama($no_urut) {
    global $koneksi;
    $query = "SELECT nama FROM kriteria ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $nama = [];

    while ($row = mysqli_fetch_array($result)) {
        $nama[] = $row['nama'];
    }

    return $nama[$no_urut] ?? null;
}

// Function to get Alternatif name based on order
function getAlternatifNama($no_urut) {
    global $koneksi;
    $query = "SELECT nama FROM alternatif ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    $nama = [];

    while ($row = mysqli_fetch_array($result)) {
        $nama[] = $row['nama'];
    }

    return $nama[$no_urut] ?? null;
}

// Function to get Priority Vector for Alternatif
function getAlternatifPV($id_alternatif, $id_kriteria) {
    global $koneksi;
    $query = "SELECT nilai FROM pv_alternatif WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_array($result)) {
        return $row['nilai'];
    }
    
    return null;
}

// Function to get Priority Vector for Kriteria
function getKriteriaPV($id_kriteria) {
    global $koneksi;
    $query = "SELECT nilai FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_array($result)) {
        return $row['nilai'];
    }

    return null;
}

// Function to get the number of Alternatif
function getJumlahAlternatif() {
    global $koneksi;
    $query = "SELECT count(*) FROM alternatif";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_array($result)) {
        return $row[0];
    }

    return 0;
}

// Function to get the number of Kriteria
function getJumlahKriteria() {
    global $koneksi;
    $query = "SELECT count(*) FROM kriteria";
    $result = mysqli_query($koneksi, $query);

    if ($row = mysqli_fetch_array($result)) {
        return $row[0];
    }

    return 0;
}

// Function to add data to a table (Kriteria / Alternatif)
function tambahData($tabel, $nama) {
    global $koneksi;
    $query = "INSERT INTO $tabel (nama) VALUES ('$nama')";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Gagal menambah data $tabel";
        exit();
    }
}

// Function to delete Kriteria by ID
function deleteKriteria($id) {
    global $koneksi;
    $queries = [
        "DELETE FROM kriteria WHERE id=$id",
        "DELETE FROM pv_kriteria WHERE id_kriteria=$id",
        "DELETE FROM pv_alternatif WHERE id_kriteria=$id",
        "DELETE FROM perbandingan_kriteria WHERE kriteria1=$id OR kriteria2=$id",
        "DELETE FROM perbandingan_alternatif WHERE pembanding=$id"
    ];

    foreach ($queries as $query) {
        if (!mysqli_query($koneksi, $query)) {
            echo "Error deleting Kriteria";
            exit();
        }
    }
}

// Function to delete Alternatif by ID
function deleteAlternatif($id) {
    global $koneksi;
    $queries = [
        "DELETE FROM alternatif WHERE id=$id",
        "DELETE FROM pv_alternatif WHERE id_alternatif=$id",
        "DELETE FROM ranking WHERE id_alternatif=$id",
        "DELETE FROM perbandingan_alternatif WHERE alternatif1=$id OR alternatif2=$id"
    ];

    foreach ($queries as $query) {
        if (!mysqli_query($koneksi, $query)) {
            echo "Error deleting Alternatif";
            exit();
        }
    }
}

// Function to input or update Priority Vector for Kriteria
function inputKriteriaPV($id_kriteria, $pv) {
    global $koneksi;
    $query = "SELECT * FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO pv_kriteria (id_kriteria, nilai) VALUES ($id_kriteria, $pv)";
    } else {
        $query = "UPDATE pv_kriteria SET nilai=$pv WHERE id_kriteria=$id_kriteria";
    }

    if (!mysqli_query($koneksi, $query)) {
        echo "Gagal memasukkan / update nilai priority vector kriteria";
        exit();
    }
}

// Function to input or update Priority Vector for Alternatif
function inputAlternatifPV($id_alternatif, $id_kriteria, $pv) {
    global $koneksi;
    $query = "SELECT * FROM pv_alternatif WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO pv_alternatif (id_alternatif, id_kriteria, nilai) VALUES ($id_alternatif, $id_kriteria, $pv)";
    } else {
        $query = "UPDATE pv_alternatif SET nilai=$pv WHERE id_alternatif=$id_alternatif AND id_kriteria=$id_kriteria";
    }

    if (!mysqli_query($koneksi, $query)) {
        echo "Gagal memasukkan / update nilai priority vector alternatif";
        exit();
    }
}

// Function to input or update Comparison Data for Kriteria
function inputDataPerbandinganKriteria($kriteria1, $kriteria2, $nilai, $per) {
    global $koneksi;
    $id_kriteria1 = getKriteriaID($kriteria1);
    $id_kriteria2 = getKriteriaID($kriteria2);

    $query = "SELECT * FROM perbandingan_kriteria WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO perbandingan_kriteria (kriteria1, kriteria2, nilai, per) VALUES ($id_kriteria1, $id_kriteria2, $nilai, $per)";
    } else {
        $query = "UPDATE perbandingan_kriteria SET nilai=$nilai, per=$per WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
    }

    if (!mysqli_query($koneksi, $query)) {
        echo "Gagal memasukkan data perbandingan";
        exit();
    }
}

// Function to input or update Comparison Data for Alternatif
function inputDataPerbandinganAlternatif($alternatif1, $alternatif2, $pembanding, $nilai) {
    global $koneksi;
    $id_alternatif1 = getAlternatifID($alternatif1);
    $id_alternatif2 = getAlternatifID($alternatif2);
    $id_pembanding = getKriteriaID($pembanding);

    $query = "SELECT * FROM perbandingan_alternatif WHERE alternatif1=$id_alternatif1 AND alternatif2=$id_alternatif2 AND pembanding=$id_pembanding";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) == 0) {
        $query = "INSERT INTO perbandingan_alternatif (alternatif1, alternatif2, pembanding, nilai) VALUES ($id_alternatif1, $id_alternatif2, $id_pembanding, $nilai)";
    } else {
        $query = "UPDATE perbandingan_alternatif SET nilai=$nilai WHERE alternatif1=$id_alternatif1 AND alternatif2=$id_alternatif2 AND pembanding=$id_pembanding";
    }

    if (!mysqli_query($koneksi, $query)) {
        echo "Gagal memasukkan data perbandingan alternatif";
        exit();
    }
}

// Function to get Comparison Weight for Kriteria
function getNilaiPerbandinganKriteria($kriteria1, $kriteria2) {
    global $koneksi;
    $id_kriteria1 = getKriteriaID($kriteria1);
    $id_kriteria2 = getKriteriaID($kriteria2);
    $query = "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error retrieving comparison data";
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        return 1;
    }

    $row = mysqli_fetch_array($result);
    return $row['nilai'];
}

// Function to get Comparison Weight for Alternatif
function getNilaiPerbandinganAlternatif($alternatif1, $alternatif2, $pembanding) {
    global $koneksi;
    $id_alternatif1 = getAlternatifID($alternatif1);
    $id_alternatif2 = getAlternatifID($alternatif2);
    $id_pembanding = getKriteriaID($pembanding);
    $query = "SELECT nilai FROM perbandingan_alternatif WHERE alternatif1=$id_alternatif1 AND alternatif2=$id_alternatif2 AND pembanding=$id_pembanding";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        echo "Error retrieving comparison data";
        exit();
    }

    if (mysqli_num_rows($result) == 0) {
        return 1;
    }

    $row = mysqli_fetch_array($result);
    return $row['nilai'];
}

// menampilkan nilai IR
function getNilaiIR($jmlKriteria) {
    include('config.php');
    $query  = "SELECT nilai FROM ir WHERE jumlah=$jmlKriteria";
    $result = mysqli_query($koneksi, $query);
    while ($row = mysqli_fetch_array($result)) {
        $nilaiIR = $row['nilai'];
    }

    return $nilaiIR;
}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrik_a, $matrik_b, $n) {
    $eigenvektor = 0;
    for ($i = 0; $i <= ($n - 1); $i++) {
        $eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
    }

    return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrik_a, $matrik_b, $n) {
    $eigenvektor = getEigenVector($matrik_a, $matrik_b, $n);
    $consindex = ($eigenvektor - $n) / ($n - 1);

    return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrik_a, $matrik_b, $n) {
    $consindex = getConsIndex($matrik_a, $matrik_b, $n);
    $consratio = $consindex / getNilaiIR($n);

    return $consratio;
}

// menampilkan tabel perbandingan bobot
// menampilkan tabel perbandingan bobot
function showTabelPerbandingan($jenis, $kriteria) {
    include('config.php');

    if ($kriteria == 'kriteria') {
        $n = getJumlahKriteria();
    } else {
        $n = getJumlahAlternatif();
    }

    $query = "SELECT nama FROM $kriteria ORDER BY id";
    $result = mysqli_query($koneksi, $query);
    if (!$result) {
        echo "Error koneksi database!!!";
        exit();
    }

    // buat list nama pilihan
    while ($row = mysqli_fetch_array($result)) {
        $pilihan[] = $row['nama'];
    }

    // tampilkan tabel
    ?>

    <form class="ui form" action="proses.php" method="post">
        <table class="ui celled selectable collapsing table">
            <thead>
                <tr>
                    <th colspan="2">Pilih yang lebih penting</th>
                    <th>Nilai Perbandingan</th>
                    <th>Nilai Per (Kolom 'per')</th>
                </tr>
            </thead>
            <tbody>

    <?php

    // inisialisasi
    $urut = 0;

    for ($x = 0; $x <= ($n - 2); $x++) {
        for ($y = ($x + 1); $y <= ($n - 1); $y++) {

            $urut++;

    ?>
                <tr>
                    <td>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input name="pilih<?php echo $urut ?>" value="1" checked="" class="hidden" type="radio">
                                <label><?php echo $pilihan[$x]; ?></label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input name="pilih<?php echo $urut ?>" value="2" class="hidden" type="radio">
                                <label><?php echo $pilihan[$y]; ?></label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="field">
    <?php
            if ($kriteria == 'kriteria') {
                $nilai = getNilaiPerbandinganKriteria($x, $y);
            } else {
                $nilai = getNilaiPerbandinganAlternatif($x, $y, ($jenis - 1));
            }
    ?>
                            <input type="number" name="bobot<?php echo $urut ?>" value="<?php echo $nilai ?>" max="10" step="0.01" required>
                        </div>
                    </td>
                    <td>
                        <div class="field">
                            <input type="number" name="per<?php echo $urut ?>" value="<?php echo $per?>" placeholder="Masukkan nilai per" step="0.01" required>
                        </div>
                    </td>
                </tr>
    <?php
        }
    }

    ?>
            </tbody>
        </table>
        <input type="text" name="jenis" value="<?php echo $jenis; ?>" hidden>
        <br><br><input class="ui submit button" type="submit" name="submit" value="SUBMIT" style="margin-left: 50%; position: absolute; margin-top: -30px;">
    </form>

    <?php
}
?>

