<?php
require('../../config.php');
require_login();

$url = new moodle_url('/local/quranmemorization/index.php');
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_quranmemorization'));
$PAGE->set_heading($SITE->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'local_quranmemorization'));

global $DB, $USER;

$progress = $DB->get_records('quranmemorization_progress', ['userid' => $USER->id]);

echo html_writer::start_tag('table', ['class' => 'generaltable']);
echo html_writer::start_tag('thead');
echo html_writer::start_tag('tr');
echo html_writer::tag('th', get_string('surah', 'local_quranmemorization'));
echo html_writer::tag('th', get_string('ayah', 'local_quranmemorization'));
echo html_writer::tag('th', get_string('memorized', 'local_quranmemorization'));
echo html_writer::end_tag('tr');
echo html_writer::end_tag('thead');
echo html_writer::start_tag('tbody');

foreach ($progress as $record) {
    echo html_writer::start_tag('tr');
    echo html_writer::tag('td', $record->surah);
    echo html_writer::tag('td', $record->ayah);
    echo html_writer::tag('td', $record->memorized ? get_string('memorized', 'local_quranmemorization') : get_string('notmemorized', 'local_quranmemorization'));
    echo html_writer::end_tag('tr');
}

echo html_writer::end_tag('tbody');
echo html_writer::end_tag('table');

$mform = new \local_quranmemorization\forms\select();

if ($mform->is_cancelled()) {
    // Handle form cancel operation, if cancel button is present on form.
} else if ($data = $mform->get_data()) {
    // In case of valid data, display the submitted data.
    echo "Surah: " . $data->surah;
    echo "Ayah: " . $data->ayah;
} else {
    // Display the form.
    $mform->display();
}

echo $OUTPUT->footer();
