<?php
defined('MOODLE_INTERNAL') || die();

$capabilities = array(

    'local/quranmemorization:manage' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        ),
        'riskbitmask' => RISK_CONFIG,
    ),

    'local/quranmemorization:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'archetypes' => array(
            'guest' => CAP_PREVENT,
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW,
        ),
    ),
);
