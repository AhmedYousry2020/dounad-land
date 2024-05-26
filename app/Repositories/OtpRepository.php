<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\OtpInterface;
use App\Models\VerificationOtp;

class OtpRepository extends BaseRepository implements OtpInterface
{
     /**
     * get Model Class Name
     * @var string
     */
    protected $modelName = VerificationOtp::class;

    /**
     * Default order by
     *
     * @var string
     */
    protected $orderBy = 'id';


}
