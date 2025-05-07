<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Daftar Peserta</h4>
                    <a href="<?= base_url('peserta/create') ?>" class="btn btn-primary">Tambah Peserta</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="tabelPeserta">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($peserta)) : ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data peserta</td>
                                </tr>
                                <?php else : ?>
                                <?php $no = 1; foreach ($peserta as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nik'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['telepon'] ?></td>
                                    <td><?= $row['alamat'] ?></td>
                                    <td>
                                        <span class="badge rounded-pill <?= $row['status_peserta'] == 'Diterima' ? 'bg-success' : ($row['status_peserta'] == 'Ditolak' ? 'bg-danger' : ($row['status_peserta'] == 'Perbaiki' ? 'bg-warning' : ($row['status_peserta'] == 'Mundur' ? 'bg-secondary' : 'bg-info'))) ?>">
                                            <?= $row['status_peserta'] ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    // Script untuk memuat data terbaru secara real-time bisa ditambahkan di sini jika diperlukan
});
</script>
<?= $this->endSection() ?> 