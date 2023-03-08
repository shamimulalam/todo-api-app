<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpStatusCodes;

class LabelController extends Controller
{
    public function index()
    {
        return auth()->user()->labels;
    }
    public function store(LabelRequest $request)
    {
        return auth()->user()->labels()->create($request->validated());
    }
    public function destroy(Label $label)
    {
        $label->delete();

        return response('', HttpStatusCodes::HTTP_NO_CONTENT);
    }

    public function update(LabelRequest $request, Label $label)
    {
        $label->update($request->validated());

        return response($label);
    }
}
