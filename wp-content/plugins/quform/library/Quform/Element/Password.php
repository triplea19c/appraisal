<?php

/**
 * @copyright Copyright (c) 2009-2018 ThemeCatcher (http://www.themecatcher.net)
 */
class Quform_Element_Password extends Quform_Element_Field implements Quform_Element_Editable
{
    /**
     * Get the HTML attributes for the field
     *
     * @param   array  $context
     * @return  array
     */
    protected function getFieldAttributes(array $context = array())
    {
        $attributes = array(
            'type' => 'password',
            'id' => $this->getUniqueId(),
            'name' => $this->getFullyQualifiedName(),
            'class' => Quform::sanitizeClass($this->getFieldClasses($context))

        );

        if ( ! $this->isEmpty()) {
            $attributes['value'] = $this->getValue();
        }

        $placeholder = $this->form->replaceVariablesPreProcess($this->config('placeholder'));
        if (Quform::isNonEmptyString($placeholder)) {
            $attributes['placeholder'] = $placeholder;
        }

        if (Quform::isNonEmptyString($this->config('maxLength'))) {
            $attributes['maxlength'] = $this->config('maxLength');
        }

        $attributes = apply_filters('quform_field_attributes', $attributes, $this, $this->form, $context);
        $attributes = apply_filters('quform_field_attributes_' . $this->getIdentifier(), $attributes, $this, $this->form, $context);

        return $attributes;
    }

    /**
     * Get the classes for the field
     *
     * @param   array  $context
     * @return  array
     */
    protected function getFieldClasses(array $context = array())
    {
        $classes = array(
            'quform-field',
            'quform-field-password',
            sprintf('quform-field-%s', $this->getIdentifier())
        );

        if ($this->form->config('tooltipsEnabled') && Quform::isNonEmptyString($this->config('tooltip')) && Quform::get($context, 'tooltipType') == 'field') {
            $classes[] = sprintf('quform-tooltip-%s', Quform::get($context, 'tooltipEvent'));
        }

        if (Quform::isNonEmptyString($this->config('customClass'))) {
            $classes[] = $this->config('customClass');
        }

        $classes = apply_filters('quform_field_classes', $classes, $this, $this->form, $context);
        $classes = apply_filters('quform_field_classes_' . $this->getIdentifier(), $classes, $this, $this->form, $context);

        return $classes;
    }

    /**
     * Get the HTML for the field
     *
     * @param   array   $context
     * @return  string
     */
    protected function getFieldHtml(array $context = array())
    {
        return Quform::getHtmlTag('input', $this->getFieldAttributes($context));
    }

    /**
     * Get the field HTML when editing
     *
     * @return string
     */
    public function getEditFieldHtml()
    {
        $attributes = $this->getFieldAttributes();
        $attributes['type'] = 'text';

        return Quform::getHtmlTag('input', $attributes);
    }

    /**
     * Render the CSS for this element
     *
     * @param   array   $context
     * @return  string
     */
    protected function renderCss(array $context = array())
    {
        $css = parent::renderCss($context);

        if ($context['fieldWidth'] == 'custom' && Quform::isNonEmptyString($context['fieldWidthCustom'])) {
            $css .= sprintf('.quform-input-password.quform-input-%s { width: %s; }', $this->getIdentifier(), Quform::addCssUnit($context['fieldWidthCustom']));
            $css .= sprintf('.quform-inner-%s > .quform-error > .quform-error-inner { float: left; min-width: %s; }', $this->getIdentifier(), Quform::addCssUnit($context['fieldWidthCustom']));
        }

        return $css;
    }

    /**
     * Get the default element configuration
     *
     * @return array
     */
    public static function getDefaultConfig()
    {
        $config = apply_filters('quform_default_config_password', array(
            'label' => __('Password', 'quform'),
            'placeholder' => '',
            'subLabel' => '',
            'description' => '',
            'descriptionAbove' => '',
            'required' => false,
            'labelIcon' => '',
            'fieldIconLeft' => '',
            'fieldIconRight' => '',
            'fieldSize' => 'inherit',
            'fieldWidth' => 'inherit',
            'fieldWidthCustom' => '',
            'customClass' => '',
            'maxLength' => '',
            'tooltip' => '',
            'fieldSize' => 'inherit',
            'adminLabel' => '',
            'labelPosition' => 'inherit',
            'labelWidth' => '',
            'tooltipType' => 'inherit',
            'tooltipEvent' => 'inherit',
            'logicEnabled' => false,
            'logicAction' => true,
            'logicMatch' => 'all',
            'logicRules' => array(),
            'messageRequired' => '',
            'messageLengthTooLong' => '',
            'styles' => array(),
            'visibility' => '',
            'validators' => array()
        ));

        $config['type'] = 'password';

        return $config;
    }
}
