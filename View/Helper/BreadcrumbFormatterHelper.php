<?php
class BreadcrumbFormatterHelper extends AppHelper {
	public $helpers = array('Html');

/**
 * Returns the breadcrumb trail as a sequence of &raquo;-separated links.
 *
 * @param string $separator Text to separate crumbs.
 * @param string $startText This will be the first crumb, if false it defaults to first crumb in array
 * @return string Composed bread crumbs
 */
	public function getTrail($crumbs, $separator = '&raquo;', $startText = false) {
		if (empty($crumbs)) {
			return null;
		}

		$out = array();

		if ($startText) {
			$out[] = $this->Html->link($startText, '/');
		}

		foreach ($crumbs as $crumb) {
			if (!empty($crumb[1])) {
				$out[] = $this->Html->link($crumb[0], $crumb[1], $crumb[2]);
			} else {
				$out[] = $crumb[0];
			}
		}

		return join($separator, $out);
	}


/**
 * Returns breadcrumbs as a (x)html list
 *
 * This method uses HtmlHelper::tag() to generate list and its elements. Works
 * similiary to HtmlHelper::getCrumbs(), so it uses options which every
 * crumb was added with.
 *
 * @param array $options Array of html attributes to apply to the generated list elements.
 * @return string breadcrumbs html list
 */
	public function getList($crumbs, $options = array(), $separator = null) {
		if (empty($crumbs)) {
			return null;
		}

		foreach (array('first', 'last') as $class) {
			if (isset($options[$class])) {
				$$class = $options[$class];

				unset($options[$class]);
			} else {
				$$class = $class;
			}
		}

		$result = '';
		$crumbCount = count($crumbs);
		$ulOptions = $options;

		foreach ($crumbs as $which => $crumb) {
			if (!empty($separator) && ($which != 0)) {
				$result .= $this->Html->tag('li', $separator);
			}

			$options = array();

			if (empty($crumb[1])) {
				$elementContent = $crumb[0];
			} else {
				$elementContent = $this->Html->link($crumb[0], $crumb[1], $crumb[2]);
			}

			if ($which == 0) {
				$options['class'] = $first;
			} elseif ($which == $crumbCount - 1) {
				$options['class'] = $last;
			}

			$result .= $this->Html->tag('li', $elementContent, $options);
		}

		return $this->Html->tag('ul', $result, $ulOptions);
	}
}
?>