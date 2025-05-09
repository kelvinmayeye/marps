<?php

namespace App\Imports\Students;

use App\Models\ExaminationCenter\ExamRegistrationStudent;
use Exception;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class StudentsImport implements ToModel, WithHeadingRow
{
    private int $currentRow = 1;

    public function __construct(public $exam_registration_id)
    {
    }

    /**
     * Handle each row of the Excel.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     * @throws ValidationException
     */
    public function model(array $row)
    {
        $this->currentRow++; // To track actual Excel row number (header is row 1)

        $requiredFields = ['prem_number', 'gender', 'firstname', 'lastname'];
        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($row[$field])) {
                $errors[] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
            } elseif ($field === 'gender' && !in_array(strtoupper($row[$field]), ['M', 'F'])) {
                $errors[] = "Gender must be either 'M' or 'F'";
            }
        }

        if (!empty($errors)) {
            throw ValidationException::withMessages([
                "Row {$this->currentRow}" => $errors
            ]);
        }

        // Check if the record exists
        $existing = ExamRegistrationStudent::where('prem_number', $row['prem_number'])
            ->where('exam_registration_id', $this->exam_registration_id)
            ->first();

        if ($existing) {
            $existing->update([
                'firstname'  => $row['firstname'],
                'middlename' => $row['middlename'] ?? '',
                'lastname'   => $row['lastname'],
                'gender'     => $row['gender'],
            ]);
            return null; // Prevent duplication
        }

        // Otherwise, insert a new record
        return new ExamRegistrationStudent([
            'exam_registration_id' => $this->exam_registration_id,
            'prem_number'          => $row['prem_number'],
            'firstname'            => $row['firstname'],
            'middlename'           => $row['middlename'] ?? '',
            'lastname'             => $row['lastname'],
            'gender'               => $row['gender'],
        ]);
    }
}
