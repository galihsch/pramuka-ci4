<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Form Pendaftaran Peserta</h4>
                </div>
                <div class="card-body">
                    <form id="formPendaftaran" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon</label>
                                    <input type="text" class="form-control" id="telepon" name="telepon" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kab_kota" class="form-label">Kabupaten/Kota</label>
                                    <input type="text" class="form-control" id="kab_kota" name="kab_kota" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_bank" class="form-label">Nama Bank</label>
                                    <input type="text" class="form-control" id="nama_bank" name="nama_bank" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_rekening" class="form-label">Nama Rekening</label>
                                    <input type="text" class="form-control" id="nama_rekening" name="nama_rekening" required>
                                </div>
                                <div class="mb-3">
                                    <label for="no_rekening" class="form-label">Nomor Rekening</label>
                                    <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_cabang" class="form-label">ID Cabang</label>
                                    <input type="number" class="form-control" id="id_cabang" name="id_cabang" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_golongan" class="form-label">ID Golongan</label>
                                    <input type="number" class="form-control" id="id_golongan" name="id_golongan" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <a href="<?= base_url('peserta') ?>" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    $('#formPendaftaran').submit(function(e) {
        e.preventDefault();
        
        // Tampilkan loading
        Swal.fire({
            title: 'Memproses...',
            html: 'Mohon tunggu sedang menyimpan data',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: '<?= base_url('peserta/store') ?>',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '<?= base_url('peserta') ?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan!',
                        text: response.message || 'Gagal menyimpan data'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseJSON);
                let errorMessage = 'Terjadi kesalahan saat menyimpan data';
                
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.errors) {
                        let errorMsg = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMsg += value + '<br>';
                        });
                        
                        if (errorMsg) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal!',
                                html: errorMsg
                            });
                            return;
                        }
                    }
                    
                    if (xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: errorMessage
                });
            }
        });
    });
});
</script>
<?= $this->endSection() ?> 