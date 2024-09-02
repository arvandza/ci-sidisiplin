<script>
    $(document).ready(function() {
    $('#search_siswa').on('keyup', function() {
        var query = $(this).val();
        if (query.length > 2) {
            $.ajax({
                url: '<?= base_url('kelas/cari_siswa'); ?>',
                method: 'GET',
                data: { query: query },
                success: function(data) {
                    var result = JSON.parse(data);
                    $('#result_list').empty();
                    result.forEach(function(item) {
                        $('#result_list').append('<div class="result-item" data-id="'+item.id_siswa+'" data-name="'+item.nama_siswa+'">'+item.nama_siswa+'</div>');
                    });
                }
            });
        } else {
            $('#result_list').empty();
        }
    });

    $(document).on('click', '.result-item', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        if (!$('#selected_siswa input[value="'+id+'"]').length) { // Cek duplikasi
            $('#selected_siswa').append('<li class="list-group-item" data-id="'+id+'">'+name+' <span class="remove-siswa btn btn-danger btn-sm float-right">Remove</span></li>');
            $('#selected_siswa').append('<input type="hidden" name="id_siswas[]" value="'+id+'">');
        }
    });

    $(document).on('click', '.remove-siswa', function() {
        var listItem = $(this).parent();
        var id = listItem.data('id');
        listItem.remove();
        $('input[name="id_siswas[]"][value="'+id+'"]').remove();
    });

    $('form').on('submit', function(e) {
        var selectedSiswa = $('input[name="id_siswas[]"]').length;
        if (selectedSiswa === 0) {
            e.preventDefault();
            alert('Silakan pilih minimal satu siswa untuk ditambahkan ke kelas.');
        }
    });
});

</script>