<?php
require('../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php');

require_login();
$context = context_system::instance();
require_capability('local/quranmemorization:manage', $context);

admin_externalpage_setup('local_quranmemorization');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quranfile']) && $_FILES['quranfile']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['quranfile']['tmp_name'];
    $handle = fopen($file, 'r');

    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            list($surah, $ayah, $text) = explode('|', $line);
            $record = new stdClass();
            $record->surah = (int)trim($surah);
            $record->ayah = (int)trim($ayah);
            $record->text = trim($text);

            if (!$DB->record_exists('quranmemorization_quran', array('surah' => $record->surah, 'ayah' => $record->ayah))) {
                $DB->insert_record('quranmemorization_quran', $record);
            }
        }
        fclose($handle);
        redirect(new moodle_url('/admin/settings.php', array('section' => 'local_quranmemorization')), get_string('success', 'local_quranmemorization'), null, \core\output\notification::NOTIFY_SUCCESS);
    } else {
        print_error('fileopenfail', 'local_quranmemorization');
    }
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('upload_quran', 'local_quranmemorization'));

$mform = new \local_quranmemorization\forms\upload();
$mform->display();

echo $OUTPUT->footer();
