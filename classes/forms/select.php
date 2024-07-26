<?php

namespace local_quranmemorization\forms;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class select extends \moodleform {
    public function definition() {
        global $PAGE, $DB;

        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('select_surah_ayah', 'local_quranmemorization'));

        // Fetch Surah options from the database.
        $surahs = $DB->get_records_menu('quranmemorization_quran', null, 'surah', 'surah, CONCAT(surah, " - ", surahname)');

        $mform->addElement('select', 'surah', get_string('surah', 'local_quranmemorization'), $surahs);
        $mform->addRule('surah', null, 'required', null, 'client');

        $mform->addElement('select', 'ayah', get_string('ayah', 'local_quranmemorization'), []);
        $mform->addRule('ayah', null, 'required', null, 'client');

        $this->add_action_buttons(true, get_string('submit', 'local_quranmemorization'));

        // Add JavaScript to populate Ayah dropdown based on selected Surah.
        $PAGE->requires->js_call_amd('local_quranmemorization/ayahselector', 'init');
    }

    public function validation($data, $files) {
        return array();
    }
}
