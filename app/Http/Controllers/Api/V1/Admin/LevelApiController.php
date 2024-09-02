<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Http\Resources\Admin\LevelResource;
use App\Models\Level;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LevelApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('level_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LevelResource(Level::all());
    }

    public function store(StoreLevelRequest $request)
    {
        $level = Level::create($request->all());

        return (new LevelResource($level))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Level $level)
    {
        abort_if(Gate::denies('level_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new LevelResource($level);
    }

    public function update(UpdateLevelRequest $request, Level $level)
    {
        $level->update($request->all());

        return (new LevelResource($level))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Level $level)
    {
        abort_if(Gate::denies('level_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $level->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
