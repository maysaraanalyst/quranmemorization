<?php

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // Create a new settings page for the plugin.
    $settings = new admin_settingpage('local_quranmemorization', get_string('pluginname', 'local_quranmemorization'));

    // Add settings to the page. For example, a setting for default daily target:
    $settings->add(new admin_setting_configtext(
        'local_quranmemorization/defaultdailytarget',
        get_string('defaultdailytarget', 'local_quranmemorization'),
        get_string('defaultdailytarget_desc', 'local_quranmemorization'),
        '5', // Default value.
        PARAM_INT
    ));

    // Add the settings page to the admin settings tree under 'localplugins'.
    $ADMIN->add('localplugins', $settings);
}
