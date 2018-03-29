<?php

/**
 * @copyright Copyright (c) 2009-2018 ThemeCatcher (http://www.themecatcher.net)
 */
class Quform_Element_Recaptcha extends Quform_Element_Field
{
    /**
     * The reCAPTCHA element has a static name
     *
     * @return string
     */
    public function getName()
    {
        return 'g-recaptcha-response';
    }

    /**
     * Get the classes for the outermost element wrapper
     *
     * @param   array  $context
     * @return  array
     */
    protected function getElementClasses(array $context = array())
    {
        $classes = parent::getElementClasses($context);

        if ($this->config('recaptchaSize') == 'invisible') {
            $classes[] = 'quform-recaptcha-size-invisible';
            $classes[] = sprintf('quform-recaptcha-badge-%s', $this->config('recaptchaBadge'));
        }

        return $classes;
    }

    /**
     * Get the HTML for the element label
     *
     * @param   array        $context
     * @param   string|bool  $forAttribute  Set the "for" attribute to the element unique ID
     * @param   bool         $id            Add a unique ID to the label
     * @return  string
     */
    protected function getLabelHtml(array $context = array(), $forAttribute = true, $id = false)
    {
        if ($this->config('recaptchaSize') == 'invisible') {
            return '';
        }

        return parent::getLabelHtml($context, false);
    }

    /**
     * Get the HTML for the element input wrapper
     *
     * @param   array   $context
     * @return  string
     */
    protected function getInputHtml(array $context = array())
    {
        $output = sprintf('<div class="%s">', Quform::escape(Quform::sanitizeClass($this->getInputClasses($context))));
        $output .= $this->getFieldHtml();
        $output .= '</div>';

        return $output;
    }

    /**
     * Get the HTML for the field
     *
     * @param   array   $context
     * @return  string
     */
    protected function getFieldHtml(array $context = array())
    {
        $output = '';

        if ( ! Quform::isNonEmptyString($this->config('recaptchaSiteKey'))) {
            $output .= esc_html__('To use reCAPTCHA you must enter the API keys on the Quform settings page.', 'quform');
        } else {
            $config = array(
                'sitekey' => $this->config('recaptchaSiteKey'),
                'size' => $this->config('recaptchaSize'),
                'type' => $this->config('recaptchaType'),
                'theme' => $this->config('recaptchaTheme'),
                'badge' => $this->config('recaptchaBadge'),
            );

            $output .= sprintf('<div class="quform-recaptcha" data-config="%s"></div>', Quform::escape(wp_json_encode($config)));

            if ($this->config('recaptchaSize') == 'invisible') {
                $output .= sprintf('<noscript>%s</noscript>', esc_html__('Please enable JavaScript to submit this form.', 'quform'));
            } else {
                $output .= '<noscript><div>';
                $output .= '<div style="width: 302px; height: 422px; position: relative;">';
                $output .= '<div style="width: 302px; height: 422px; position: absolute;">';
                $output .= sprintf('<iframe src="%s" frameborder="0" scrolling="no" style="width: 302px; height:422px; border-style: none;"></iframe>', esc_url(sprintf('https://www.google.com/recaptcha/api/fallback?k=%s', $this->config('recaptchaSiteKey'))));
                $output .= '</div></div>';
                $output .= '<div style="width: 300px; height: 60px; border-style: none; bottom: 12px; left: 25px; margin: 0px; padding: 0px; right: 25px; background: #f9f9f9; border: 1px solid #c1c1c1; border-radius: 3px;">';
                $output .= '<textarea name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;"></textarea>';
                $output .= '</div></div></noscript>';
            }

            wp_register_script('quform-recaptcha', 'https://www.google.com/recaptcha/api.js?onload=QuformRecaptchaLoaded&render=explicit&hl=' . $this->config('recaptchaLang'), array(), false, true);
        }

        return $output;
    }

    /**
     * Inherit settings from this element into the context
     *
     * @param   array  $context
     * @return  array
     */
    protected function prepareContext(array $context = array())
    {
        $context = parent::prepareContext($context);

        // Inside labels are not possible so set it above
        if ( ! in_array($context['labelPosition'], array('', 'left'), true)) {
            $context['labelPosition'] = '';
        }

        // Icon is the only possible tooltip type for this element
        $context['tooltipType'] = 'icon';

        return $context;
    }

    /**
     * Get the default element configuration
     *
     * @return array
     */
    public static function getDefaultConfig()
    {
        $config = apply_filters('quform_default_config_recaptcha', array(
            'label' => __('Are you human?', 'quform'),
            'subLabel' => '',
            'description' => '',
            'descriptionAbove' => '',
            'recaptchaSize' => 'normal',
            'recaptchaType' => 'image',
            'recaptchaTheme' => 'light',
            'recaptchaLang' => '',
            'recaptchaBadge' => 'bottomright',
            'required' => true,
            'tooltip' => '',
            'labelIcon' => '',
            'labelPosition' => 'inherit',
            'labelWidth' => '',
            'tooltipType' => 'icon',
            'tooltipEvent' => 'inherit',
            'logicEnabled' => false,
            'logicAction' => true,
            'logicMatch' => 'all',
            'logicRules' => array(),
            'messageRequired' => '',
            'messageRecaptchaMissingInputSecret' => '',
            'messageRecaptchaInvalidInputSecret' => '',
            'messageRecaptchaMissingInputResponse' => '',
            'messageRecaptchaInvalidInputResponse' => '',
            'messageRecaptchaError' => '',
            'styles' => array()
        ));

        $config['type'] = 'recaptcha';

        return $config;
    }
}
