<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="<?= site_url('admin/pesanan/update/' . $pesanan['id']); ?>" method="post">
                    <div class="form-group">
                        <label for="statusPesanan">Status Pesanan:</label>
                        <select class="form-control" name="status_pesanan" id="statusPesanan">
                            <option value="1" <?= $pesanan['status_pesanan'] == 1 ? 'selected' : ''; ?>>Pending</option>
                            <option value="2" <?= $pesanan['status_pesanan'] == 2 ? 'selected' : ''; ?>>Proses</option>
                            <option value="3" <?= $pesanan['status_pesanan'] == 3 ? 'selected' : ''; ?>>Dikirim</option>
                            <option value="4" <?= $pesanan['status_pesanan'] == 4 ? 'selected' : ''; ?>>Dibatalkan</option>
                            <option value="5" <?= $pesanan['status_pesanan'] == 5 ? 'selected' : ''; ?>>Diambil</option>
                            <option value="6" <?= $pesanan['status_pesanan'] == 6 ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="statusPembayaran">Status Pembayaran:</label>
                        <select class="form-control" name="status_pembayaran" id="statusPembayaran">
                            <option value="1" <?= $pesanan['status_pembayaran'] == 1 ? 'selected' : ''; ?>>Pending</option>
                            <option value="2" <?= $pesanan['status_pembayaran'] == 2 ? 'selected' : ''; ?>>Lunas</option>
                            <option value="3" <?= $pesanan['status_pembayaran'] == 3 ? 'selected' : ''; ?>>Gagal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>