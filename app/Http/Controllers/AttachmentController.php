<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AttachmentService;
use App\Models\Attachment;
use App\Http\Requests\Attachment\StoreAttachmentRequest;
use App\Http\Requests\Attachment\UpdateAttachmentRequest;
use Symfony\Component\HttpFoundation\Response;


class AttachmentController extends Controller
{
    protected AttachmentService $attachmentService;

    /**
     * @param  ProjectService $projectService
     */
    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->attachmentService->listData(),Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttachmentRequest $request): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->attachmentService->saveData($request->validated()),Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     */
    public function show(Attachment $attachment): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->attachmentService->getData($attachment),Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttachmentRequest $request,Attachment $attachment): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->attachmentService->updateData($request->validated(), $attachment),Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attachment $attachment): \Illuminate\Http\JsonResponse
    {
        return response()->json($this->projectService->deleteData($attachment),Response::HTTP_OK);
    }
}
