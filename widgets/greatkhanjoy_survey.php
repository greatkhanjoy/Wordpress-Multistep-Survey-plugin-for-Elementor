<?php
require_once(plugin_dir_path(__FILE__) . '/inc/generateSurveyHTML.php');
class Elementor_Greatkhanjoy_Survey extends \Elementor\Widget_Base
{
    public function __construct($data = [], $args = null)
    {
        $this->textdomain = 'gsurvey';
        parent::__construct($data, $args);
    }



    public function get_script_depends()
    {
        return ['gsurvey-script'];
    }

    public function get_style_depends()
    {
        return ['gsurvey-style'];
    }

    public function get_name()
    {
        return 'greatkhanjoy_survey';
    }

    public function get_title()
    {
        return esc_html__('Survey', 'greatkhanjoy-survey-el');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['survey', 'greatkhanjoy'];
    }

    protected function register_controls()
    {

        // Title Tab Start

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', $this->textdomain),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', $this->textdomain),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Survey', $this->textdomain),
            ]
        );

        $this->end_controls_section();

        // Title Tab End

        //Question Section start
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Question Section', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'question_list',
            [
                'label' => esc_html__(
                    'Questions',
                    'textdomain'
                ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'question',
                        'label' => esc_html__('Question', $this->textdomain),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => esc_html__('How did you hear about our company?', $this->textdomain),
                        'default' => esc_html__('How did you hear about our company?', $this->textdomain),
                    ],
                    [
                        'name' => 'question_type',
                        'label' => esc_html__('Question Type', $this->textdomain),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'radio' => esc_html__('Radio', $this->textdomain),
                            'checkbox' => esc_html__('Checkbox', $this->textdomain),
                            'text' => esc_html__('Text', $this->textdomain),
                        ],
                        'default' => 'radio',
                    ],
                    [
                        'name' => 'multiple_answer',
                        'label' => esc_html__('Allow Multiple Answer?', $this->textdomain),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'return_value' => 'yes',
                        'condition' => [
                            'question_type' => ['checkbox'],
                        ],
                    ],
                    [
                        'name' => 'options',
                        'label' => esc_html__('Options', $this->textdomain),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'fields' => [
                            [
                                'name' => 'option',
                                'label' => esc_html__('Option', $this->textdomain),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'placeholder' => esc_html__('Example Question', $this->textdomain),
                                'default' => esc_html__('Example Question', $this->textdomain),
                            ],
                        ],
                        'default' => [
                            [
                                'option' => esc_html__('Option 1', $this->textdomain),
                            ],
                            [
                                'option' => esc_html__('Option 2', $this->textdomain),
                            ],
                        ],
                        "title_field" => "{{{ option }}}",
                    ]
                ],

                'title_field' => '{{{ question }}}',
            ]
        );

        $this->end_controls_section();

        // Content Tab End


        // Style Tab Start

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', $this->textdomain),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', $this->textdomain),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (\Elementor\Plugin::instance()->editor->is_edit_mode()) {
            // Output content for the editor
            return generateSurveyHTML($settings);
        } else {
?>
            <div class="greatkhanjoy-survey-elementor greatkhanjoy-survey-use w-full">
                <pre style="display:none;"><?php echo wp_json_encode($settings) ?></pre>
            </div>
<?php
        }
    }
}
