<?php

namespace App\Services;

use App\Models\Attachment;
use App\Repositories\AttachmentRepository;

class AttachmentService 
{
    /**
     * @var  Attachment
     */
    protected  AttachmentRepository $attachmentRepository;
       /**
     * @param AttachmentRepository $AttachmentRepository
     */
    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }
    public function listData(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->attachmentRepository->list();
    }
    public function saveData(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->attachmentRepository->save($data);
    }

    public function getData(Attachment $attachment): Attachment
    {
        return $this->attachmentRepository->get($attachment);
    }
    public function updateData(array $data,Attachment $attachment): Attachment
    {
        return $this->attachmentRepository->update($data,$attachment);
    }

    public function deleteData(Attachment $attachment): Attachment
    {
        return $this->attachmentRepository->delete($attachment);
    }




}
