<div class="container">
    <table class="table caption-top mt-2">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pertandingan</th>
                <th scope="col">Tiket</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data['pagination'] as $riwayatTr) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $riwayatTr['pertandingan']; ?></td>
                    <td><?= $riwayatTr['jenis']; ?></td>
                    <td><?= $riwayatTr['tgl']; ?></td>
                    <td><?= $riwayatTr['jumlah']; ?></td>
                    <td><?= $riwayatTr['hargaTiket']; ?></td>
                    <td><?= $riwayatTr['total']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>