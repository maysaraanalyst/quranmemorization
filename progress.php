<?php
require('../../config.php');
require_login();

$url = new moodle_url('/local/quranmemorization/progress.php');
$PAGE->set_url($url);
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('progress', 'local_quranmemorization'));
$PAGE->set_heading($SITE->fullname);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('progress', 'local_quranmemorization'));

global $DB, $USER;

$progress = $DB->get_records('quranmemorization_progress', ['userid' => $USER->id]);
$total = $DB->count_records('quranmemorization_quran');
$completed = count(array_filter($progress, function($record) {
    return $record->memorized == 1;
}));

$completion_rate = ($completed / $total) * 100;

echo html_writer::tag('p', get_string('completion_rate', 'local_quranmemorization') . ': ' . round($completion_rate, 2) . '%');

echo $OUTPUT->footer();
