<?php

/**
 * @copyright Copyright (c) 2009-2018 ThemeCatcher (http://www.themecatcher.net)
 */
class Quform_Validator_Recaptcha extends Quform_Validator_Abstract
{
    const MISSING_INPUT_SECRET = 'recaptchaMissingInputSecret';
    const INVALID_INPUT_SECRET = 'recaptchaInvalidInputSecret';
    const MISSING_INPUT_RESPONSE = 'recaptchaMissingInputResponse';
    const INVALID_INPUT_RESPONSE = 'recaptchaInvalidInputResponse';
    const ERROR = 'recaptchaError';

    /**
     * Mapping of reCAPTCHA error codes to message template keys
     *
     * @var array
     */
    protected $errorCodes = array(
        'missing-input-secret' => self::MISSING_INPUT_SECRET,
        'invalid-input-secret' => self::INVALID_INPUT_SECRET,
        'missing-input-response' => self::MISSING_INPUT_RESPONSE,
        'invalid-input-response' => self::INVALID_INPUT_RESPONSE
    );

    /**
     * @param   string   $value  The reCAPTCHA response
     * @return  boolean          True if valid false otherwise
     */
    public function isValid($value)
    {
        $this->reset();

        $params = array(
            'secret' => $this->config('secretKey'),
            'response' => $value,
            'remoteip' => Quform::getClientIp()
        );

        $qs = http_build_query($params, '', '&');
        $response = wp_remote_get('https://www.google.com/recaptcha/api/siteverify?' . $qs);
        $response = wp_remote_retrieve_body($response);
        $response = json_decode($response, true);

        if ( ! is_array($response) || ! isset($response['success'])) {
            $this->error(self::ERROR);
            return false;
        }

        if ( ! $response['success']) {
            if (isset($response['error-codes']) && is_array($response['error-codes']) && count($response['error-codes'])) {
                foreach ($response['error-codes'] as $error) {
                    if (array_key_exists($error, $this->errorCodes)) {
                        $this->error($this->errorCodes[$error]);
                    } else {
                        $this->error(self::ERROR);
                    }

                    return false;
                }
            } else {
                $this->error(self::ERROR);
                return false;
            }
        }

        return true;
    }

    /**
     * Get all message templates or the single message with the given key
     *
     * @param   string|null   $key
     * @return  array|string
     */
    public static function getMessageTemplates($key = null)
    {
        $messageTemplates = array(
            self::MISSING_INPUT_SECRET => __('The secret parameter is missing',  'quform'),
            self::INVALID_INPUT_SECRET => __('The secret parameter is invalid or malformed',  'quform'),
            self::MISSING_INPUT_RESPONSE => __('The response parameter is missing',  'quform'),
            self::INVALID_INPUT_RESPONSE => __('The response parameter is invalid or malformed',  'quform'),
            self::ERROR => __('An error occurred, please try again',  'quform')
        );

        if (is_string($key)) {
            return array_key_exists($key, $messageTemplates) ? $messageTemplates[$key] : null;
        }

        return $messageTemplates;
    }

    /**
     * Get the default config for this validator
     *
     * @return array
     */
    public static function getDefaultConfig()
    {
        $config = apply_filters('quform_default_config_validator_recaptcha', array(
            'secretKey' => '',
            'messages' => array(
                self::MISSING_INPUT_SECRET => '',
                self::INVALID_INPUT_SECRET => '',
                self::MISSING_INPUT_RESPONSE => '',
                self::INVALID_INPUT_RESPONSE => '',
                self::ERROR => ''
            )
        ));

        $config['type'] = 'recaptcha';

        return $config;
    }
}
