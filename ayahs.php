<?php
require('../../config.php');
require_login();

$surah = required_param('surah', PARAM_INT);
$ayahs = $DB->get_records_menu('quranmemorization_quran', ['surah' => $surah], '', 'ayah, ayah');

echo json_encode($ayahs);
