<?php

namespace App\Exports;

use App\Models\ExaminationCenter\ExamRegistrationStudent;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExamRegisteredStudentsExport implements FromArray,WithHeadings,ShouldAutoSize,WithStyles,WithTitle,WithProperties
{
    /**
     * @throws \Exception
     */
    public function __construct(public $exam_registered_id,public $exam_names)
    {
    }
    public function array(): array
    {
        //Todo: add sheet title above these header
        $students = ExamRegistrationStudent::query()->where('exam_registration_id',$this->exam_registered_id)
            ->select(['exam_registration_id','prem_number','firstname','middlename','lastname','gender'])
            ->get()->toArray();

        return $students;
    }

    public function headings(): array
    {
        $examNames = $this->exam_names;
        return array_merge(
            ["Exam Registered ID","Prem Number", "Firstname", "Middlename", "Lastname", "Gender"],
            $examNames
        );
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet->freezePane('A2'); // Freeze first row

        // Lock columns A to E
        foreach (range('A', 'F') as $col) {
            $sheet->getStyle($col)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
        }


        $highestColumn = $sheet->getHighestColumn();
        foreach (range('G', $highestColumn) as $col) {
            $sheet->getStyle($col)->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        }

        // Enable sheet protection
        $sheet->getProtection()->setSheet(true);
    }

    public function title(): string
    {
        return "Uploaded Students";
    }

    public function properties(): array
    {
        $em = $this->exam_registered_id;
        return [
            'title'          => 'Student Registered Template',
            'description'    => 'Student Registered Template',
            'subject'        => 'Student Registered Template',
            'keywords'       => "students,registration, scores, exam, results",
            'category'       => $em,
            'company'        => \Auth::user()->school->name,
        ];
    }
}
