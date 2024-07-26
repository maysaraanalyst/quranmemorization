define(['jquery'], function($) {
    return {
        init: function() {
            $('#id_surah').change(function() {
                var surah = $(this).val();
                if (surah) {
                    $.ajax({
                        url: M.cfg.wwwroot + '/local/quranmemorization/ayahs.php',
                        data: { surah: surah },
                        success: function(data) {
                            var ayahSelect = $('#id_ayah');
                            ayahSelect.empty();
                            $.each(data, function(key, value) {
                                ayahSelect.append($('<option></option>').attr('value', key).text(value));
                            });
                        }
                    });
                }
            });
        }
    };
});
