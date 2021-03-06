<?php
namespace ElementorAwesomesauce\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* @since 1.1.0
*/
class PostCarousel extends Widget_Base {


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
    return 'post-carousel';
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
    return __( 'Post Carousel', 'elementor-post-carousel' );
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

  public function __construct($data = [], $args = null) {
    parent::__construct($data, $args);

    // wp_register_script( 'script-handle', '/awesomesauce.js', [ 'elementor-frontend' ], '1.0.0', true );
    wp_register_script( 'script-handle', plugins_url( "elementor-awesomesauce/widgets/awesomesauce.js"), [ 'elementor-frontend' ], '1.0.0', true );
 }

public function get_script_depends() {
   return [ 'script-handle' ];
}


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
        'default' => __( 'Post grid', 'elementor-awesomesauce' ),
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
      'order',
      [
        'label' => __( 'Order ASC/DESC', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'DESC', 'elementor-awesomesauce' ),
        'options' => [
          'DESC'  => __( 'Descending', 'elementor-awesomesauce' ),
          'ASC' => __( 'Ascending', 'elementor-awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
      'order_by',
      [
        'label' => __( 'Show', 'elementor-awesomesauce' ),
        'type' => Controls_Manager::SELECT,
        'default' => __( 'date', 'elementor-awesomesauce' ),
        'options' => [
          'date'  => __( 'Latest posts', 'elementor-awesomesauce' ),
          'comment_count'  => __( 'Most commented', 'elementor-awesomesauce' ),
          'meta_value_num'  => __( 'Most read', 'elementor-awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
      'post_pick_by',
      [
        'label'     => esc_html__( 'Post pick by', 'elementor_awesomesauce' ),
        'type'      => Controls_Manager::SELECT,
        'default'   => '',
        'options'   => [
          'category'      =>esc_html__( 'Category', 'elementor_awesomesauce' ),
          'tags'      =>esc_html__( 'Tags', 'elementor_awesomesauce' ),
          'stickypost'    =>esc_html__( 'Sticky posts', 'elementor_awesomesauce' ),
          'post'    =>esc_html__( 'Post id', 'elementor_awesomesauce' ),
          'author'    =>esc_html__( 'Author', 'elementor_awesomesauce' ),
        ],
      ]
    );

    $this->add_control(
      'post_categories',
      [
        'label' => __( 'Choose categories', 'elementor-awesomesauce' ),
        'type' => \Elementor\Controls_Manager::SELECT2,
        'default' => '',
        'options' => $this->post_category(),
        'label_block' => true,
        'multiple' => true,
        'condition' => [ 'post_pick_by' => ['category'] ]
      ]
    );

    $this->add_control(
      'post_tags',
      [
        'label' => esc_html__('Select tags', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SELECT2,
        'options' => $this->elementor_awesomesauce_post_tags(),
        'label_block' => true,
        'multiple' => true,
        'condition' => [ 'post_pick_by' => ['tags'] ]
      ]
    );

    $this->add_control(
      'author_id',
      [
        'label' => esc_html__( 'Author id', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( '1,2,3', 'elementor_awesomesauce' ),
        'condition' => [ 'post_pick_by' => ['author'] ]
      ]
    );
    $this->add_control(
      'post_id',
      [
        'label' => esc_html__( 'Post id', 'elementor_awesomesauce' ),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => esc_html__( '1,2,3', 'elementor_awesomesauce' ),
        'condition' => [ 'post_pick_by' => ['post'] ]
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
        'default' => 'Yes',
      ]
    );

    $this->add_control(
      'show_author',
      [
        'label' => esc_html__('Show author', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'Yes',
      ]
    );
    $this->add_control(
      'show_views',
      [
        'label' => esc_html__('Show views', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'No',
      ]
    );
    $this->add_control(
      'show_comments',
      [
        'label' => esc_html__('Show comments', 'elementor_awesomesauce'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('Yes', 'elementor_awesomesauce'),
        'label_off' => esc_html__('No', 'elementor_awesomesauce'),
        'default' => 'No',
      ]
    );

    $this->end_controls_section();
    $this->start_controls_section(
      'slider_settings_section',
      [
        'label' => __( 'Slider settings', 'elementor-awesomesauce' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
         'post_show',
         [
           'label'         => esc_html__( 'Post show', 'digiqole' ),
           'type'          => Controls_Manager::NUMBER,
           'default'       => 5,
         ]
       );

        $this->add_control(
         'digiqole_slider_autoplay',
             [
             'label' => esc_html__( 'Autoplay', 'digiqole' ),
             'type' => \Elementor\Controls_Manager::SWITCHER,
             'label_on' => esc_html__( 'Yes', 'digiqole' ),
             'label_off' => esc_html__( 'No', 'digiqole' ),
             'return_value' => 'yes',
             'default' => 'no'
             ]
         );

      $this->add_control(
          'dot_nav_show',
              [
              'label' => esc_html__( 'Dot Nav', 'digiqole' ),
              'type' => \Elementor\Controls_Manager::SWITCHER,
              'label_on' => esc_html__( 'Yes', 'digiqole' ),
              'label_off' => esc_html__( 'No', 'digiqole' ),
              'return_value' => 'yes',
              'default' => 'yes'
              ]
      );

  $this->end_controls_section();

    $this->start_controls_section(
      'typography_section',
      [
        'label' => __( 'Typography and text settings', 'elementor-awesomesauce' ),
        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => __( 'Title typography', '' ),
        'name' => 'title_typography',
        'selector' => '{{WRAPPER}} .title',
      ]
    );

    $this->add_group_control(
      \Elementor\Group_Control_Typography::get_type(),
      [
        'label' => __( 'Description typography', '' ),
        'name' => 'desc_typography',
        'selector' => '{{WRAPPER}} .description',
      ]
    );

    $this->add_control(
      'title_color',
      [
        'label' => __( 'Title Color', '' ),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#000000',
        'selectors' => [
          '{{WRAPPER}} .title' => 'color: {{VALUE}}',
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
    $show_title       = $settings['show_title'];
    $show_cat         = $settings['show_cat'];
    $show_date        = $settings['show_date'];
    $show_author      = $settings['show_author'];
    $show_views       = $settings['show_views'];
    $show_comments    = $settings['show_comments'];
    $show_tags        = $settings['show_tags'];
    $crop	= (isset($settings['post_title_crop'])) ? $settings['post_title_crop'] : 20;
    $post_content_crop	= (isset($settings['post_content_crop'])) ? $settings['post_content_crop'] : 50;

    $slide_controls    = [

       'dot_nav_show' => $settings['dot_nav_show'],
       'auto_nav_slide' => $settings['digiqole_slider_autoplay'],
       'item_count' => $settings['post_show'],
     ];

     $slide_controls = \json_encode($slide_controls);

    $this->add_inline_editing_attributes( 'title', 'none' );
    ?>
    <?php
    $arg = [
      'post_type'   =>  'post',
      'post_status' => 'publish',
      'orderby' => $settings['order_by'],
      'order' => $settings['order'],
    ];

    if($settings['order_by']== 'meta_value_num'){
      $arg['meta_key'] ='post_views_count';
    }

    if($settings['post_pick_by']=='stickypost'){
      $arg['post__in'] = get_option( 'sticky_posts' );
      $arg['ignore_sticky_posts'] = 1;
    }

    if($settings['post_pick_by']=='category') {
      $arg['category__in'] = $settings['post_categories'];
    }

    if($settings['post_pick_by']=='tags') {
      $arg['tag__in'] = $settings['post_tags'];
    }

    if($settings['post_pick_by']=='post') {
      $elementor_awesomesauce_posts = explode(',',$settings['post_id']);
      $arg['post__in'] = $elementor_awesomesauce_posts;
      $arg['posts_per_page'] = count($elementor_awesomesauce_posts);
    }

    if($settings['post_pick_by']=='author') {
      $elementor_awesomesauce_authors = explode(',',$settings['author_id']);
      $arg['author__in'] = $elementor_awesomesauce_authors;
    }

    $queryd = new \WP_Query( $arg );
    if ( $queryd->have_posts() ) : ?>
    <!-- <div class="row"> -->
      <?php if($show_title) { ?>
          <h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title']; ?></h2>
      <?php }  ?>
      <div data-controls="<?php echo esc_attr($slide_controls); ?>" class="post-slider owl-carousel owl-theme">
        <?php while ($queryd->have_posts()) : $queryd->the_post(); ?>
          <div class="wrapper">
            <?php if ( has_post_thumbnail() ) : ?>
              <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="widget-image d-block">
                <?php the_post_thumbnail('medium-horizontal', ['class' => 'img-fluid', 'title' => 'Feature image']); ?>
              </a>
            <?php endif; ?>

            <?php include (ELEMENTOR_AWESOMESAUCE . 'widgets/content/description.php'); ?>
          </div>
          <!-- </div> -->
        <?php endwhile; ?>
      </div>
      <?php wp_reset_postdata(); ?>
    <!-- </div> -->
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
