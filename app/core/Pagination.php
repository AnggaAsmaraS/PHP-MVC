<?php


class Pagination
{





    public function setPagination($query, $jumlahDataPerhalaman, $halamanAktif, $url)
    {

        $jumlahData = count($query); //menghitung jumlah data yang ada di database berdasarkan id user
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman); //menghitung untuk jumlah halaman

        $mulaiPagination = 1;
        $batasPagination = 3;
        $batasPosisiNomor = 2;
        $batasAkhirPagination = $jumlahHalaman;


        echo '<ul class="pagination justify-content-center">';
        //$url[0] = halaman
        //$url[1] = 1

        //apabila $url[1] lebih dari 3 maka menampilkan tombol previous
        if ($url[1] > 3) {
            $prev = $halamanAktif - 1;
            echo "<li class='page-item'>
            <a class='page-link' href='" . BASEURL . "/user/riwayatTransaksi/halaman=$prev'>Previous</a>
        </li>";
        }

        if ($jumlahHalaman >= $batasPagination) {

            if ($halamanAktif > $batasPosisiNomor) {
                $mulaiPagination = $halamanAktif - ($batasPagination - 1);
            }
        }

        $batasAkhirPagination = ($mulaiPagination - 1) + $batasPagination;

        if ($batasAkhirPagination > $jumlahHalaman) {
            $batasAkhirPagination = $jumlahHalaman;
        }

        for ($i = $mulaiPagination; $i <= $batasAkhirPagination; $i++) {
            if ($halamanAktif == $i) {
                echo "<li class='active page-item'><a class='page-link' href='" . BASEURL . "/user/riwayatTransaksi/halaman=$i'>$i</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='" . BASEURL . "/user/riwayatTransaksi/halaman=$i'>$i</a></li>";
            }
        }

        $next = $halamanAktif + 1;
        if ($halamanAktif < $jumlahHalaman) {
            echo "</li>
            <li class='page-item'>
                <a class='page-link' href='" . BASEURL . "/user/riwayatTransaksi/halaman=$next'>Next</a>
            </li>";
        }
        echo "  </ul> ";
    }
}
