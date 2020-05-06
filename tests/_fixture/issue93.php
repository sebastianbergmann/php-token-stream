<?php
class PhpAnonym
{
    private $field;

    public function __construct(int $field)
    {
        $this->field = $field;
    }

    public function funcOne(): int
    {
        return $this->field;
    }

    public function funcTwo(): int
    {
        $cls = new class(42) {
            private $num;

            public function __construct(int $num)
            {
                $this->num = $num;
            }

            public function getNum(): int
            {
                return $this->num;
            }
        };

        return $cls->getNum();
    }
}
