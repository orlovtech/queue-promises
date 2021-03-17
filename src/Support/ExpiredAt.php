<?php

namespace Tochka\Promises\Support;

use Carbon\Carbon;
use Tochka\Promises\Conditions\Timeout as TimeoutCondition;
use Tochka\Promises\Core\BasePromise;
use Tochka\Promises\Core\Support\ConditionTransition;
use Tochka\Promises\Enums\StateEnum;

trait ExpiredAt
{
    private Carbon $trait_expired_at;

    /**
     * @param Carbon $expired_at Время истечения
     */
    public function setExpiredAt(Carbon $expired_at): void
    {
        $this->trait_expired_at = $expired_at;
    }

    public function getExpiredAt(): ?Carbon
    {
        return $this->expired_at ?? $this->trait_expired_at;
    }

    /**
     * Hook promiseConditions
     *
     * @param \Tochka\Promises\Core\BasePromise $promise
     */
    public function promiseConditionsExpiredAt(BasePromise $promise): void
    {
        if ($this->getExpiredAt() === null) {
            return;
        }

        $promise->setTimeoutAt($this->getExpiredAt());

        $promise->addCondition(
            new ConditionTransition(
                new TimeoutCondition($this->getExpiredAt()),
                StateEnum::RUNNING(),
                StateEnum::TIMEOUT()
            )
        );
    }
}
