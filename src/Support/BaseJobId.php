<?php

namespace Tochka\Promises\Support;

use Tochka\Promises\Core\BaseJob;
use Tochka\Promises\Facades\PromiseJobRegistry;

trait BaseJobId
{
    /** @var int|null */
    protected $base_job_id;

    public function setBaseJobId(int $base_job_id): void
    {
        $this->base_job_id = $base_job_id;
    }

    public function getBaseJobId(): ?int
    {
        return $this->base_job_id;
    }
}