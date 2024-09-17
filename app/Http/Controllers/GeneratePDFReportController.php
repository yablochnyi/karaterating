<?php

namespace App\Http\Controllers;

use App\Models\Studenttestresult;
use App\Models\TournamentStudentList;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GeneratePDFReportController extends Controller
{
//    public function generatePDFReport($id): \Illuminate\Http\Response
//    {
//        $report = TournamentStudentList::
//
//        $watcherData = json_decode($report->watcher_data, true);
//
//        $proctorInfo = [];
//
//        if ($watcherData) {
//            $proctorIds = array_column($watcherData, 'proctorId');
//
//            $proctors = User::whereIn('id', $proctorIds)->get()->keyBy('id');
//
//            foreach ($watcherData as $watcher) {
//                $proctor = $proctors->get($watcher['proctorId']);
//                if ($proctor) {
//                    $formattedDate = date('d.m.Y H:i:s', strtotime($watcher['dateConnection']));
//                    $proctorInfo[] = [
//                        'name' => $proctor->name,
//                        'time' => $formattedDate
//                    ];
//                }
//            }
//        }
//
//        $pdf = Pdf::loadView('pdf.report-pdf', [
//            'report' => $report,
//            'proctorInfo' => $proctorInfo,
//        ])->setPaper('a4')->setOptions([
//            'defaultFont' => 'DejaVu Sans'
//        ]);
//        // Возврат PDF потока в браузер
//        return $pdf->stream('report.pdf');
//
//    }
}
