<?php
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_quranmemorization', get_string('pluginname', 'local_quranmemorization'));

    $settings->add(new admin_setting_configcheckbox(
        'local_quranmemorization/enabled',
        get_string('enabled', 'local_quranmemorization'),
        get_string('enableddesc', 'local_quranmemorization'),
        0
    ));

    $settings->add(new admin_setting_heading('local_quranmemorization_upload', get_string('upload_quran', 'local_quranmemorization'), ''));

    $settings->add(new admin_setting_configfile(
        'local_quranmemorization/quranfile',
        get_string('quranfile', 'local_quranmemorization'),
        get_string('quranfiledesc', 'local_quranmemorization'),
        ''
    ));

    // Add a link to the upload page.
    $url = new moodle_url('/local/quranmemorization/upload.php');
    $settings->add(new admin_setting_heading('local_quranmemorization_uploadlink', '', html_writer::link($url, get_string('upload_quran', 'local_quranmemorization'))));

    $ADMIN->add('localplugins', $settings);
}
