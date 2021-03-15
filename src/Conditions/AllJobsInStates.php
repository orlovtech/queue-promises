<?php

namespace Tochka\Promises\Conditions;

use Tochka\Promises\Contracts\ConditionContract;
use Tochka\Promises\Core\BasePromise;
use Tochka\Promises\Enums\StateEnum;
use Tochka\Promises\Models\PromiseJob;

final class AllJobsInStates implements ConditionContract
{
    /** @var array<StateEnum> */
    private $states;

    public function __construct(array $states)
    {
        $this->states = $states;
    }

    public function getStates(): array
    {
        return $this->states;
    }

    public static function success(): self
    {
        return new self([StateEnum::SUCCESS()]);
    }

    public static function failed(): self
    {
        return new self([StateEnum::FAILED(), StateEnum::TIMEOUT()]);
    }

    public static function finished(): self
    {
        return new self([StateEnum::SUCCESS(), StateEnum::FAILED(), StateEnum::TIMEOUT()]);
    }

    public function condition(BasePromise $basePromise): bool
    {
        return $basePromise->getAttachedModel()->jobs->reduce(
            function (bool $carry, PromiseJob $job) {
                return $carry && $job->getBaseJob()->getState()->in($this->states);
            },
            true
        );
    }
}
