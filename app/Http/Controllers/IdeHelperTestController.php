<?php

namespace App\Http\Controllers;

use App\Models\IdeHelperTest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class IdeHelperTestController extends Controller
{
    public function index(): Model
    {
        return IdeHelperTest::find(1);
    }
}
