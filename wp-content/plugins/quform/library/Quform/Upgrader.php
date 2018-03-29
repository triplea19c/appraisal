<?php

/**
 * @copyright Copyright (c) 2009-2018 ThemeCatcher (http://www.themecatcher.net)
 */
class Quform_Upgrader
{
    /**
     * Check if any upgrades need to be processed
     */
    public function upgradeCheck()
    {
        if (get_option('quform_version') != QUFORM_VERSION) {
            // Trigger activation functions
            do_action('activate_' . QUFORM_BASENAME);

            // Get the fresh version as it can change during activate
            $dbVersion = get_option('quform_version');

            // Process any upgrades as required

            // Save the new DB version
            update_option('quform_version', QUFORM_VERSION);
        }
    }

    /**
     * On plugin activation save the plugin version if it doesn't already exist
     */
    public function activate()
    {
        add_option('quform_version', QUFORM_VERSION);
    }

    /**
     * On plugin uninstall remove the plugin version
     */
    public function uninstall()
    {
        delete_option('quform_version');
    }
}
