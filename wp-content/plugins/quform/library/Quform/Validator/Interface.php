<?php

/**
 * @copyright Copyright (c) 2009-2018 ThemeCatcher (http://www.themecatcher.net)
 */
interface Quform_Validator_Interface
{
    public function isValid($value);
    public static function getMessageTemplates();
    public static function getDefaultConfig();
}
