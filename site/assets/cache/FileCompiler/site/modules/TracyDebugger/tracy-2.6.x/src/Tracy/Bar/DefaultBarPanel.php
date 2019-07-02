<?php

/**
 * This file is part of the Tracy (https://tracy.nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Tracy;


/**
 * IBarPanel implementation helper.
 * @internal
 */
class DefaultBarPanel implements IBarPanel
{
	public $data;

	private $id;


	public function __construct(string $id)
	{
		$this->id = $id;
	}


	/**
	 * Renders HTML code for custom tab.
	 */
	public function getTab(): string
	{
		ob_start(function () {});
		$data = $this->data;
		require \ProcessWire\wire("config")->paths->root . 'site/modules/TracyDebugger/tracy-2.6.x/src/Tracy/Bar' . "/panels/{$this->id}.tab.phtml";
		return ob_get_clean();
	}


	/**
	 * Renders HTML code for custom panel.
	 */
	public function getPanel(): string
	{
		ob_start(function () {});
		if (is_file(\ProcessWire\wire("config")->paths->root . 'site/modules/TracyDebugger/tracy-2.6.x/src/Tracy/Bar' . "/panels/{$this->id}.panel.phtml")) {
			$data = $this->data;
			require \ProcessWire\wire("config")->paths->root . 'site/modules/TracyDebugger/tracy-2.6.x/src/Tracy/Bar' . "/panels/{$this->id}.panel.phtml";
		}
		return ob_get_clean();
	}
}
