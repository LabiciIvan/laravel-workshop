<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ClassesInstantiationRequest;

class CustomClassesInteractionController extends Controller
{

    public function handleClassesInstantiation(ClassesInstantiationRequest $request): JsonResponse
    {

        $request->normaliseRequestData(); 

        Log::info('Request received in: '. __METHOD__ . ' {DATA}', ['DATA' => $request->all()]);

        $classBlueprint = $request->getField('namespace') . "\\" .  $request->getField('class');
        $method = $request->getField('method');

        if (!class_exists($classBlueprint)) {
            return response()->json(['message' => 'Failed to create class']);
        }

        $instance = new $classBlueprint();

        return response()->json(
            [
                'result' => $instance->$method(),
                'message' => 'Request received and message returned'
            ]
        );
    }

}
