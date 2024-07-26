<?php
defined('MOODLE_INTERNAL') || die();

function xmldb_local_quranmemorization_install() {
    global $DB;

    // Add the manage capability to the manager role by default.
    $roleid = $DB->get_field('role', 'id', array('shortname' => 'manager'));
    if ($roleid) {
        assign_capability('local/quranmemorization:manage', CAP_ALLOW, $roleid, context_system::instance());
    }
}
