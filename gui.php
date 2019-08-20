<?php
/**
 * Adds Cal_Widget widget.
 */
class Cal_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'cal_widget', // Base ID
			esc_html__( 'Calendar', 'cal_domain' ), // Name
			array( 'description' => esc_html__( 'A Foo Widget', 'cal_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; // add stuff beofre

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		//echo esc_html__( 'Hello, World!', 'cal_domain' );
                echo '<div class="calbox">
  <div class="datebox">
   <input id="hmonth" type="hidden" value="9"></input>
   <i class="arrow left" onclick="yeardown()"></i>
     <label id="yearlb" class="yearlbl">2018</label>
   <i class="arrow right" onclick="yearup()"></i>
       <hr =""\="" class="cline" style="display:inline-block;width:4em;">
   <i class="arrow left" onclick="monthdown()"></i>
     <label id="monthlb" class="monthlbl">month</label>
   <i class="arrow right" onclick="monthup()"></i>
  </div>
       <hr =""\="" class="line">
<div id="fullDiv" >
  <ul>
    <li id="day1">SUN</li>
    <li id="day2">MON</li>
    <li id="day3">TUE</li>
    <li id="day4">WED</li>
    <li id="day5">THUR</li>
    <li id="day6">FRI</li>
    <li id="day7">SAT</li>

    <li id="day1" onclick="selday(\'day1\')">1</li>
    <li id="day2" onclick="selday(\'day2\')">2</li>
    <li id="day3" onclick="selday(\'day3\')">3</li>
    <li id="day4" onclick="selday(\'day4\')">4</li>
    <li id="day5" onclick="selday(\'day5\')">5</li>
    <li id="day6" onclick="selday(\'day6\')">6</li>
    <li id="day7" onclick="selday(\'day7\')">7</li>
    <li id="day8" onclick="selday(\'day8\')">8</li>
    <li id="day9" onclick="selday(\'day9\')">9</li>
    <li id="day10" onclick="selday(\'day10\')">10</li>
    <li id="day11" onclick="selday(\'day11\')">11</li>
    <li id="day12" onclick="selday(\'day12\')">12</li>
    <li id="day13" onclick="selday(\'day13\')">13</li>
    <li id="day14" onclick="selday(\'day14\')">14</li>
    <li id="day15" onclick="selday(\'day15\')">15</li>
    <li id="day16" onclick="selday(\'day16\')">16</li>
    <li id="day17" onclick="selday(\'day17\')">17</li>
    <li id="day18" onclick="selday(\'day18\')">18</li>
    <li id="day19" onclick="selday(\'day19\')">19</li>
    <li id="day20" onclick="selday(\'day20\')">20</li>
    <li id="day21" onclick="selday(\'day21\')">21</li>
    <li id="day22" onclick="selday(\'day22\')">22</li>
    <li id="day23" onclick="selday(\'day23\')">23</li>
    <li id="day24" onclick="selday(\'day24\')">24</li>
    <li id="day25" onclick="selday(\'day25\')">25</li>
    <li id="day26" onclick="selday(\'day26\')">26</li>
    <li id="day27" onclick="selday(\'day27\')">27</li>
    <li id="day28" onclick="selday(\'day28\')">28</li>
    <li id="day29" onclick="selday(\'day29\')">29</li>
    <li id="day30" onclick="selday(\'day30\')">30</li>
    <li id="day31" onclick="selday(\'day31\')">31</li>
    <li>1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
  </ul>
</div></div>';






		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Calemdar', 'cal_domain' );
		?>

		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                  <?php esc_attr_e( 'Title:', 'cal_domain' ); ?></label> 

		<input
                      class="widefat"
                      id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                      name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                      type="text"
                      value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Cal_Widget

