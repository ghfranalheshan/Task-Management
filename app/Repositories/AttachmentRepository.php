<?php
namespace App\Repositories;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
class AttachmentRepository
{
    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return Attachment::all();

    }

    public function save(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        $file = $data['file'];
        $filename = time(). '.'. $file->getClientOriginalExtension();
        $path = $file->storeAs('uploads', $filename);
       
       
        return Attachment::query()->create([
            'task_id' => $data['task_id'],
            'file_name' => $filename,
            'file_path' => Storage::url($path),
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),

        ]);
    }

    function get(Attachment $attachment): Attachment
    {
        return $attachment;
    }

    public function update(array $data, Attachment $attachment): Attachment
    {
        $file = $data['file'];
        $path = $file->storeAs('uploads', $filename);
        $filename = time(). '.'. $file->getClientOriginalExtension();
        $attachment->update([
            'task_id' => $data['task_id'],
            'file_name' => $filename,
            'file_path' => Storage::url($path),
            'file_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);
        return $attachment;

    }

    public function delete(Attachment  $attachment): Attachment
    {
        $attachment->delete();
        return $attachment;
    }

}
