<?php
class BreadcrumbCollectorComponent extends Component {

    protected $_crumbs = array();

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection for this component
 * @param array $settings Array of settings.
 */
	public function __construct(ComponentCollection $collection, $settings = array()) {
		if (isset($settings['crumbs'])) {
			$this->_crumbs = $settings['crumbs'];

			unset($settings['crumbs']);
		}

		parent::__construct($collection, $settings);
	}

/**
 * Add method
 */
    public function add($name, $link = null, $options = null) {
		$this->_crumbs[] = array($name, $link, $options);
    }

    /*
     * @usage Return the breadcrumbs to the controller
     * @return void
     */
    public function get() {
        return $this->_crumbs;
    }

}
?>