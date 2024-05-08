<?php

namespace App;

trait Files
{
    public static function saveFile(Request $request)
    {
        $file = $request->file('file_path');
        $theFilePath = null;
            $theFilePath = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Filepath'), $theFilePath);
            $theFilePath = 'Filepath/' . $theFilePath;
      
        return $theFilePath;
    }
}
