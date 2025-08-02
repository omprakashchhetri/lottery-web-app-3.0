<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LotteryController extends BaseController
{

    // Lottery View and generate page
    public function view_result($resultId) {
        $lotteryResultData = $this->getLotteryResult($resultId);
        if(!empty($lotteryResultData)) {
            $lotteryResultCount = $this-> countPublishedResults();
            return view('lottery_templates/lottery_template_test', ['lotteryData' => $lotteryResultData, 'lotteryResultCount'=>$lotteryResultCount]);
        } else {
            return redirect('admin/admin-dashboard');
        }
    }

    public function countPublishedResults()
    {
        $db = \Config\Database::connect();

        // Count 1 PM published results
        $onePmCount = $db->table('lottery_results')
            ->where('draw_time', '14:00:00')
            ->where('status', 'published')
            ->countAllResults();

        // Count 8 PM published results
        $eightPmCount = $db->table('lottery_results')
            ->where('draw_time', '21:00:00')
            ->where('status', 'published')
            ->countAllResults();

        return [
            '2pm' => str_pad($onePmCount, 3, '0', STR_PAD_LEFT),
            '9pm' => str_pad($eightPmCount, 3, '0', STR_PAD_LEFT)
        ];
    }

    /**
     * Get lottery result data for editing
     * 
     * @param int $resultId
     * @return \CodeIgniter\HTTP\Response
     */
    public function getLotteryResult($resultId)
    {
        try {
            $db = \Config\Database::connect();
            
            // Get main lottery result
            $result = $db->table('lottery_results')->where('id', $resultId)->get()->getRow();
            
            if (!$result) {
                return [];
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Lottery result not found'
                ])->setStatusCode(404);
            }
            
            // Get all prizes for this result
            $prizes = $db->table('lottery_prizes')
                        ->where('result_id', $resultId)
                        ->orderBy('prize_level', 'ASC')
                        ->orderBy('id', 'ASC')
                        ->get()
                        ->getResult();
            
            // Organize prizes by section
            $organizedPrizes = [
                'section1' => [],
                'section2' => [],
                'section3' => [],
                'section4' => [],
                'section5' => []
            ];
            
            foreach ($prizes as $prize) {
                switch ($prize->prize_level) {
                    case '1st':
                        $organizedPrizes['section1'][] = $prize->prize_number;
                        break;
                    case '2nd':
                        $organizedPrizes['section2'][] = $prize->prize_number;
                        break;
                    case '3rd':
                        $organizedPrizes['section3'][] = $prize->prize_number;
                        break;
                    case '4th':
                        $organizedPrizes['section4'][] = $prize->prize_number;
                        break;
                    case '5th':
                        $organizedPrizes['section5'][] = $prize->prize_number;
                        break;
                }
            }
            
            // Format date and time for display
            $drawDate1 = date('d/m/y', strtotime($result->draw_date));
            $drawDate2 = date('d/m/Y', strtotime($result->draw_date));
            $drawTime = date('g A', strtotime($result->draw_time));
            
            return [
                'status' => 'success',
                'data' => [
                    'result_id' => $result->id,
                    'status' => $result->status,
                    'draw_date_short' => $drawDate1,
                    'draw_date_full' => $drawDate2,
                    'draw_time' => $drawTime,
                    'lottery_data' => $organizedPrizes,
                    'status' => $result->status
                ]
            ];
            
        } catch (\Exception $e) {
            log_message('error', 'Error fetching lottery result: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Error fetching lottery result'
            ])->setStatusCode(500);
        }
    }
    
    /**
     * Save lottery results - creates main result and all prize records
     * 
     * @return \CodeIgniter\HTTP\Response
     */
    public function saveLotteryResults()
    {
        try {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            
            // Get POST data
            $lotteryData = $request->getPost('lottery_data');
            $drawTime = $request->getPost('draw_time');
            $drawDate = $request->getPost('draw_date');
            
            // Basic validation
            if (!$lotteryData || !$drawTime || !$drawDate) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Missing required fields'
                ])->setStatusCode(400);
            }
            
            // Convert date: "16th July 2025" -> "2025-07-16"
            $cleanDate = preg_replace('/(\d+)(st|nd|rd|th)/', '$1', $drawDate);
            $dateObj = \DateTime::createFromFormat('j F Y', $cleanDate);
            $processedDate = $dateObj ? $dateObj->format('Y-m-d') : date('Y-m-d');
            
            // Convert time: "1 PM Result" -> "14:00:00"
            $cleanTime = preg_replace('/\s*Result\s*$/i', '', trim($drawTime));
            $timeObj = \DateTime::createFromFormat('g A', $cleanTime);
            $processedTime = $timeObj ? $timeObj->format('H:i:s') : date('H:i:s');
            
            // Step 1: Create main lottery result record
            $resultData = [
                'template_id' => 1, // You can get this from POST or set default
                'draw_date' => $processedDate,
                'draw_time' => $processedTime,
                'status' => 'draft',
                'pdf_path' => NULL,
                'pdf_generated_at' => NULL,
                'publish_time' => NULL,
                'created_by' => 1, // You can get this from session or POST
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $insertResult = $db->table('lottery_results')->insert($resultData);
            
            if (!$insertResult) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to create lottery result'
                ])->setStatusCode(500);
            }
            
            // Step 2: Get the inserted lottery result ID
            $resultId = $db->insertID();
            
            // Step 3: Process each section and create prize records
            $prizeData = [];
            $currentTime = date('Y-m-d H:i:s');
            
            // Section 1 - 1st prize (1 record)
            if (isset($lotteryData['section1']) && !empty($lotteryData['section1'])) {
                foreach ($lotteryData['section1'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '1st',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 2 - 2nd prize (10 records)
            if (isset($lotteryData['section2']) && !empty($lotteryData['section2'])) {
                foreach ($lotteryData['section2'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '2nd',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 3 - 3rd prize (10 records)
            if (isset($lotteryData['section3']) && !empty($lotteryData['section3'])) {
                foreach ($lotteryData['section3'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '3rd',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 4 - 4th prize (10 records)
            if (isset($lotteryData['section4']) && !empty($lotteryData['section4'])) {
                foreach ($lotteryData['section4'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '4th',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Section 5 - 5th prize (100 records)
            if (isset($lotteryData['section5']) && !empty($lotteryData['section5'])) {
                foreach ($lotteryData['section5'] as $prizeNumber) {
                    $prizeData[] = [
                        'result_id' => $resultId,
                        'prize_level' => '5th',
                        'prize_number' => $prizeNumber,
                        'created_at' => $currentTime
                    ];
                }
            }
            
            // Step 4: Insert all prize records
            $insertedPrizes = 0;
            if (!empty($prizeData)) {
                try {
                    // Try batch insert first
                    $prizeInsertResult = $db->table('lottery_prizes')->insertBatch($prizeData);
                    
                    if ($prizeInsertResult) {
                        $insertedPrizes = count($prizeData);
                    } else {
                        // If batch insert fails, try individual inserts
                        foreach ($prizeData as $prize) {
                            $individualResult = $db->table('lottery_prizes')->insert($prize);
                            if ($individualResult) {
                                $insertedPrizes++;
                            }
                        }
                    }
                    
                    if ($insertedPrizes == 0) {
                        // If no prizes were inserted, delete the main result record
                        $db->table('lottery_results')->delete(['id' => $resultId]);
                        
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => 'Failed to create any prize records'
                        ])->setStatusCode(500);
                    }
                    
                } catch (\Exception $e) {
                    log_message('error', 'Prize insertion error: ' . $e->getMessage());
                    // Delete the main result record if prize insertion fails
                    $db->table('lottery_results')->delete(['id' => $resultId]);
                    
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Failed to create prize records: ' . $e->getMessage()
                    ])->setStatusCode(500);
                }
            }
            
            // Success response
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Lottery results saved successfully',
                'data' => [
                    'result_id' => $resultId,
                    'draw_date' => $processedDate,
                    'draw_time' => $processedTime,
                    'total_prizes' => $insertedPrizes,
                    'prizes_breakdown' => [
                        '1st' => count($lotteryData['section1'] ?? []),
                        '2nd' => count($lotteryData['section2'] ?? []),
                        '3rd' => count($lotteryData['section3'] ?? []),
                        '4th' => count($lotteryData['section4'] ?? []),
                        '5th' => count($lotteryData['section5'] ?? [])
                    ]
                ]
            ])->setStatusCode(201);
            
        } catch (\Exception $e) {
            log_message('error', 'Error saving lottery results: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error occurred'
            ])->setStatusCode(500);
        }
    }


    public function updateLotteryResultFiles()
    {
        try {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            helper(['filesystem', 'form']);

            $resultId = $request->getPost('result_id');
            if (!$resultId) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Missing result_id'
                ])->setStatusCode(400);
            }

            // Validate that record exists
            $existing = $db->table('lottery_results')->getWhere(['id' => $resultId])->getRow();
            if (!$existing) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Result record not found'
                ])->setStatusCode(404);
            }

            // Handle file uploads
            $pngFile = $request->getFile('png_file');
            $pdfFile = $request->getFile('pdf_file');
            $uploadDir = WRITEPATH . 'uploads/';
            $updateFields = [];
            $timeStamp = time();

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if ($pngFile && $pngFile->isValid() && !$pngFile->hasMoved()) {
                $pngName = 'lottery_result_' . $resultId . '_'. $timeStamp .'.png'; // or just $resultId . '.png'
                $pngFile->move($uploadDir, $pngName);
                $updateFields['result_image'] = 'uploads/' . $pngName;
            }

            if ($pdfFile && $pdfFile->isValid() && !$pdfFile->hasMoved()) {
                $pdfName = 'lottery_result_' . $resultId . '_'. $timeStamp .'.pdf'; // or just $resultId . '.png'
                $pdfFile->move($uploadDir, $pdfName);
                $updateFields['pdf_path'] = 'uploads/' . $pdfName;
                $updateFields['pdf_generated_at'] = date('Y-m-d H:i:s');
            }

            if (!empty($updateFields)) {
                $updateFields['updated_at'] = date('Y-m-d H:i:s');
                $db->table('lottery_results')->update($updateFields, ['id' => $resultId]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'No valid files uploaded'
                ])->setStatusCode(400);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Files uploaded and result updated',
                'data' => [
                    'result_id' => $resultId,
                    'pdf_path' => $updateFields['pdf_path'] ?? null,
                    'image_path' => $updateFields['image_path'] ?? null
                ]
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Update error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Internal server error'
            ])->setStatusCode(500);
        }
    }
    public function updateToggleStatus()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();

        // Read POST data
        $id = $request->getPost('id');
        $status = $request->getPost('status');

        if (!$id || !in_array($status, ['0', '1'])) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request'
            ])->setStatusCode(400);
        }

        // Convert status to string value
        $statusText = $status == '1' ? 'published' : 'draft';

        // Update the record
        $builder = $db->table('lottery_results');
        $builder->where('id', $id);
        $update = $builder->update(['status' => $statusText]);

        if ($update) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => "Result status updated to $statusText"
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to update status'
            ])->setStatusCode(500);
        }
    }

    public function uploadAdImage()
    {
        try {
            $request = \Config\Services::request();
            $db = \Config\Database::connect();
            
            // Get the uploaded image file
            $imageFile = $request->getFile('image_file');
            
            if (!$imageFile || !$imageFile->isValid() || $imageFile->hasMoved()) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'No valid image file uploaded'
                ])->setStatusCode(400);
            }
            
            // Create images directory if it doesn't exist
            $uploadDir = WRITEPATH . 'images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Generate unique filename
            $timeStamp = time();
            $extension = $imageFile->getExtension();
            $imageName = 'preview_' . $timeStamp . '.' . $extension;
            
            // Move file to images directory
            $imageFile->move($uploadDir, $imageName);
            
            // Update database - row with id 1
            $updateData = [
                'preview_image' => $imageName,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $db->table('lottery_results')->update($updateData, ['id' => 1]);
            
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Image uploaded successfully',
                'data' => [
                    'image_name' => $imageName,
                    'image_path' => 'images/' . $imageName
                ]
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Image upload error: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Upload failed'
            ])->setStatusCode(500);
        }
    }

    // AJAX Auxilary Methods
    public function deleteResult()
    {
        $db = \Config\Database::connect();
        $request = \Config\Services::request();

        $id = $request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Missing result ID'
            ]);
        }

        $db->transStart();

        $db->table('lottery_prizes')->where('result_id', $id)->delete();
        $db->table('lottery_results')->where('id', $id)->delete();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to delete result and prizes'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Result and associated prizes deleted successfully'
        ]);
    }


}