<?php

class WTLEP_Web_To_Lead_Elementor_Pro extends \ElementorPro\Modules\Forms\Classes\Integration_Base {
    public function get_name() {
        return 'web-to-lead';
    }

    public function get_label() {
        return __( 'Web-to-Lead', 'web-to-lead-for-elementor-pro' );
    }

    public function run( $record, $ajax_handler ) {
        $settings = $record->get( 'form_settings' );

        if ( empty( $settings['web_to_lead_org_id'] ) ) {
            return;
        }

        $raw_fields = $record->get( 'fields' );

        $fields = array( 'oid' => $settings['web_to_lead_org_id'] );
        
        foreach ( $raw_fields as $id => $field ) {
            $fields[ $id ] = $field['value'];
        }

        wp_remote_post( 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8', array(
            'body' => $fields
        ));
    }

    public function register_settings_section( $widget) {
        $widget->start_controls_section(
            'web_to_lead_settings',
            [
                'label' => __( 'Web-to-Lead', 'web-to-lead-for-elementor-pro' ),
                'condition' => [
                    'submit_actions' => $this->get_name(),
                ],
            ]
        );

        $widget->add_control(
            'web_to_lead_org_id',
            [
                'label' => __( 'Org ID', 'web-to-lead-for-elementor-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'separator' => 'before',
            ]
        );

        $widget->end_controls_section();
    }

    public function on_export( $element ) {
        unset(
            $element['web_to_lead_org_id']
        );

        return $element;
    }
}
