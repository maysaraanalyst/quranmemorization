<?php

namespace local_quranmemorization\forms;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

class upload extends \moodleform {
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('filepicker', 'quranfile', get_string('quranfile', 'local_quranmemorization'));
        $mform->addRule('quranfile', null, 'required', null, 'client');

        $this->add_action_buttons(true, get_string('submit', 'local_quranmemorization'));
    }
}
