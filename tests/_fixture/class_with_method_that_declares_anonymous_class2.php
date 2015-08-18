<?php

class Test {
	public function bar () {
		$foo = new class {
			public function bar () {
				return true;
			}
		};

		return $foo->bar();
	}

	public function baz () {
		return false;
	}
}
