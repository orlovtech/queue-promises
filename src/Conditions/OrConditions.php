<?php

namespace Tochka\Promises\Conditions;

use Tochka\Promises\Core\BasePromise;
use Tochka\Promises\Contracts\ConditionContract;

final class OrConditions implements ConditionContract
{
    /** @var \Tochka\Promises\Contracts\ConditionContract[] */
    private $conditions = [];

    public function addCondition(ConditionContract $condition): self
    {
        $this->conditions[] = $condition;

        return $this;
    }

    public function condition(BasePromise $basePromise): bool
    {
        return array_reduce($this->conditions,
            static function (bool $carry, ConditionContract $item) use ($basePromise) {
                return $carry || $item->condition($basePromise);
            }, false);
    }
}
