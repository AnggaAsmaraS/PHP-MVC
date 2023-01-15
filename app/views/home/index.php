<div class="container">
    <table class="table caption-top mt-2">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pertandingan</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data['jadwal'] as $jadwal) : ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $jadwal['pertandingan']; ?></td>
                    <td><?= $jadwal['tgl']; ?></td>
                    <td><a href="<?= BASEURL ?>/user/beliTiket/<?= $jadwal['id_jadwal']; ?>" class="btn btn-outline-primary">Beli Tiket</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>