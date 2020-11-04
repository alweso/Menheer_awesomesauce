<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostListWithNumbers extends Widget_Base {

  /**
  * Retrieve the widget name.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return string Widget name.
  */
  public function get_name() {
    return 'post-list-with-numbers';
  }

  /**
  * Retrieve the widget title.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return string Widget title.
  */
  public function get_title() {
    return __( 'Post List with Numbers', 'elementor-post-list-with-numbers' );
  }

  /**
  * Retrieve the widget icon.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return string Widget icon.
  */
  public function get_icon() {
    return 'fa fa-pencil';
  }

  /**
  * Retrieve the list of categories the widget belongs to.
  *
  * Used to determine where to display the widget in the editor.
  *
  * Note that currently Elementor supports only one category.
  * When multiple categories passed, Elementor uses the first one.
  *
  * @since 1.1.0
  *
  * @access public
  *
  * @return array Widget categories.
  */
  public function get_categories() {
		return ['general', 'test-category'];
	}

  /**
  * Register the widget controls.
  *
  * Adds different input fields to allow the user to change and customize the widget settings.
  *
  * @since 1.1.0
  *
  * @access protected
  */
  protected function _register_controls() {
    $this->start_controls_section(
      'section_content',
      [
        'label' => __( 'Content', 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'show_title',
      [
        'label' => esc_html__('Show title', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'title',
      [
        'label' => __( 'Title', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::TEXT,
        'default' => __( 'Post list', 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'post_title_crop',
      [
        'label'         => esc_html__( 'Post Title limit', 'elementor_awesomesauce' ),
        'type'          => Controls_Manager::NUMBER,
        'default' => '35',

      ]
    );


    $this->add_control(
      'order_by',
      [
        'label' => __( 'Show', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'meta_value_num', 'elementor-awesomesauce' ),
        'options' => [
          'comment_count'  => __( 'Most commented', 'elementor-awesomesauce' ),
          'meta_value_num'  => __( 'Most read', 'elementor-awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
      'post_count',
      [
        'label' => __( 'Post count', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::NUMBER,
        'default' => __( 5, 'elementor-awesomesauce' ),
      ]
    );

    $this->add_control(
      'show_date',
      [
        'label' => esc_html__('Show Date', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'yes',
      ]
    );

    $this->add_control(
      'show_cat',
      [
        'label' => esc_html__('Show Category', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'yes',
      ]
    );
    $this->add_control(
      'show_views',
      [
        'label' => esc_html__('Show views', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'no',
      ]
    );
    $this->add_control(
      'show_comments',
      [
        'label' => esc_html__('Show comments', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'no',
      ]
    );

    $this->end_controls_section();

    $this->start_controls_section(
      'general_style_settings',
      [
        'label' => __( 'General settings', 'elementor-awesomesauce' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );



                $this->add_control(
                  'big_typo_section',
                  [
                    'label' => __( 'Typography', 'plugin-name' ),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                  ]
                );

                $this->add_group_control(
                  \Elementor\Group_Control_Typography::get_type(),
                  [
                    'label' => __( 'Title typography', '' ),
                    'name' => 'big_title_typography',
                    'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title',
                  ]
                );

                $this->add_control(
                  'big_title_color_1',
                  [
                    'label' => __( 'Title color', '' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                      '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'color: {{VALUE}}',
                    ],
                  ]
                );

                $this->add_group_control(
                  \Elementor\Group_Control_Typography::get_type(),
                  [
                    'label' => __( 'Description typography', '' ),
                    'name' => 'big_desc_typography',
                    'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description',
                  ]
                );


                $this->add_control(
                  'big_description_color_2',
                  [
                    'label' => __( 'Description color', '' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#000000',
                    'selectors' => [
                      '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner p' => 'color: {{VALUE}}',
                    ],
                  ]
                );

                $this->add_group_control(
                  \Elementor\Group_Control_Typography::get_type(),
                  [
                    'label' => __( 'Big details typography', '' ),
                    'name' => 'big_details_typography',
                    'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span',
                  ]
                );

                $this->add_control(
                  'big_details_color_2',
                  [
                    'label' => __( 'details color', '' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'default' => '#989898',
                    'selectors' => [
                      '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner .comments-views-date span' => 'color: {{VALUE}}',
                    ],
                  ]
                );

    $this->add_control(
      'big_thumbnail_border',
      [
        'label' => __( 'Thumbnail border', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::HEADING,
      ]
    );


    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'big_thumb_border',
        'fields_options' => [
          'border' => ['default' => 'none'],
          'width' => [
            'default' => [
              'top' => 0,
              'right' => 0,
              'bottom' => 0,
              'left' => 0,
              'unit'=> 'px',
              'isLinked' => true,
            ],
          ],
          'color' => ['default' => '#FFFFFF'],
        ],
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper .thumbnail',
      ]
    );

    $this->add_control(
      'item_border',
      [
        'label' => __( 'Item border', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Border::get_type(),
      [
        'name' => 'big_itemborder',
        'fields_options' => [
      'width' => [
        'default' => [
          'top' => 1,
          'right' => 1,
          'bottom' => 1,
          'left' => 1,
          'unit'=> 'px',
          'isLinked' => true,
        ],
      ],
      'color' => ['default' => '#000'],
    ],
        'selector' => '{{WRAPPER}} .awesomesauce-post-block .wrapper',
      ]
    );

    $this->add_control(
      'thumbnail_settings',
      [
        'label' => __( 'Thumbnail settings', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );


    $this->add_control(
      'thumbnail_width',
      [
        'label' => __( 'Thumbnail width', 'elementor-awesomesauce' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => [ 'fr'],
        'range' => [
          'fr' => [
            'min' => 10,
            'max' => 50,
            'step' => 1,
          ],
        ],
        'default' => [
          'unit' => 'fr',
          'size' => 33,
        ],
        'selectors' => [
          '{{WRAPPER}} .wrapper--big' => 'grid-template-columns: {{SIZE}}{{UNIT}} 66fr;',
        ],
      ]
    );

    $this->add_control(
      'background',
      [
        'label' => __( 'Background', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before'
      ]
    );


                        $this->add_control(
                          'grid_item_color',
                          [
                            'label' => __( 'Grid item background color', '' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => 'rgba(255,255,255,0)',
                            'selectors' => [
                              '{{WRAPPER}} .awesomesauce-post-block .wrapper' => 'background-color: {{VALUE}}',
                            ],
                          ]
                        );




        $this->add_control(
          'paddings',
          [
            'label' => __( 'Paddings', 'elementor_awesomesauce' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
          ]
        );


    $this->add_responsive_control(
      'big_grid_item_padding',
      [
        'label' =>esc_html__( 'Big Grid item padding', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => [ 'px'],
        'placeholder' => '0',
        'default' => [
          'top' => '0',
          'right' => '0',
          'bottom' => '0',
          'left' => '0',
          'unit' => 'px',
          'isLinked' => false,
        ],
        'selectors' => [
          '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .description-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );


            $this->add_control(
              'big_margins_section',
              [
                'label' => __( 'Margins', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
              ]
            );




                $this->add_responsive_control(
                  'big_category_margin_bottom',
                  [
                    'label' => __( 'Category margin bottom', 'elementor-awesomesauce' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                      'px' => [
                        'min' => 0,
                        'max' => 100,
                      ],
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                      'size' => 10,
                      'unit' => 'px',
                    ],
                    'tablet_default' => [
                      'size' => 10,
                      'unit' => 'px',
                    ],
                    'mobile_default' => [
                      'size' => 10,
                      'unit' => 'px',
                    ],
                    'selectors' => [
                      '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                  ]
                );

                $this->add_responsive_control(
                  'big_title_margin_bottom',
                  [
                    'label' => __( 'Title margin bottom', 'elementor-awesomesauce' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                      'px' => [
                        'min' => 0,
                        'max' => 100,
                      ],
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                      'size' => 5,
                      'unit' => 'px',
                    ],
                    'tablet_default' => [
                      'size' => 5,
                      'unit' => 'px',
                    ],
                    'mobile_default' => [
                      'size' => 5,
                      'unit' => 'px',
                    ],
                    'selectors' => [
                      '{{WRAPPER}} .awesomesauce-post-block .wrapper--big .news-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                  ]
                );

                $this->add_responsive_control(
                  'item_margin_bottom',
                  [
                    'label' => __( 'Item margin bottom', 'elementor-awesomesauce' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                      'px' => [
                        'min' => 0,
                        'max' => 30,
                      ],
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                      'size' => 10,
                      'unit' => 'px',
                    ],
                    'tablet_default' => [
                      'size' => 10,
                      'unit' => 'px',
                    ],
                    'mobile_default' => [
                      'size' => 10,
                      'unit' => 'px',
                    ],
                    'selectors' => [
                      '{{WRAPPER}} .awesomesauce-post-block .wrapper--big ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                  ]
                );



        $this->end_controls_section();

  }

  /**
  * Render the widget output on the frontend.
  *
  * Written in PHP and used to generate the final HTML.
  *
  * @since 1.1.0
  *
  * @access protected
  */
  protected function render() {
    $settings = $this->get_settings_for_display();
    $show_title         = $settings['show_title'];

    $show_cat_small           = $settings['show_cat'];
    $show_date_small          = $settings['show_date'];
    $show_views_small         = $settings['show_views'];
    $show_comments_small         = $settings['show_comments'];
    $post_count_small      = $settings['post_count'];
    $crop_small	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
    $post_content_crop_small	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 50;

    $this->add_inline_editing_attributes( 'title', 'none' );
    ?>
    <?php
    $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'orderby' => $settings['order_by'],
      'ignore_sticky_posts' => 1,
      'posts_per_page' => $settings['post_count'],
      'meta_key'    => 'number_of_views',
      'order' => 'DESC',
    ];

    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <div class="awesomesauce-post-block post-list post-list-with-numbers">
      <?php if($show_title) { ?>
          <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
      <?php }  ?>
        <?php  require 'block_styles/post-list-with-numbers.php'; ?>
      <?php wp_reset_postdata(); ?>
    </div>
    <?php endif; ?>
    <?php }

protected function _content_template() {

}

public function post_category() {

  $terms = get_terms( array(
    'taxonomy'    => 'category',
    'hide_empty'  => false,
    'posts_per_page' => -1,
    'suppress_filters' => false,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

function elementor_awesomesauce_post_tags(){
  $terms = get_terms( array(
    'taxonomy'    => 'post_tag',
    'hide_empty'  => false,
    'posts_per_page' => -1,
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

function elementor_awesomesauce_post_authors(){
  $terms = wp_list_authors( array(
    'show_fullname' => 1,
    'optioncount'   => 1,
    'html'          => false,
    'orderby'       => 'post_count',
    'order'         => 'DESC',
  ) );

  $cat_list = [];
  foreach($terms as $post) {
    $cat_list[$post->term_id]  = [$post->name];
  }
  return $cat_list;
}

}
