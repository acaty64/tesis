<?php

namespace App\Http\Controllers;

use App\Sequence;
use App\Trace;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laracasts\Flash\Flash;

class DocumentController extends Controller
{
    /**
     * route('document.up10')
     */
    public function up10(Request $request)
    {
        $data = $request->all();
        $thesis_id = $data['thesis_id'];
        $deal_id = $data['deal_id'];
        $sequence = Sequence::where('deal_id', $deal_id)->first();
        $sequence_id = $sequence->id;
        $author_id = $data['author_id'];
        try {
            $file = $request->file('file');
            $document = $file->getClientOriginalName(); 
            $filename = basename($file);
            $path = realpath($file);

            $root = storage_path('app/public');
            $newDir = $root . '/' . $thesis_id;
            $newFile = $newDir . '/' . $document;
            copy($path, $newFile);
            $trace = Trace::create([
                'thesis_id' => $thesis_id,
                'sequence_id' => $sequence_id,
                'date' => Carbon::today()->toDateTimeString(),
                'document' => $document,
                'filename' => $thesis_id.'/'.$filename
            ]);
            Flash::success('Documento ' . $document . ' grabado.');
            Flash::error("WORKING (email)...");
            return view('home');
        } catch (Exception $e) {
            Flash::error('Documento no grabado.'  . $document);
            return ['success' => false];
        }
    }
}
