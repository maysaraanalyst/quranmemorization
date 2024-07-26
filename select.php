<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/quranmemorization/classes/forms/select.php');

global $DB, $USER, $PAGE, $OUTPUT;

require_login();
$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url(new moodle_url('/local/quranmemorization/select.php'));
$PAGE->set_title(get_string('select_surah_ayah', 'local_quranmemorization'));
$PAGE->set_heading(get_string('select_surah_ayah', 'local_quranmemorization'));

$mform = new \local_quranmemorization\forms\select();

if ($mform->is_cancelled()) {
    redirect(new moodle_url('/local/quranmemorization/index.php'));
} else if ($data = $mform->get_data()) {
    // Save the selected Surah and Ayah to the progress table.
    $record = new stdClass();
    $record->userid = $USER->id;
    $record->surah = $data->surah;
    $record->ayah = $data->ayah;
    $record->memorized = 0;
    $record->score = 0;

    $DB->insert_record('quranmemorization_progress', $record);

    redirect(new moodle_url('/local_quranmemorization/progress.php'));
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
