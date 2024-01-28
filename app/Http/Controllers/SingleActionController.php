<?php

namespace App\Http\Controllers;

use App\TestDependency\Dependent;
use Illuminate\Http\Request;

class SingleActionController extends Controller
{
    public function __construct(
        public Dependent $dependent
    ) {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $arg): string
    {
        return $this->dependent->tryDependentDependency($arg);
    }
}
