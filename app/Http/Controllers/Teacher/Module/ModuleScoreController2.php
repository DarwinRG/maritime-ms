<?php

namespace App\Http\Controllers\Teacher\Module;

use App\Http\Controllers\Controller;
use App\Models\ModuleListStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use Mpdf\Mpdf;

class ModuleScoreController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    public function show(ModuleListStudent $moduleScore)
    {
        $filePath = storage_path("app/{$moduleScore->file}");

        if (!file_exists($filePath)) {
            abort(404, 'File not found');
        }

        $ext = pathinfo($filePath, PATHINFO_EXTENSION);


        if ($ext === 'docx') {

            $phpWord = IOFactory::load($filePath);


            $html = $this->convertDocxToHtml($phpWord);


            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'default_font' => 'Arial'
            ]);

            $mpdf->WriteHTML($html);

            $mpdf->Output('generated-file.pdf', 'I');
        }


        if ($ext === 'pdf') {
            return response()->file($filePath, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
            ]);
        }


        abort(404, 'Unsupported file type');
    }

    /**
     * Convert DOCX to HTML using PhpWord
     *
     * @param \PhpOffice\PhpWord\PhpWord $phpWord
     * @return string
     */
    private function convertDocxToHtml($phpWord)
    {
        // Create a temporary HTML writer
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');

        // Capture the HTML content into a variable
        ob_start();
        $htmlWriter->save('php://output');
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , ModuleListStudent $moduleScore)
    {

        //return $moduleScore;
         $moduleScore->update(['points'=>$request->points]);
         return redirect()->back()->with([
            'success_module' => 'Score updated successfully!',
            'module_id' => $moduleScore->module_list_id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
