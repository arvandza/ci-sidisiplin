<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <!-- Modal Header -->
    <div class="modal-header">
      <h4 class="modal-title">Edit Jadwal</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <!-- Modal body -->
    <div class="modal-body">
      <form id="formEditJadwal">
        <input type="hidden" id="id_jadwal" value="<?php echo $jadwal['id_jadwal']; ?>">

        <div class="form-group">
          <label for="id_kelas">Kelas:</label>
          <select class="form-control" id="id_kelas" name="id_kelas">
            <?php foreach($ruang_belajar as $k): ?>
              <option value="<?php echo $k['id_ruang_belajar']; ?>" <?php echo ($k['id_ruang_belajar'] == $jadwal['id_ruang_belajar']) ? 'selected' : ''; ?>>
                <?php echo $k['kode_ruang_belajar']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="mata_pelajaran">Mata Pelajaran:</label>
          <select class="form-control" id="mata_pelajaran" name="mata_pelajaran">
            <?php foreach($mata_pelajaran as $mp): ?>
              <option value="<?php echo $mp['id_mata_pelajaran']; ?>" <?php echo ($mp['id_mata_pelajaran'] == $jadwal['id_mata_pelajaran']) ? 'selected' : ''; ?>>
                <?php echo $mp['nama_mapel']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="id_guru">Guru:</label>
          <select class="form-control" id="id_guru" name="id_guru">
            <?php foreach($guru as $g): ?>
              <option value="<?php echo $g['id_guru']; ?>" <?php echo ($g['id_guru'] == $jadwal['id_guru']) ? 'selected' : ''; ?>>
                <?php echo $g['nama']; ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="hari">Hari:</label>
          <select class="form-control" id="hari" name="hari">
            <option value="Senin" <?php echo ($jadwal['hari'] == 'Senin') ? 'selected' : ''; ?>>Senin</option>
            <option value="Selasa" <?php echo ($jadwal['hari'] == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
            <option value="Rabu" <?php echo ($jadwal['hari'] == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
            <option value="Kamis" <?php echo ($jadwal['hari'] == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
            <option value="Jumat" <?php echo ($jadwal['hari'] == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
            <option value="Sabtu" <?php echo ($jadwal['hari'] == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
            <option value="Minggu" <?php echo ($jadwal['hari'] == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
          </select>
        </div>

        <div class="form-group">
          <label for="jam_mulai">Jam Mulai:</label>
          <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?php echo $jadwal['waktu_mulai']; ?>">
        </div>

        <div class="form-group">
          <label for="jam_selesai">Jam Selesai:</label>
          <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="<?php echo $jadwal['waktu_selesai']; ?>">
        </div>
      </form>
    </div>
    <!-- Modal footer -->
    <div class="modal-footer">
      <button type="button" class="btn btn-success" id="btnEdit"
              data-id_jadwal="<?php echo $jadwal['id_jadwal']; ?>">Ubah</button>
      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
