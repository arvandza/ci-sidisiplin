<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Jadwal</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
         <div class="modal-body">
                    <div class="form-group">
                        <label for="id_kelas">Pilih Kelas</label>
                        <select name="id_kelas" id="id_kelas" class="form-control">
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k->id_ruang_belajar; ?>"><?= $k->kode_ruang_belajar; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_guru">Pilih Guru</label>
                        <select name="id_guru" id="id_guru" class="form-control">
                            <?php foreach ($guru as $g): ?>
                                <option value="<?= $g->id_guru; ?>"><?= $g->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hari">Hari</label>
                        <select name="hari" id="hari" class="form-control">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_mulai">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_selesai">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mata_pelajaran">Mata Pelajaran</label>
                        <select name="mata_pelajaran" id="mata_pelajaran" class="form-control" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            <?php foreach ($mata_pelajaran as $mp): ?>
                                <option value="<?= $mp->id_mata_pelajaran; ?>"><?= $mp->nama_mapel; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnTambah">Tambah</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>
         </div>
    </div>
</div>